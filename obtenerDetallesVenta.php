<?php
include 'conexion.php';

if (isset($_GET['ventaID'])) {
    $ventaID = $_GET['ventaID'];

    $query = "
        SELECT 
            p.nombre AS Producto, 
            p.Imagen, 
            p.Descripcion, 
            p.Tipo, 
            dv.Cantidad, 
            dv.Precio, 
            u.nombre AS Cliente, 
            v.Fecha
        FROM 
            detalle_venta dv
        JOIN 
            producto p ON dv.ID_Producto = p.id
        JOIN 
            venta v ON dv.ID_Venta = v.ID
        JOIN 
            usuario u ON v.ID_Usuario = u.id
        WHERE 
            dv.ID_Venta = $ventaID
    ";

    $result = mysqli_query($conexion, $query);
    $details = [];

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $details[] = $row;
        }
    }

    echo json_encode($details);
}
?>