<?php
include('config.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Consulta</title>
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
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
            $correo = mysqli_real_escape_string($con, $_POST['correo']);
            $mensaje = mysqli_real_escape_string($con, $_POST['mensaje']);

            // Guardar en la base de datos
            $consulta = "INSERT INTO consultas (nombre, correo, mensaje) VALUES ('$nombre', '$correo', '$mensaje')";
            if (mysqli_query($con, $consulta)) {
                echo '<div class="alert alert-success" role="alert">';
                echo "<strong>Gracias!</strong> Tu consulta ha sido enviada, $nombre. Nos pondremos en contacto contigo pronto.";
                echo '</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">';
                echo "<strong>Error!</strong> No hemos podido enviar tu consulta. Por favor, inténtalo más tarde.";
                echo '</div>';
            }
        }
        ?>
        <a href="cliente.php" class="btn btn-secondary mt-3">Volver</a>
    </div>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>

