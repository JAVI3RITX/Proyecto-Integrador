<?php
    // desactivarVideo.php
    require("php/conexion_be.php");

    if(isset($_GET['idVideo']) && is_numeric($_GET['idVideo'])) {
        $idVideo = $_GET['idVideo'];

        // Actualiza el estado del video a "inactivo"
        $sqlDesactivarVideo = "UPDATE videos SET estado = 'inactivo' WHERE id = $idVideo";
        mysqli_query($con, $sqlDesactivarVideo);
    }

    // Redirige de vuelta a la página de videos
    header("Location: agregarVideo.php");
    exit();
?>
