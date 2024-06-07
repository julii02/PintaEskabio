<?php
include('conexion.php');

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$preciocompra = $_POST['precioCompra'];
$precioventa = $_POST['precioVenta'];
$stock = $_POST['stock'];
$alcohol = $_POST['alcohol'];
$tipo = $_POST['tipo'];
$activo = isset($_POST['activo']) ? 1 : 0;

// Manejo de la imagen
$imagen = $_FILES['imagen']['name'];
if ($imagen) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($imagen);

    // Verificar si el directorio existe
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file)) {
        // La imagen se subió correctamente
        $imagen = basename($imagen); // Obtener solo el nombre del archivo
    } else {
        // Manejar el error de subida
        die("Error al subir la imagen.");
    }
} else {
    $imagen = ""; // No se subió ninguna imagen
}

$sql = "INSERT INTO producto (Nombre, Descripcion, PrecioCompra, PrecioVenta, Stock, Combo, Alcohol, Tipo, Imagen, Activo) 
        VALUES ('$nombre', '$descripcion', '$preciocompra', '$precioventa', '$stock', '', '$alcohol', '$tipo', '$imagen', '$activo')";

if (mysqli_query($conexion, $sql)) {
    header('Location: productos.php');
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
}

mysqli_close($conexion);
header('Location: productos.php');
?>
