<?php
session_start();
require("php/conexion_be.php");

if (!isset($_SESSION['usuario'])) {
    header("Location: home.php");
    exit();
}

$usuario_id = $_SESSION['usuario'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["archivo"])) {
    $titulo = $_POST['titulo'];
    $estado = $_POST['estado'];
    $archivoNombre = $_FILES["archivo"]["name"];
    $archivoTmpNombre = $_FILES["archivo"]["tmp_name"];
    $archivoError = $_FILES["archivo"]["error"];

    // Verificar si hay un error en la subida del archivo
    if ($archivoError !== UPLOAD_ERR_OK) {
        $_SESSION['mensaje_error'] = 'Error al subir el archivo.';
        header('Location: subir_documento.php');
        exit();
    }

    // Obtener la extensión del archivo
    $extension = pathinfo($archivoNombre, PATHINFO_EXTENSION);

    // Definir los tipos de documentos permitidos
    $tiposDocumentoPermitidos = ['pdf', 'xls', 'xlsx'];

    // Verificar si la extensión está en la lista de tipos permitidos
    if (in_array(strtolower($extension), $tiposDocumentoPermitidos)) {
        $rutaAlmacenamiento = "uploads/";
        $archivoNombreFinal = $archivoNombre;
        $rutaFinal = $rutaAlmacenamiento . $archivoNombreFinal;

        // Mover el archivo al directorio de almacenamiento
        if (move_uploaded_file($archivoTmpNombre, $rutaFinal)) {
            // Insertar información del documento en la base de datos
            $tipoDocumento = pathinfo($archivoNombre, PATHINFO_EXTENSION);
            $sql = "INSERT INTO documentos (usuario_id, nombre_archivo, ruta_archivo, titulo, estado, tipo_documento) 
                    VALUES ('$usuario_id', '$archivoNombre', '$rutaFinal', '$titulo', '$estado', '$tipoDocumento')";
            $con->query($sql);

            $_SESSION['mensaje_exito'] = 'Documento subido exitosamente.';
            header('Location: subir_documento.php');
            exit();
        } else {
            $_SESSION['mensaje_error'] = 'Error al mover el archivo al directorio de almacenamiento.';
            header('Location: subir_documento.php');
            exit();
        }
    } else {
        $_SESSION['mensaje_error'] = 'El tipo de documento no es válido.';
        header('Location: subir_documento.php');
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
    <link rel="stylesheet" href="styless4.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        // Muestra la alerta de éxito
        if (isset($_SESSION['mensaje_exito'])) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: '{$_SESSION['mensaje_exito']}'
                });
                </script>";
            unset($_SESSION['mensaje_exito']);
}
        // Muestra la alerta de error
        elseif (isset($_SESSION['mensaje_error'])) {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{$_SESSION['mensaje_error']}'
                });
                </script>";
            unset($_SESSION['mensaje_error']);
}
        ?>

        <form action="subir_documento.php" method="POST" enctype="multipart/form-data">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" required>
            <br>
            <label for="estado">Estado:</label>
            <select name="estado" required>
                <option value="publico">Público</option>
                <option value="privado">Privado</option>
            </select>
            <br>
            <label for="archivo">Seleccionar Archivo:</label>
            <input type="file" name="archivo" accept=".pdf, .xls, .xlsx" required>
            <input type="submit" value="Subir archivo">
        </form>
        <center>
            <a href="ver_documentos.php">Ver mis documentos</a>
        </center>
    </div>

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
</body>

</html>