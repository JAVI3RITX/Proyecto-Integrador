<?php
session_start();
require("php/conexion_be.php");

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id_usuario'])) {
    // Redireccionar a la página de inicio de sesión u otra página
    header("Location: iniciar_sesion.php");
    exit();
}

// Obtener datos del formulario
$idVideo = $_POST['id_video'];
$idUsuario = $_SESSION['id_usuario']; // Obtén el ID de usuario desde la sesión
$comentario = mysqli_real_escape_string($con, $_POST['comentario']);
$rating = isset($_POST['rating']) ? intval($_POST['rating']) : 0; // Obtener el rating, si no está presente, establecerlo en 0

// Insertar comentario en la base de datos si existe un comentario
if (!empty($comentario)) {
    $sqlInsertarComentario = "INSERT INTO comentarios (id_video, id_usuario, comentario, rating) VALUES (?, ?, ?, ?)";
    $stmtInsertarComentario = mysqli_prepare($con, $sqlInsertarComentario);
    mysqli_stmt_bind_param($stmtInsertarComentario, "iisi", $idVideo, $idUsuario, $comentario, $rating);

    if (mysqli_stmt_execute($stmtInsertarComentario)) {
        // Redireccionar a la misma página para recargar
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    } else {
        echo "Error al guardar el comentario.";
    }
}

// Insertar solo el rating en la base de datos si no hay comentario
elseif ($rating > 0) {
    $sqlInsertarRating = "INSERT INTO comentarios (id_video, id_usuario, rating) VALUES (?, ?, ?)";
    $stmtInsertarRating = mysqli_prepare($con, $sqlInsertarRating);
    mysqli_stmt_bind_param($stmtInsertarRating, "iii", $idVideo, $idUsuario, $rating);

    if (mysqli_stmt_execute($stmtInsertarRating)) {
        // Redireccionar a la misma página para recargar
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    } else {
        echo "Error al guardar el rating.";
    }
} else {
    echo "Ni comentario ni rating fueron especificados.";
}

mysqli_close($con);
?>
