<?php

    include('conexion.php');

    $id = $_POST['ID'];
    $nombre = $_POST['Nombre'];
    $apellido = $_POST['Apellido'];
    $email = $_POST['Email'];
    $telefono = $_POST['Telefono'];
    $localidad = $_POST['Localidad'];
    $direccion = $_POST['Direccion'];


    $sql = "UPDATE proveedor SET Nombre='$nombre', Apellido='$apellido', Email='$email',Telefono='$telefono', Localidad='$localidad', Direccion='$direccion' WHERE ID='$id'";  

    mysqli_query($conexion , $sql);

    header('Location: proveedores.php');
    mysqli_close($conexion);



?> 