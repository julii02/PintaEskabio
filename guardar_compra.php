<?php
session_start();
$conexion = new mysqli("localhost", "root", "", "pintaeskabio");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$response = array('status' => 'error', 'message' => 'No se recibieron productos para guardar.');

if (isset($_SESSION['usuario'])) {
    $cliente_id = $_SESSION['usuario']; // Obtener el ID del usuario desde la sesión

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['productos'])) {
        $productos = $_POST['productos'];
        $ventas_exitosas = true; // Variable para verificar si todas las ventas se realizaron correctamente

        // Comienza una transacción para garantizar la integridad de los datos
        $conexion->begin_transaction();

        try {
            // Insertar venta
            $query_venta = "INSERT INTO venta (Fecha, ID_Usuario) VALUES (NOW(), '$cliente_id')";
            if (!mysqli_query($conexion, $query_venta)) {
                throw new Exception("Error: " . $query_venta . "<br>" . mysqli_error($conexion));
            }

            $venta_id = mysqli_insert_id($conexion);

            // Insertar detalles de venta y actualizar stock
            foreach ($productos as $producto) {
                $producto_id = $producto['id'];
                $nombre = $producto['nombre'];
                $precio_unitario = $producto['precio'];
                $cantidad = $producto['cantidad'];
                $subtotal = $cantidad * $precio_unitario;

                // Verificar stock disponible
                $query_stock_check = "SELECT Stock FROM producto WHERE id = '$producto_id'";
                $resultado_stock_check = mysqli_query($conexion, $query_stock_check);
                $row = mysqli_fetch_assoc($resultado_stock_check);
                $stock_disponible = $row['Stock'];

                if ($stock_disponible < $cantidad) {
                    throw new Exception("Error. No hay stock disponible para el producto: $nombre");
                }

                // Insertar detalle de venta
                $query_detalle = "INSERT INTO detalle_venta (ID_Venta, ID_Producto, Cantidad, Precio) VALUES ('$venta_id', '$producto_id', '$cantidad', '$precio_unitario')";
                if (!mysqli_query($conexion, $query_detalle)) {
                    throw new Exception("Error: " . $query_detalle . "<br>" . mysqli_error($conexion));
                }

                // Actualizar stock del producto
                $query_stock_update = "UPDATE producto SET Stock = Stock - '$cantidad' WHERE id = '$producto_id'";
                if (!mysqli_query($conexion, $query_stock_update)) {
                    throw new Exception("Error: " . $query_stock_update . "<br>" . mysqli_error($conexion));
                }
            }

            // Calcular el total del precio de la venta actual
            $query_suma_precio = "SELECT SUM(Precio * Cantidad) AS total_precio FROM detalle_venta WHERE ID_Venta = '$venta_id'";
            $resultado_suma_precio = mysqli_query($conexion, $query_suma_precio);
            $row = mysqli_fetch_assoc($resultado_suma_precio);
            $total_precio = $row['total_precio'];

            // Configurar respuesta exitosa
            $response['status'] = 'success';
            $response['message'] = 'Tu compra se realizó con éxito.';
            $response['total_precio'] = $total_precio;

            // Confirmar la transacción
            $conexion->commit();
        } catch (Exception $e) {
            $response['message'] = $e->getMessage();
            $ventas_exitosas = false;
            $conexion->rollback(); // Revertir la transacción en caso de error
        }
    }
} else {
    $response['message'] = 'Usuario no autenticado.';
}

$conexion->close();
echo json_encode($response);
?>