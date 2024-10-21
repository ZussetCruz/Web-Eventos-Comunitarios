<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        h1 {
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Envíanos tus Consultas o Sugerencias</h1>
        <p>Tu opinión es muy importante para nosotros. Completa el formulario a continuación y nos pondremos en contacto contigo lo antes posible.</p>

        <form action="procesar_contacto.php" method="post">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo Electrónico</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="form-group">
                <label for="mensaje">Mensaje</label>
                <textarea class="form-control" id="mensaje" name="mensaje" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>

        <a href="cliente.php" class="btn btn-secondary mt-3">Volver a la Página de Eventos</a>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>
</html>
