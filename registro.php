<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="css/lo.css">
    <link rel="stylesheet" href="css/cabecera.css">
</head>
<body>
    <form action="registro_validar.php" method="post">
        <h1 class="animate__animated animate__backInLeft">Registrarse</h1>

        <p>Nombre <input type="text" placeholder="ingrese su nombre" name="nombre" required></p>
        <p>Usuario <input type="text" placeholder="ingrese su usuario" name="usuario" required></p>
        <p>Contraseña <input type="password" placeholder="ingrese su contraseña" name="contraseña" required></p>
        
        <input type="submit" value="Registrar">
    </form> 
    
</body>
</html>