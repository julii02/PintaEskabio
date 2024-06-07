<?php
include 'conexion.php';

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precioCompra = $_POST['precioCompra'];
$precioVenta = $_POST['precioVenta'];
$stock = $_POST['stock'];
$alcohol = $_POST['alcohol'];
$tipo = $_POST['tipo'];
$activo = $_POST['activo'];
$imagen_actual = $_POST['imagen_actual'];

$imagen = $_FILES['imagen']['name'];
if ($imagen) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($imagen);
    move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file);
    $imagen_actual = $imagen;
}

$sql = "UPDATE producto SET Nombre='$nombre', Descripcion='$descripcion', PrecioCompra='$precioCompra', PrecioVenta='$precioVenta', Stock='$stock', Alcohol='$alcohol', Tipo='$tipo', Imagen='$imagen_actual', Activo='$activo' WHERE ID='$id'";

if (mysqli_query($conexion, $sql)) {
    header('Location: productos.php');
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
}

mysqli_close($conexion);
?>
