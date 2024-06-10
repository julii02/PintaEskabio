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
    $contraseña = md5($_POST['password']);

    // Consulta para verificar si el correo electrónico ya existe
    $sql = "SELECT * FROM usuario WHERE Email = '$email'";

    $result = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($result) > 0) {
        // El correo electrónico ya existe
        header("Location: form_registro.html?mensaje=Error:%20El%20correo%20electr%C3%B3nico%20ya%20est%C3%A1%20registrado&exito=0");
        exit;
    } else {
        // Insertar el nuevo cliente
        $sql = "INSERT INTO usuario (Nombre, Apellido, Email, Localidad, Direccion, Contraseña) VALUES ('$nombre', '$apellido', '$email', '$localidad', '$direccion', '$contraseña')";

        if (mysqli_query($conexion, $sql)) {
            // Redirigir al usuario a form_iniciosesion.html con el mensaje de notificación
            header("Location: form_iniciosesion.html?mensaje=Se%20ha%20registrado%20con%20%C3%A9xito&exito=1");
            exit;
        } else {
            // En caso de error, redirigir al usuario a form_registro.html con el mensaje de error
            header("Location: form_registro.html?mensaje=Error%20al%20registrar:%20" . urlencode(mysqli_error($conexion)) . "&exito=0");
            exit;
        }
    }

    mysqli_close($conexion);
    ?>


</body>
</html>
