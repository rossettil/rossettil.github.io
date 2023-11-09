<?php
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_de_datos = "abm_app";

$con = mysqli_connect($host, $usuario, $contrasena, $base_de_datos);

if (!$con) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

mysqli_set_charset($con, "utf8");
?>
