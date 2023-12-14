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

$usuario_id = $_SESSION['usuario'];

// Procesar la subida de documentos aquí
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['documento']) && isset($_POST['titulo'])) {
    $titulo = $_POST['titulo'];
    if (empty($titulo)) {
        $_SESSION['mensaje_error'] = 'El título del documento es obligatorio.';
        header("Location: subir_documento.php");
        exit();
    }

    $nombreArchivo = $_FILES['documento']['name'];
    $rutaArchivo = 'uploads/' . $nombreArchivo;
    $tipoArchivo = pathinfo($rutaArchivo, PATHINFO_EXTENSION);
    $estado = $_POST['estado'];

    // Verificar el tipo de archivo permitido
    if ($tipoArchivo != "pdf" && $tipoArchivo != "xlsx") {
        $_SESSION['mensaje_error'] = 'Solo se permiten archivos PDF y Excel (XLSX).';
        header("Location: subir_documento.php");
        exit();
    }

    if (move_uploaded_file($_FILES['documento']['tmp_name'], $rutaArchivo)) {
        // Insertar información del documento en la base de datos
        $sql = "INSERT INTO documentos (usuario_id, nombre_archivo, ruta_archivo, titulo, estado) VALUES ('$usuario_id', '$nombreArchivo', '$rutaArchivo', '$titulo', '$estado')";
        if ($con->query($sql) === TRUE) {
            $_SESSION['mensaje_exito'] = 'Documento subido con éxito.';
            header("Location: subir_documento.php");
            exit();
        } else {
            $_SESSION['mensaje_error'] = 'Error al subir el documento: ' . $con->error;
            header("Location: subir_documento.php");
            exit();
        }
    } else {
        $_SESSION['mensaje_error'] = 'Error al subir el archivo.';
        header("Location: subir_documento.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Documento</title>
    <link rel="stylesheet" href="style4.css">
    <script>
        function validarFormulario() {
            var inputFile = document.getElementById('documento');
            var tituloInput = document.getElementById('titulo');
            var filePath = inputFile.value;

            if (tituloInput.value.trim() === '') {
                alert('El título del documento es obligatorio.');
                return false;
            }

            var allowedExtensions = /(\.pdf|\.xlsx)$/i;

            if (!allowedExtensions.exec(filePath)) {
                alert('Solo se permiten archivos PDF y Excel (XLSX).');
                inputFile.value = '';
                return false;
            } else {
                return true;
            }
        }
    </script>
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
                <img src="imagenes/home.png" alt="home"style="width: 30px; height: 30px;">
            </a>
        </div>
    </header> 
    <br>
    <br>
    <br>

    <div class="container">
        <h1>Subir Documento</h1>
        <?php
        // Muestra el mensaje de éxito o error
        if (isset($_SESSION['mensaje_exito'])) {
            echo "<p class='mensaje-exito'>{$_SESSION['mensaje_exito']}</p>";
            unset($_SESSION['mensaje_exito']);
        } elseif (isset($_SESSION['mensaje_error'])) {
            echo "<p class='mensaje-error'>{$_SESSION['mensaje_error']}</p>";
            unset($_SESSION['mensaje_error']);
        }
        ?>
        <form method="post" action="" enctype="multipart/form-data" onsubmit="return validarFormulario();">
            <label for="titulo">Título del documento:</label>
            <input type="text" name="titulo" id="titulo" required>
            <br>
            <label for="estado">Selecciona el estado del documento:</label>
            <select name="estado" id="estado">
                <option value="publico">Público</option>
                <option value="privado">Privado</option>
            </select>
            <br>
            <label for="documento">Selecciona un documento:</label>
            <input type="file" name="documento" id="documento" accept=".pdf, .xlsx">
            <br>
            <input type="submit" value="Subir Documento">
        </form>
        <a href="ver_documentos.php">Ver mis documentos</a>
    </div>
</body>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<footer>
    <div class="footer-column">
        <h4>Videos de ayuda</h4>
        <ul>
            <li><a href="#">Como usar CANVA</a></li>
            <li><a href="#">Aprende a usar Word</a></li>
            <li><a href="#">Te ayudamos con Excel</a></li>
            <!-- Agrega más elementos de la lista según sea necesario -->
        </ul>
    </div>
    <div class="footer-column">
        <h4>Sobre Nosotros</h4>
        <ul>
            <li><a href="ayuda.php"> Quiénes somos?</a></li>
            <li><a href="#"> Preguntas Frecuentes</a></li>
            <!-- Agrega más elementos de la lista según sea necesario -->
        </ul>
    </div>
    <div class="footer-column">
        <h4>Contacto</h4>
        <ul>
            <li><a href="mailto:correos@gmail.com?Subject=Hola%20quisiera%20resolver%20una%20duda">Correo: videos@gmail.com</a></li>
            <li><a href="tel:+569 99999999">Teléfono: +569 99999999</a></li>
            <!-- Agrega más elementos de la lista según sea necesario -->
        </ul>
    </div>
</footer>
</html>