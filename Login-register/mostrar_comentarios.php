<?php
    session_start();
    require("php/conexion_be.php");

    // Obtener el ID del video desde la URL
    $idVideo = isset($_GET['id_video']) ? $_GET['id_video'] : null;

    // Verificar si el ID del video está presente
    if (!$idVideo) {
        echo "ID de video no proporcionado.";
        exit();
    }

    // Consulta SQL para obtener los comentarios relacionados con el video
    $sqlComentarios = "SELECT * FROM comentarios WHERE id_video = " . mysqli_real_escape_string($con, $idVideo);
    $resultComentarios = mysqli_query($con, $sqlComentarios);

    // Mostrar los comentarios
    while ($comentario = mysqli_fetch_assoc($resultComentarios)) {
        echo "<strong>Usuario:</strong> " . $comentario['id_usuario'] . "<br>";
        echo "<strong>Comentario:</strong> " . $comentario['comentario'] . "<br>";
        echo "<strong>Fecha:</strong> " . $comentario['fecha_publicacion'] . "<br><br>";
    }

    mysqli_close($con);
?>