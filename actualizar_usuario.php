<?php

    include('conexion.php');

    $id = $_POST['ID'];
    $nombre = $_POST['Nombre'];
    $apellido = $_POST['Apellido'];
    $email = $_POST['Email'];
    $localidad = $_POST['Localidad'];
    $direccion = $_POST['Direccion'];
    $admin = isset($_POST['Admin']) ? 1 : 0;


    $sql = "UPDATE usuario SET Nombre='$nombre', Apellido='$apellido', Email='$email', Localidad='$localidad', Direccion='$direccion', Admin='$admin' WHERE ID='$id'"; 

    mysqli_query($conexion , $sql);

    header('Location: clientes.php');
    mysqli_close($conexion);



?> 