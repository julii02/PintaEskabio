<?php
include('conexion.php');

$palabraClave = isset($_POST['PalabraClave']) ? $_POST['PalabraClave'] : '';
$precio = isset($_POST['Precio']) ? $_POST['Precio'] : 'Todos';
$tipo = isset($_POST['Tipo']) ? $_POST['Tipo'] : 'Todos';
$alcohol = isset($_POST['Alcohol']) ? $_POST['Alcohol'] : 'Todos';

// Construir la consulta SQL base
$sql = "SELECT * FROM producto WHERE Stock > 0";

// Añadir filtros basados en los valores recibidos
if (!empty($palabraClave)) {
    $sql .= " AND Nombre LIKE '%$palabraClave%'";
}

if ($tipo != 'Todos') {
    $sql .= " AND Tipo = '$tipo'";
}

if ($alcohol != 'Todos') {
    $alcohol_val = $alcohol == '0' ? 0 : 1;
    $sql .= " AND Alcohol = $alcohol_val";
}

if ($precio != 'Todos') {
    $sql .= " ORDER BY PrecioVenta " . ($precio == 'ASC' ? 'ASC' : 'DESC');
}

$result = mysqli_query($conexion, $sql);

$output = '';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        
        $output .= '<div class="producto" data-id="' . $row["ID"] . '">';
        $output .= '<img src="uploads/' . $row["Imagen"] . '" alt="' . $row["Nombre"] . '" class="producto-imagen">';
        $output .= '<h2>' . $row["Nombre"] . '</h2>';
        $output .= '<p>' . $row["Descripcion"] . '</p>';
        $output .= '<p class="precio">Precio: $' . number_format($row["PrecioVenta"], 2) . '</p>';
        $output .= '<p>Tipo: ' . $row["Tipo"] . '</p>';
        $output .= '</div>';
    }
} else {
    $output .= '<p class="parrafo-sin-productos">No se encontraron productos con los filtros aplicados.</p>';
}

echo $output;

mysqli_close($conexion);
?>
