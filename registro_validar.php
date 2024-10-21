<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    // Verificar si el usuario ya existe
    $consultaVerificar = "SELECT * FROM usuarios WHERE usuario='$usuario'";
    $resultadoVerificar = mysqli_query($con, $consultaVerificar);

    if (mysqli_num_rows($resultadoVerificar) > 0) {
        // El usuario ya existe
        echo '<h1 class="bad">El usuario ya existe. Por favor, elige otro nombre de usuario.</h1>';
        include("registro.html"); // Volver al formulario de registro
    } else {
        // Insertar el nuevo usuario
        $consultaRegistro = "INSERT INTO usuarios (nombre, usuario, contraseña, id_cargo) VALUES ('$nombre', '$usuario', '$contraseña', 2)"; // Asumiendo id_cargo 2 para clientes
        if (mysqli_query($con, $consultaRegistro)) {
            echo '<h1 class="good">Registro exitoso. Puedes iniciar sesión.</h1>';
            header("Location: index.html"); // Redirigir a la página de inicio de sesión
            exit;
        } else {
            echo '<h1 class="bad">Error al registrar usuario. Intenta nuevamente.</h1>';
            include("registro.html"); // Volver al formulario de registro
        }
    }

    // Liberar resultado y cerrar conexión
    mysqli_free_result($resultadoVerificar);
    mysqli_close($con);
}
?>