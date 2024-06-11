<?php

    include('conexion.php');

    $nombre = $_GET['firstname'];
    $apellido = $_GET['lastname'];
    $telefono = $_GET['phone'];
    $email = $_GET['email'];
    $asunto = $_GET['subject'];
    $mensaje = $_GET['message'];
  


    $sql = "INSERT INTO `formulario`(`ID`, `Nombre`, `Apellido`, `Telefono`, `Email`, `Asunto`, `Texto`) VALUES ('','$nombre','$apellido','$telefono','$email','$asunto','$mensaje')"; 

    
    mysqli_query($conexion , $sql);
    header('Location: index_cliente.php#Formulario');
    mysqli_close($conexion);

?> 