<?php

    include('conexion.php');

    $nombre = $_POST['Nombre'];
    $apellido = $_POST['Apellido'];
    $email = $_POST['Email'];
    $telefono = $_POST['Telefono'];
    $localidad = $_POST['Localidad'];
    $direccion = $_POST['Direccion'];
  


    $sql = "INSERT INTO `proveedor`(`ID`, `Nombre`, `Apellido`, `Email`, `Telefono`, `Localidad`, `Direccion`) VALUES ('','$nombre','$apellido','$email','$telefono','$localidad','$direccion')"; 

      

    mysqli_query($conexion , $sql);

    header('Location: proveedores.php');
    mysqli_close($conexion);



?> 