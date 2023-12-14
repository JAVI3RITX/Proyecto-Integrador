<?php
session_start();
require("php/conexion_be.php");

if (!isset($_SESSION['usuario'])) {
    // Manejar la situación cuando el usuario no está autenticado
    header("Location: home.php");
    exit();
}

function obtenerInfoArchivo($documento_id) {
    global $con;
    $sql = "SELECT nombre_archivo, ruta_archivo FROM documentos WHERE id = '$documento_id'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return array('nombre' => $row['nombre_archivo'], 'ruta' => $row['ruta_archivo']);
    } else {
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['documento_id'])) {
    $usuario_id = $_SESSION['usuario'];
    $documento_id = $_GET['documento_id'];

    // Verificar si el usuario ya descargó el documento
    $sql_check_download = "SELECT COUNT(*) as total FROM descargas WHERE usuario_id = '$usuario_id' AND documento_id = '$documento_id'";
    $result_check_download = $con->query($sql_check_download);
    $row_check_download = $result_check_download->fetch_assoc();

    $infoArchivo = obtenerInfoArchivo($documento_id);

    if ($infoArchivo) {
        $nombreArchivo = $infoArchivo['nombre'];
        $rutaArchivo = $infoArchivo['ruta'];

        // Incrementa el contador de descargas en la base de datos
        $sqlIncrementarDescargas = "UPDATE documentos SET descargas = descargas + 1 WHERE id = '$documento_id'";
        $con->query($sqlIncrementarDescargas);

        // Envía el archivo al usuario para descargar
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $nombreArchivo . '"');
        readfile($rutaArchivo);
    } else {
        echo "Documento no encontrado.";
    }
}
echo '<br><a href="ver_documentos.php">Volver a la lista de documentos</a>';
?>