<?php
include 'conexion.php';

if (isset($_GET['id']) && isset($_GET['cantidad'])) {
    $productId = $_GET['id'];
    $cantidad = $_GET['cantidad'];

    $consulta_stock = mysqli_query($conexion, "SELECT nombre, stock FROM producto WHERE id = $productId");
    if (mysqli_num_rows($consulta_stock) > 0) {
        $producto = mysqli_fetch_assoc($consulta_stock);
        if ($producto['stock'] >= $cantidad) {
            echo json_encode(['disponible' => true]);
        } else {
            echo json_encode([
                'disponible' => false,
                'producto' => $producto['nombre'],
                'stock' => $producto['stock']
            ]);
        }
    } else {
        echo json_encode(['disponible' => false, 'producto' => 'Desconocido', 'stock' => 0]);
    }
} else {
    echo json_encode(['disponible' => false, 'producto' => 'Desconocido', 'stock' => 0]);
}
?>