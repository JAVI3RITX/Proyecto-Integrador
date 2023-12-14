<?php
session_start();
require("php/conexion_be.php");
if (!isset($_SESSION['usuario'])) {
    echo '
        <script>
            alert("Debes iniciar sesión para poder entrar a esta página");
            window.location = "home.php";
        </script>';
    session_destroy();
    die();
}

// Obtener el ID del documento a editar
$documento_id = isset($_GET['documento_id']) ? $_GET['documento_id'] : null;

// Realizar la lógica para obtener la información del documento
$sql = "SELECT * FROM documentos WHERE id = '$documento_id'";
$result = $con->query($sql);

// Verificar si el documento existe
if ($result->num_rows > 0) {
    $documento = $result->fetch_assoc();
} else {
    // Redirigir o mostrar un mensaje de error si el documento no existe
    echo "Documento no encontrado.";
    exit();
}

// Procesar el formulario de edición si se envió
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nuevoTitulo = $_POST['nuevo_titulo'];
    $nuevoEstado = $_POST['nuevo_estado'];

    // Realizar la lógica para actualizar la información en la base de datos
    $sql_update = "UPDATE documentos SET titulo = '$nuevoTitulo', estado = '$nuevoEstado' WHERE id = '$documento_id'";
    
    if ($con->query($sql_update) === TRUE) {
        // Redirigir o mostrar un mensaje de éxito
        echo '<script>
                alert("Documento actualizado con éxito.");
                window.location.href = "ver_documentos.php";
              </script>';
        exit();
    } else {
        echo "Error al actualizar el documento: " . $con->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Documento</title>
    <link rel="stylesheet" href="styles_editar.css">
</head>
<body>
    <header>
        <div class="navbar">
            <div class="dropdown" onclick="toggleDropdown()">
            <img src="imagenes/menu.png" alt="Menú" style="width: 30px; height: 30px;">
                <div class="dropdown-content" id="myDropdown">
                    <a href="#!">Modificar cuenta</a>
                    <a href="agregarVideo.php">Mis videos</a>
                    <a href="videos.php">Todos Los Videos</a>
                    <a href="ver_documentos.php">Mis documentos</a>
                    <a href="todos_los_documentos.php">Todos Los Documentos</a>
                    <a href="php\cerrar_sesion.php">Cerrar sesión</a>
                </div>
                </div>
            <a href="home.php" class="home-button">
                <img src="imagenes/home.png" alt="home">
            </a>
        </div>
    </header>
    <br>
    <br>
    <br>
   
    <div class="contenedor">
    <h1>Editar Documento</h1>
    <form method="post" action="">
        <label for="nuevo_titulo">Nuevo Título:</label>
        <input type="text" name="nuevo_titulo" value="<?php echo $documento['titulo']; ?>" required>
        <br>
        <label for="nuevo_estado">Nuevo Estado:</label>
        <select name="nuevo_estado" required>
            <option value="publico" <?php echo $documento['estado'] === 'publico' ? 'selected' : ''; ?>>Público</option>
            <option value="privado" <?php echo $documento['estado'] === 'privado' ? 'selected' : ''; ?>>Privado</option>
        </select>
        <br>
        <input type="submit" value="Guardar Cambios">
    </div>
    </form>
</body>
</html>