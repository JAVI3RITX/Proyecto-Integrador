<?php
date_default_timezone_set("America/Bogota");
setlocale(LC_ALL,"es_ES"); 
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

$cantidad_url_video = strlen($urlVideo);

if ($cantidad_url_video == '28') {
    $cortar_url = str_replace ('https://youtu.be/','',$urlVideo);
    $url_final_video = 'https://www.youtube.com/embed/' .$cortar_url; 

} elseif ($cantidad_url_video == '41') {
    $cortar_url = str_replace ('https://m.youtube.com/watch?v=','',$urlVideo);
    $url_final_video = 'https://www.youtube.com/embed/' .$cortar_url; 

} elseif ($cantidad_url_video == '43') {
    $cortar_url = str_replace ('https://www.youtube.com/watch?v=','',$urlVideo);
    $url_final_video = 'https://www.youtube.com/embed/' .$cortar_url; 

} elseif ($cantidad_url_video == '58') {
    $cortar_url = str_replace ('https://m.youtube.com/watch?v=','',$urlVideo);
    $url_final_video = 'https://www.youtube.com/embed/' .$cortar_url; 

} elseif ($cantidad_url_video == '60') {
    $cortar_url = str_replace ('https://www.youtube.com/watch?v=','',$urlVideo);
    $url_final_video = 'https://www.youtube.com/embed/' .$cortar_url; 
} else {
    echo "URL INVALIDA";
    // Puedes redirigir o mostrar un mensaje de error según tus necesidades
}

$queryInsert = "INSERT INTO videos (nombreVideo, urlVideo, categoria, tags, tipo_video, id_usuario) 
                VALUES ('$nombreVideo', '$url_final_video', '$categoriaSeleccionada', '$tagsString', '$tipo_video', $id_usuario)";
$result = mysqli_query($con, $queryInsert);
if ($result) {
    header("Location: agregarVideo.php?success=1");
} else {
    header("Location: agregarVideo.php?error=1");
}
?>
