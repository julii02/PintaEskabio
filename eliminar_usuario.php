<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['ID'];

    $query = "DELETE FROM usuario WHERE ID = $id";
    if (mysqli_query($conexion, $query)) {
        echo "Usuario eliminado correctamente";
    } else {
        echo "Error al eliminar el usuario: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}
?>