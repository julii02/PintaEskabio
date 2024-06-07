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
    session_start();
    include 'conexion.php';

    // Obtener datos del formulario
    $email = $_POST['email'];
    $contraseña = $_POST['password'];

    // Consulta para verificar si el correo electrónico y la contraseña coinciden
    $sql = "SELECT * FROM usuario WHERE Email = '$email' AND Contraseña = '$contraseña'";
    $result = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($result) == 1) 
    {
        $row = mysqli_fetch_assoc($result);
        // Las credenciales son correctas, iniciar sesión
        $_SESSION['usuario'] = $row['Email'];
        $_SESSION['nombre'] = $row['Nombre']; 
        $_SESSION['admin'] = $row['Admin']; 

        
        // Redirigir a la página correspondiente con mensaje de bienvenida
        if ($_SESSION['admin'] == 0) {
        header('Location: index_cliente.php');
        } 
        else {
        header('Location: indexadmin.html');
        }
    } 
    else {
    // Las credenciales son incorrectas, mostrar un mensaje de error
    echo "<script>
            alert('El correo electrónico o la contraseña son incorrectos.');
            window.location.href = 'form_iniciosesion.html';
          </script>";
    }

    mysqli_close($conexion);
    ?>

</body>
</html>
