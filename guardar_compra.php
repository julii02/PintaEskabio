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

        // Insertar venta
        $query_venta = "INSERT INTO venta (Fecha, ID_Usuario) VALUES (NOW(), '$cliente_id')";
        if (mysqli_query($conexion, $query_venta)) {
            $venta_id = mysqli_insert_id($conexion);

            // Insertar detalles de venta y actualizar stock
            foreach ($productos as $producto) {
                $producto_id = $producto['id'];
                $nombre = $producto['nombre'];
                $precio_unitario = $producto['precio'];
                $cantidad = $producto['cantidad'];
                $subtotal = $cantidad * $precio_unitario;

                // Insertar detalle de venta
                $query_detalle = "INSERT INTO detalle_venta (ID_Venta, ID_Producto, Cantidad, Precio) VALUES ('$venta_id', '$producto_id', '$cantidad', '$precio_unitario')";
                mysqli_query($conexion, $query_detalle);

                // Actualizar stock del producto
                $query_stock = "UPDATE producto SET Stock = Stock - '$cantidad' WHERE id = '$producto_id'";
                mysqli_query($conexion, $query_stock);
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
        } else {
            $response['message'] = "Error: " . $query_venta . "<br>" . mysqli_error($conexion);
        }
    }
} else {
    $response['message'] = 'Usuario no autenticado.';
}

$conexion->close();
echo json_encode($response);
?>