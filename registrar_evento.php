<?php
session_start();
include('config.php');

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    echo '<div class="alert alert-danger" role="alert">Error: no estás autenticado. Por favor, inicia sesión.</div>';
    exit; // Detener la ejecución del script
}

// Inicializar variables para mensajes
$mensaje = '';
$tipo_mensaje = '';

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_evento'])) {
        $id_evento = mysqli_real_escape_string($con, $_POST['id_evento']);
        $id_usuario = $_SESSION['user_id']; // Obtener el ID del usuario de la sesión

        // Verificar si el usuario ya está registrado en el evento
        $verificarConsulta = "SELECT * FROM registros_eventos WHERE id_evento = '$id_evento' AND id_usuario = '$id_usuario'";
        $resultadoVerificacion = mysqli_query($con, $verificarConsulta);

        if (mysqli_num_rows($resultadoVerificacion) > 0) {
            $mensaje = 'Ya estás registrado en este evento.';
            $tipo_mensaje = 'warning';
        } else {
            // Guardar en la tabla de registros_eventos
            $consulta = "INSERT INTO registros_eventos (id_evento, id_usuario) VALUES ('$id_evento', '$id_usuario')";
            if (mysqli_query($con, $consulta)) {
                $mensaje = '¡Te has registrado exitosamente en el evento!';
                $tipo_mensaje = 'success';
            } else {
                $mensaje = 'Error al registrarte en el evento. Por favor, inténtalo más tarde.';
                $tipo_mensaje = 'danger';
            }
        }
    } else {
        $mensaje = 'Error: no se ha enviado el ID del evento.';
        $tipo_mensaje = 'warning';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Evento</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($mensaje): ?>
            <div class="alert alert-<?php echo $tipo_mensaje; ?>" role="alert">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <a href="cliente.php" class="btn btn-secondary mt-3">Volver a los Eventos</a>
    </div>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>



