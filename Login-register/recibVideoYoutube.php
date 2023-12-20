<?php
date_default_timezone_set("America/Bogota");
setlocale(LC_ALL, "es_ES");
require("php/conexion_be.php");

session_start();

// Obtén el id del usuario desde la sesión
$id_usuario = $_SESSION['id_usuario'];
$nombreVideo = $_POST['nombreVideo'];
$urlVideo = $_POST['urlVideo'];
$categoriaSeleccionada = $_POST['categoria']; // Nueva línea para obtener la categoría
$tags = isset($_POST['tags']) ? $_POST['tags'] : [];
$tipo_video = $_POST['tipo_video']; // Corregir el nombre de la variable

// Convertir el array de tags a una cadena separada por comas
$tagsString = implode(',', $tags);

// Obtén la ID del video de la URL de YouTube
$videoId = obtenerYouTubeVideoId($urlVideo);

// Verifica si se obtuvo una ID de video válida
if ($videoId !== false) {
    $url_final_video = 'https://www.youtube.com/embed/' . $videoId;
} else {
    // Manejo de errores
    header("Location: agregarVideo.php?error=URL inválida");
    exit();
}

$queryInsert = "INSERT INTO videos (nombreVideo, urlVideo, categoria, tags, tipo_video, id_usuario) 
                VALUES ('$nombreVideo', '$url_final_video', '$categoriaSeleccionada', '$tagsString', '$tipo_video', $id_usuario)";
$result = mysqli_query($con, $queryInsert);

if ($result) {
    header("Location: agregarVideo.php?success=1");
} else {
    header("Location: agregarVideo.php?error=1");
}

// Función para obtener la ID del video de YouTube
function obtenerYouTubeVideoId($url)
{
    $pattern = '/(?:https?:\/\/)?(?:www\.)?(?:m\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/|youtube\.com\/.+[?&]v=)?([^"&?\/\s]{11})/';
    preg_match($pattern, $url, $matches);

    return isset($matches[1]) ? $matches[1] : false;
}
?>
