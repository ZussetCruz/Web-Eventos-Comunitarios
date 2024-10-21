<?php
session_start();
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener el ID del usuario desde la sesión
    $id_usuario = $_SESSION['user_id'];
    $comentario = $_POST['comentario'];

    // Insertar el comentario en la base de datos
    $sql = "INSERT INTO comentarios (id_usuario, comentario) VALUES ('$id_usuario', '$comentario')";

    if (mysqli_query($con, $sql)) {
        header("Location: cliente.php?mensaje=Comentario agregado exitosamente");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}
?>

