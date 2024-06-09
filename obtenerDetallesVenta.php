<?php
include 'conexion.php';

if (isset($_GET['ventaID'])) {
    $ventaID = $_GET['ventaID'];

    $query = "SELECT v.Fecha, p.nombre AS Producto, dv.Cantidad, dv.Precio, u.nombre AS Cliente
              FROM venta v
              JOIN detalle_venta dv ON v.ID = dv.ID_Venta
              JOIN producto p ON dv.ID_Producto = p.id
              JOIN usuario u ON v.ID_Usuario = u.id
              WHERE v.ID = $ventaID";
    
    $result = mysqli_query($conexion, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $ventaDetalles = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $ventaDetalles[] = $row;
        }
        echo json_encode($ventaDetalles);
    } else {
        echo json_encode([]);
    }
    
    mysqli_close($conexion);
}
?>