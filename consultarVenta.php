<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente_id = $_POST['client'];
    $productos = $_POST['products'];
    $fecha = date('Y-m-d H:i:s'); // Obtiene la fecha y hora actuales

    // Validar productos únicos
    $productos = arrayUniqueMultidimensional($productos, 'product');

    // Insertar venta
    $query_venta = "INSERT INTO venta (Fecha, ID_Usuario) VALUES ('$fecha', '$cliente_id')";
    if (mysqli_query($conexion, $query_venta)) {
        $venta_id = mysqli_insert_id($conexion);

        // Insertar detalles de venta y actualizar stock
        $total_precio = 0;
        foreach ($productos as $producto) {
            $producto_id = $producto['product'];
            $cantidad = $producto['quantity'];
            $precio_unitario = $producto['price'];
            $subtotal = $cantidad * $precio_unitario;

            // Insertar detalle de venta
            $query_detalle = "INSERT INTO detalle_venta (ID_Venta, ID_Producto, Cantidad, Precio) VALUES ('$venta_id', '$producto_id', '$cantidad', '$precio_unitario')";
            mysqli_query($conexion, $query_detalle);

            // Actualizar stock del producto
            $query_stock = "UPDATE producto SET Stock = Stock - '$cantidad' WHERE id = '$producto_id'";
            mysqli_query($conexion, $query_stock);

            // Calcular el total del precio
            $total_precio += $subtotal;
        }
        // Calcular el total del precio de la venta actual
        $query_suma_precio = "SELECT SUM(Precio) AS total_precio FROM detalle_venta WHERE ID_Venta = '$venta_id'";
        $resultado_suma_precio = mysqli_query($conexion, $query_suma_precio);
        $row = mysqli_fetch_assoc($resultado_suma_precio);
        $total_precio = $row['total_precio'];

        // Redireccionar después de registrar la venta
        header("Location: ventas.php?total_precio=$total_precio");
        exit();
    } else {
        echo "Error: " . $query_venta . "<br>" . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}

function arrayUniqueMultidimensional($array, $key) {
    $temp_array = [];
    $i = 0;
    $key_array = [];

    foreach($array as $val) {
        if (!in_array($val[$key], $key_array)) {
            $key_array[$i] = $val[$key];
            $temp_array[$i] = $val;
        }
        $i++;
    }
    return $temp_array;
}
?>