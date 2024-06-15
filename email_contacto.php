<?php

include('conexion.php');

$nombre = mysqli_real_escape_string($conexion, $_POST['firstname']);
$apellido = mysqli_real_escape_string($conexion, $_POST['lastname']);
$telefono = mysqli_real_escape_string($conexion, $_POST['phone']);
$email = mysqli_real_escape_string($conexion, $_POST['email']);
$asunto = mysqli_real_escape_string($conexion, $_POST['subject']);
$mensaje = mysqli_real_escape_string($conexion, $_POST['message']);

$sql = "INSERT INTO `formulario`(`ID`, `Nombre`, `Apellido`, `Telefono`, `Email`, `Asunto`, `Texto`) VALUES ('', '$nombre', '$apellido', '$telefono', '$email', '$asunto', '$mensaje')";

if (mysqli_query($conexion, $sql)) {
    echo "Mensaje enviado correctamente";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
}

mysqli_close($conexion);

?>