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

    // Verificar si el documento pertenece al usuario antes de eliminarlo
    $sql = "SELECT nombre_archivo FROM documentos";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // Documento pertenece al usuario, eliminar el documento
        $sql_delete = "DELETE FROM documentos WHERE id = '$documento_id'";
        if ($con->query($sql_delete) === TRUE) {
            echo '<script>
                    alert("Documento eliminado con éxito.");
                    window.location.href = "ver_documentos.php";
                  </script>';
        } else {
            echo "Error al eliminar el documento: " . $con->error;
        }
    } else {
        echo "Error: El documento no pertenece al usuario.";
    }
} else {
    echo "Error: Se requiere el ID del documento.";
}

echo '<br><a href="ver_documentos.php">Volver a la lista de documentos</a>';
?>
