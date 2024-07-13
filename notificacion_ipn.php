<?php
// Configurar credenciales de Mercado Pago
$mp_access_token = 'TEST-4946848203049053-061522-d3acf38a8fdeddb8cd8c2adb269a05dd-693009205'; // Reemplaza con tu access token de Mercado Pago

$conexion = new mysqli("localhost", "root", "", "pintaeskabio");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Leer el contenido de la notificación
$body = json_decode(file_get_contents('php://input'), true);

if (isset($body['id']) && isset($body['type']) && $body['type'] === 'payment') {
    $payment_id = $body['id'];

    // Obtener información del pago desde Mercado Pago
    $mp_url = "https://api.mercadopago.com/v1/payments/$payment_id?access_token=$mp_access_token";
    $payment_info = file_get_contents($mp_url);
    $payment_data = json_decode($payment_info, true);

    if (isset($payment_data['status']) && $payment_data['status'] === 'approved') {
        $external_reference = $payment_data['external_reference'];

        // Insertar venta
        $query_venta = "INSERT INTO venta (Fecha, external_reference) VALUES (NOW(), ?)";
        $stmt_venta = $conexion->prepare($query_venta);
        $stmt_venta->bind_param("s", $external_reference);
        if (!$stmt_venta->execute()) {
            error_log("Error: " . $query_venta . "<br>" . $stmt_venta->error);
            exit;
        }

        $venta_id = $conexion->insert_id;

        // Obtener los productos desde la preferencia de pago
        $items = $payment_data['additional_info']['items'];

        foreach ($items as $item) {
            $producto_id = $item['id'];
            $cantidad = $item['quantity'];
            $precio_unitario = $item['unit_price'];

            // Insertar detalle de venta
            $query_detalle = "INSERT INTO detalle_venta (ID_Venta, ID_Producto, Cantidad, Precio) VALUES (?, ?, ?, ?)";
            $stmt_detalle = $conexion->prepare($query_detalle);
            $stmt_detalle->bind_param("iiid", $venta_id, $producto_id, $cantidad, $precio_unitario);
            if (!$stmt_detalle->execute()) {
                error_log("Error: " . $query_detalle . "<br>" . $stmt_detalle->error);
                exit;
            }

            // Actualizar stock del producto
            $query_stock_update = "UPDATE producto SET Stock = Stock - ? WHERE id = ?";
            $stmt_stock_update = $conexion->prepare($query_stock_update);
            $stmt_stock_update->bind_param("ii", $cantidad, $producto_id);
            if (!$stmt_stock_update->execute()) {
                error_log("Error: " . $query_stock_update . "<br>" . $stmt_stock_update->error);
                exit;
            }
        }

        echo "Compra confirmada y guardada correctamente.";
    } else {
        echo "Pago no aprobado o datos faltantes.";
    }
} else {
    echo "Notificación no válida.";
}

$conexion->close();
?>