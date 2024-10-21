<?php
include('config.php');

if (isset($_POST['id_evento'])) {
    $id_evento = $_POST['id_evento'];

    $consulta = "SELECT usuarios.nombre FROM registros_eventos 
                 JOIN usuarios ON registros_eventos.id_usuario = usuarios.id 
                 WHERE registros_eventos.id_evento = '$id_evento'";
    $resultado = mysqli_query($con, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        echo "<ul>";
        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<li>" . $fila['nombre'] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No hay clientes registrados.</p>";
    }
    
}
?>
