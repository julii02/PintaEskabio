<?php

    $conexion = mysqli_connect("localhost", "root", "", "pintaeskabio");

    if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

?> 