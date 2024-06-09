<?php

    include('conexion.php');

    $nombre = $_POST['Nombre'];
    $apellido = $_POST['Apellido'];
    $email = $_POST['Email'];
    $localidad = $_POST['Localidad'];
    $direccion = $_POST['Direccion'];
    $admin = isset($_POST['Admin']) ? 1 : 0;
    $contraseña = md5($_POST['Contraseña']);


    $sql = "INSERT INTO `usuario`(`ID`, `Nombre`, `Apellido`, `Email`, `Contraseña`, `Localidad`, `Direccion`, `Admin`) VALUES ('','$nombre','$apellido','$email','$contraseña','$localidad','$direccion','$admin')"; 

      

    mysqli_query($conexion , $sql);

    header('Location: clientes.php');
    mysqli_close($conexion);



?> 