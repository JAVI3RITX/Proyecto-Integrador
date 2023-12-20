<?php
session_start();
require("php/conexion_be.php");

if (!isset($_SESSION['usuario'])) {
    header("Location: home.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['documento_id'])) {
    $usuario_id = $_SESSION['usuario'];
    $documento_id = $_GET['documento_id'];

    // Verificar si el documento pertenece al usuario antes de "eliminarlo"
    $sql = "SELECT nombre_archivo FROM documentos WHERE id = '$documento_id'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // Documento pertenece al usuario, actualizar el estado del documento
        $sql_update = "UPDATE documentos SET documento_estado = 0 WHERE id = '$documento_id'";
        if ($con->query($sql_update) === TRUE) {
            // Redirigir a la página de documentos
            echo '<script>
                    window.location.href = "ver_documentos.php";
                  </script>';
        } else {
            echo "Error al marcar el documento como eliminado: " . $con->error;
        }
    } else {
        echo "Error: El documento no pertenece al usuario.";
    }
} else {
    echo "Error: Se requiere el ID del documento.";
}
?>
