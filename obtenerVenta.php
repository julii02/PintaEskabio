<?php
include 'conexion.php';

$query = "SELECT v.ID, v.Fecha, GROUP_CONCAT(p.nombre SEPARATOR ', ') AS Productos, SUM(dv.Precio) AS TotalPrecio, u.nombre AS Cliente
    FROM venta v
    JOIN detalle_venta dv ON v.ID = dv.ID_Venta
    JOIN producto p ON dv.ID_Producto = p.id
    JOIN usuario u ON v.ID_Usuario = u.id
    GROUP BY v.ID, v.Fecha, u.nombre
    ORDER BY v.Fecha DESC";
$result = mysqli_query($conexion, $query);
$totalVentas = 0;
$output = '';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $totalVenta = $row['TotalPrecio'];
        $totalVentas += $totalVenta;
        $output .= "<tr>
                        <td>{$row['Fecha']}</td>
                        <td>\${$totalVenta}</td>
                        <td>{$row['Cliente']}</td>
                        <td>
                            <a class='btn green modal-trigger' href='#modalViewSale' onclick='showSaleDetails({$row['ID']})'><i class='material-icons'>remove_red_eye</i></a>
                        </td>
                    </tr>";
    }
} else {
    $output .= "<tr><td colspan='6'>No hay ventas registradas</td></tr>";
}
echo $output;
?>