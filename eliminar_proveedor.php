<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['ID'];

    $query = "DELETE FROM proveedor WHERE ID = $id";
    if (mysqli_query($conexion, $query)) {
        echo "Proveedor eliminado correctamente";
    } else {
        echo "Error al eliminar el proveedor: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}
?>