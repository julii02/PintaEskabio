<?php
include 'conexion.php';

if (isset($_GET['compraID'])) {
    $compraID = $_GET['compraID'];

    $query = "SELECT c.Fecha, p.nombre AS Producto, dc.Cantidad, dc.Precio, u.nombre AS Proveedor
              FROM compra c
              JOIN detalle_compra dc ON c.ID = dc.ID_Compra
              JOIN producto p ON dc.ID_Producto = p.id
              JOIN proveedor u ON c.ID_Proveedor = u.id
              WHERE c.ID = $compraID";
    
    $result = mysqli_query($conexion, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $compraDetalles = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $compraDetalles[] = $row;
        }
        echo json_encode($compraDetalles);
    } else {
        echo json_encode([]);
    }
    
    mysqli_close($conexion);
}
?>