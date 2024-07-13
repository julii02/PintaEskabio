<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['ID'];

    $query = "DELETE FROM producto WHERE ID = $id";
    if (mysqli_query($conexion, $query)) {
        echo "Producto eliminado correctamente";
    } else {
        echo "Error al eliminar el producto: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}
?>