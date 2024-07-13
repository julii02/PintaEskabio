<?php
include 'conexion.php';

$compraID = $_GET['compraID'];

$query = "SELECT c.Fecha, p.nombre AS Producto, p.Imagen, p.descripcion AS Descripcion, dc.Cantidad, p.Tipo, u.nombre AS Proveedor, dc.Precio
          FROM compra c
          JOIN detalle_compra dc ON c.ID = dc.ID_Compra
          JOIN producto p ON dc.ID_Producto = p.id
          JOIN proveedor u ON c.ID_Proveedor = u.id
          WHERE c.ID = '$compraID'";

$result = mysqli_query($conexion, $query);

$compraDetalles = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $compraDetalles[] = $row;
    }
}

mysqli_close($conexion);

echo json_encode($compraDetalles);
?>