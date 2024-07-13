<?php
include 'conexion.php';

$query = "SELECT c.ID, DATE_FORMAT(c.Fecha, '%Y-%m-%d %H:%i:%s') AS FechaCompleta, DATE(c.Fecha) AS Fecha, GROUP_CONCAT(p.nombre SEPARATOR ', ') AS Productos, SUM(dc.Precio) AS TotalPrecio, u.nombre AS Proveedor
          FROM compra c
          JOIN detalle_compra dc ON c.ID = dc.ID_Compra
          JOIN producto p ON dc.ID_Producto = p.id
          JOIN proveedor u ON c.ID_Proveedor = u.id
          GROUP BY c.ID, FechaCompleta, Fecha, u.nombre
          ORDER BY c.ID DESC";
$result = mysqli_query($conexion, $query);
$totalCompras = 0;
$output = '';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $totalCompra = $row['TotalPrecio'];
        $totalCompras += $totalCompra;
        $output .= "<tr>
                        <td>{$row['Fecha']}</td>
                        <td>\${$totalCompra}</td>
                        <td>{$row['Proveedor']}</td>
                        <td>
                            <a class='btn green modal-trigger' href='#modalViewSale' onclick='showSaleDetails({$row['ID']})'><i class='material-icons'>remove_red_eye</i></a>
                        </td>
                    </tr>";
    }
} else {
    $output .= "<tr><td colspan='6'>No hay compras registradas</td></tr>";
}
echo $output;

mysqli_close($conexion);
?>