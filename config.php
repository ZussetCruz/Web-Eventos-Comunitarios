<?php
$usuario  = "root";
$password = "";
$servidor = "localhost";
$basededatos = "practicas";
$con = mysqli_connect($servidor, $usuario, $password) or die("Error al conectar con el servidor");
$db = mysqli_select_db($con, $basededatos) or die("Error al conectar con la base de datos");
?>

