<?php
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];
session_start();
$_SESSION['usuario'] = $usuario;

$conexion = mysqli_connect("localhost", "root", "", "practicas");

// Consulta para verificar credenciales
$consulta = "SELECT * FROM usuarios WHERE usuario='$usuario' AND contraseña='$contraseña'";
$resultado = mysqli_query($conexion, $consulta);

// Verificar si las credenciales son correctas
$filas = mysqli_fetch_array($resultado);

if ($filas) {
    // Si el usuario existe, guarda su ID y nombre en la sesión
    $_SESSION['user_id'] = $filas['id']; // ID del usuario
    $_SESSION['user_name'] = $filas['nombre']; // Nombre del usuario (opcional)

    // Verificar el cargo del usuario
    if ($filas['id_cargo'] == 1) { // administrador
        header("Location: admin.php");
    } elseif ($filas['id_cargo'] == 2) { // cliente
        header("Location: cliente.php");
    }
} else {
    // Si las credenciales no son correctas, mostrar mensaje de error
    include("index.html");
    echo '<h1 class="bad">Error en la autenticación</h1>';
}

// Liberar resultado y cerrar conexión
mysqli_free_result($resultado);
mysqli_close($conexion);
?>