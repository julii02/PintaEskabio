<!DOCTYPE html>
<html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Página</title>
    <link rel="stylesheet" type="text/css" href="estilos/estilos_admin.css">
    <link rel="stylesheet" type="text/css" href="normalize.css">
</head>
<body class="body-principal">
    <?php
include 'conexion.php';

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$localidad = $_POST['localidad'];
$direccion = $_POST['direccion'];
$contraseña = $_POST['password'];

// Consulta para verificar si el correo electrónico ya existe
$sql = "SELECT * FROM usuario WHERE Email = '$email'";

$result = mysqli_query($conexion, $sql);

if (mysqli_num_rows($result) > 0) {
    // El correo electrónico ya existe
    echo "<p class='error'>Error: El correo electrónico ya está registrado.</p>";
    echo "<a href='form_registro.html'>Volver al formulario</a>";
} else {
    // Insertar el nuevo cliente
    $sql = "INSERT INTO usuario (Nombre, Apellido, Email, Localidad, Direccion , Contraseña) VALUES ('$nombre', '$apellido', '$email','$localidad','$direccion','$contraseña')";

    if (mysqli_query($conexion, $sql)) {
        echo "<p class='success'>Se ha registrado con exito.</p>";
        echo "<a href='form_iniciosesion.html'>INICIAR SESION</a>";
    } else {
        echo "<p class='error'>Error: " . $sql . "<br>" . mysqli_error($conexion) . "</p>";
        echo "<a href='form_registro.html'>Volver al formulario</a>";
    }
}

mysqli_close($conexion);
?>

</body>
</html>
