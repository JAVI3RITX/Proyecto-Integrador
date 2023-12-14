<?php
// editar_video.php

// Incluye la conexión a la base de datos y funciones de manejo de datos
require("php/conexion_be.php");

// Verifica si se ha proporcionado un ID en la URL
if (isset($_GET['id'])) {
    $idVideo = $_GET['id'];

    // Consulta SQL para obtener los datos del video
    $sqlEditarVideo = "SELECT * FROM videos WHERE id = " . mysqli_real_escape_string($con, $idVideo);
    $queryEditarVideo = mysqli_query($con, $sqlEditarVideo);

    // Verifica si el video existe
    if ($dataEditarVideo = mysqli_fetch_array($queryEditarVideo)) {
        // Los datos del video están disponibles, puedes mostrar el formulario de edición
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Verifica si se ha enviado el formulario de edición

            // Recupera los datos del formulario
            $nuevoNombreVideo = mysqli_real_escape_string($con, $_POST['nombreVideo']);
            $nuevaCategoria = mysqli_real_escape_string($con, $_POST['categoria']);
            $nuevosTags = isset($_POST['tags']) ? implode(', ', $_POST['tags']) : '';
            $nuevoTipoVideo = mysqli_real_escape_string($con, $_POST['tipo_video']);
            
            // Consulta SQL para actualizar los datos del video
            $sqlActualizarVideo = "UPDATE videos SET nombreVideo = '$nuevoNombreVideo', categoria = '$nuevaCategoria', tags = '$nuevosTags', tipo_video = '$nuevoTipoVideo' WHERE id = $idVideo";
            $queryActualizarVideo = mysqli_query($con, $sqlActualizarVideo);

            if ($queryActualizarVideo) {
                // Redirige al usuario a la página agregarVideo.php
                header("Location: agregarVideo.php");
                exit();
            } else {
                echo "Error al actualizar los datos del video: " . mysqli_error($con);
            }
        }
    } else {
        // Maneja el caso en que el video no existe
        echo "Video no encontrado.";
        exit();
    }
} else {
    // Maneja el caso en que no se proporciona un ID
    echo "ID de video no especificado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Editar Video</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="styles2.css">
</head>
<body>
    <header>
        <div class="navbar">
            <div class="dropdown" onclick="toggleDropdown()">
                <img src="imagenes/menu.png" alt="Menú">
                <div class="dropdown-content" id="myDropdown">
                    <a href="#!">Cuenta</a>
                    <a href="agregarVideo.php">Mis videos</a>
                    <a href="#!">Mis documentos</a>
                    <a href="#!">Modificar cuenta</a>
                    <a href="videos.php">Todos Los Videos</a>
                    <a href="php\cerrar_sesion.php">Cerrar sesión</a>
                </div>
            </div>
            <a href="home.php" class="home-button">
                <img src="imagenes/home.png" alt="home">
            </a>
        </div>
    </header>


    
    <!-- Formulario de edición -->
    <form action="" method="post">
        <br>
        <br>
        <br>
        <div class="container mt-5 pd-5">
            <h2 class="text-center">Editar un video en la plataforma</h2>
            <hr>

            <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id_usuario']; ?>">
            
            <div class="form-group">
                <label for="nombreVideo">Nombre del Video</label>
                <input type="text" name="nombreVideo" id="nombreVideo" class="form-control" value="<?php echo $dataEditarVideo['nombreVideo']; ?>" required>
            </div>
            
            
            <div class="form-group">
                <label for="categoria">Seleccionar Categoría</label>
                <select id="categoria" name="categoria" class="form-control">
                    <option value="" disabled selected>Selecciona una categoría</option>
                    <option value="Categoria1" <?php echo ($dataEditarVideo['categoria'] == 'Categoria1') ? 'selected' : ''; ?>>Categoria 1</option>
                    <option value="Categoria2" <?php echo ($dataEditarVideo['categoria'] == 'Categoria2') ? 'selected' : ''; ?>>Categoria 2</option>
                    <option value="Categoria3" <?php echo ($dataEditarVideo['categoria'] == 'Categoria3') ? 'selected' : ''; ?>>Categoria 3</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Seleccionar Tags (puedes seleccionar varios)</label><br>
                <div class="btn-group-toggle" data-toggle="buttons">
                    <?php
                    $tagsDisponibles = ["Mineria", "Emprendimiento", "redes Sociales", "Marketing digital", "Contabilidad", "E-commerce", "tecnología", "Comunidad emprendedora"]; // Agrega más tags según sea necesario
                    foreach ($tagsDisponibles as $tag) {
                        echo '<label class="btn btn-outline-secondary">';
                        echo '<input type="checkbox" name="tags[]" value="' . $tag . '" ' . (in_array($tag, explode(', ', $dataEditarVideo['tags'])) ? 'checked' : '') . '> ' . $tag;
                        echo '</label>';
                    }
                    ?>
                </div>
            </div>
            
            <div class="form-group">
                <label>Tipo de Video:</label><br>
                <label class="radio-inline">
                    <input type="radio" name="tipo_video" value="publico" <?php echo ($dataEditarVideo['tipo_video'] == 'publico') ? 'checked' : ''; ?>> Público
                </label>
                <label class="radio-inline">
                    <input type="radio" name="tipo_video" value="privado" <?php echo ($dataEditarVideo['tipo_video'] == 'privado') ? 'checked' : ''; ?>> Privado
                </label>
            </div>
            
            <div class="form-group mb-5">
                <button type="submit" class="btn btn-primary btn-lg btn-block">Guardar Cambios</button>
            </div>
        </div>
    </form>
    
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



