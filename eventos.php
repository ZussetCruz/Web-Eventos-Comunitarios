<?php 
include('config.php');  

// Consulta para obtener los eventos
$consulta = "SELECT * FROM eventoscalendar"; // Asegúrate de que el nombre de la tabla sea correcto
$resultado = mysqli_query($con, $consulta);  

if (mysqli_num_rows($resultado) > 0) { 
    echo "<div class='container mt-5'>"; 
    while ($evento = mysqli_fetch_assoc($resultado)) { 
        echo "<div class='card mb-3'>"; 
        echo "<div class='card-body'>"; 
        echo "<h5 class='card-title'>" . $evento['nombre'] . "</h5>"; 
        echo "<p class='card-text'>Fecha: " . $evento['fecha_inicio'] . " - " . $evento['fecha_fin'] . "</p>"; 
        echo "<p class='card-text'>" . $evento['descripcion'] . "</p>"; 
        
        // Aquí agregamos el botón de registro
        echo "<form action='registrar_evento.php' method='POST'>"; 
        echo "<input type='hidden' name='id_evento' value='" . $evento['id'] . "'>"; // Asegúrate de que 'id' sea el nombre de la columna en tu tabla 
        echo "<button type='submit' class='btn btn-primary'>Registrarse</button>"; 
        echo "</form>"; 
        
        echo "</div>"; 
        echo "</div>"; 
    } 
    echo "</div>"; 
} else { 
    echo "<p>No hay eventos disponibles.</p>"; 
} 
?>

