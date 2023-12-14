
<?php
    session_start();

    // Incluir conexión a la base de datos
    require("php/conexion_be.php");

    if (!isset($_SESSION['usuario'])) {
        // Manejar la situación cuando el usuario no está autenticado
        header("Location: home.php");
        exit();
    }

    // Obtener el ID del video desde la URL
    $idVideo = isset($_GET['id']) ? $_GET['id'] : null;

    // Consulta SQL para obtener la información del video específico
    $sqlVideo = "SELECT * FROM videos WHERE id = " . mysqli_real_escape_string($con, $idVideo);
    $queryVideo = mysqli_query($con, $sqlVideo);

    // Verificar si el video existe
    if ($dataVideo = mysqli_fetch_array($queryVideo)) {
        $nombreVideo = $dataVideo['nombreVideo'];
        $urlVideo = $dataVideo['urlVideo'];
        // Otras variables que puedas necesitar...
    } else {
        // Manejar el caso en que el video no existe
        echo "Video no encontrado.";
        exit();
    }

      // Consulta SQL para obtener todos los comentarios relacionados con el video
      $sqlComentarios = "SELECT comentarios.*, usuarios.nombre AS nombre_usuario FROM comentarios 
      INNER JOIN usuarios ON comentarios.id_usuario = usuarios.id
      WHERE comentarios.id_video = " . mysqli_real_escape_string($con, $idVideo);
$resultComentarios = mysqli_query($con, $sqlComentarios);

mysqli_close($con);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $nombreVideo; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

    <style>
   
   
    .video-full {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 400px; /* o cualquier altura que desees */
}
    .video-container {
        text-align: center;
    }
    .comentarios {
    margin-top: 20px;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 5px;
}

    
.comentarios ul {
    list-style-type: none;
    padding: 0;
}

.comentarios li {
    margin-bottom: 10px;
}
.comment {
    background-color: #f9f9f9; /* Cambia el color de fondo */
    border: 1px solid #ddd; /* Cambia el borde */
    padding: 15px; /* Cambia el relleno */
}

.comment-body {
    color: #333; /* Cambia el color del texto */
    font-size: 14px; /* Cambia el tamaño de la fuente */
}   
h1, h2, h3 {
    
    text-align: center;
    color: rgb(255,82 ,0 );
}
/* Centra el formulario en la página */
.form-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Estiliza el formulario */
form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* Estiliza el textarea */
textarea {
    width: 100%;
    max-width: 800px;
    margin-bottom: 10px;
}

/* Estiliza el botón de enviar */
input[type="submit"] {
    align-self: c;
}

.rating {
    display: flex;
    justify-content: center;
    margin-top: 10px;
}

.rating input {
    display: none;
}

.rating label {
    cursor: pointer;
    font-size: 30px;
}

.rating label:before {
    content: '\2605'; /* Código Unicode para el símbolo de estrella */
    margin: 5px;
}

.rating input:checked ~ label:before {
    color: gold;
}


.compartir-enlace {
    text-align: center;
    margin-top: 20px;
}

.compartir-enlace h3 {
    color: rgb(255, 82, 0);
}

.compartir-enlace input {
    width: 100%;
    max-width: 400px; /* Ajusta el ancho del campo de texto según sea necesario */
    margin-bottom: 10px;
}

.compartir-enlace button {
    padding: 2px;
    cursor: pointer;
}
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Función para mostrar una alerta de SweetAlert2
        function mostrarAlerta(mensaje, tipo) {
            Swal.fire({
                icon: tipo,
                text: mensaje,
                timer: 2000,
                showConfirmButton: false
            });
        }

        // Función para limpiar el formulario después de enviarlo
        function limpiarFormulario() {
            document.getElementById("comentario").value = "";
            $("input[name='rating']").prop("checked", false);
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

    <div class="container mt-5 pd-5">
    <h2 class="text-center"><?php echo $nombreVideo; ?></h2>
    <hr>
<br>
    <div class="video-full">
        <iframe width="800" height="450" src="<?php echo $urlVideo; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
</div>
<br>
<div class="compartir-enlace">
    <input type="text" id="enlaceVideo" value="<?php echo $urlVideo; ?>" readonly>
    <button onclick="copiarEnlace()">Copiar Enlace</button>
</div>
<br>
<br>
    <h2>Deja tu comentario</h2>

    <form action="procesar_comentario.php" method="post">
    <input type="hidden" name="id_video" value="<?php echo $idVideo; ?>">
    <!-- Puedes incluir otros campos del formulario según tus necesidades -->
    
    <textarea name="comentario" id="comentario" rows="4"></textarea>

    <br>

 <!-- Agregar esto después del textarea en el formulario de comentarios -->
<div class="rating">
    <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 stars"></label>
    <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 stars"></label>
    <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 stars"></label>
    <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 stars"></label>
    <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star"></label>
</div>

    <br>

    <input type="submit" value="Enviar Comentario">
</form>





<div class="comentarios">
    <h3>Comentarios</h3>
    <hr>
    <br>
    <?php
    // Mostrar todos los comentarios asociados al video
    while ($comentario = mysqli_fetch_assoc($resultComentarios)) {
        echo "<p><strong>" . $comentario['nombre_usuario'] . "</strong> "  . "</p>";
        echo "<p><strong>Comentario:</strong> " . $comentario['comentario'] . "</p>";
        echo "<p><strong>Rating:</strong> ";
        // Imprimir estrellas en lugar de número
        for ($i = 1; $i <= $comentario['rating']; $i++) {
            echo "<span class='fa fa-star checked'></span>";
        }
        echo "</p>";
        echo "<hr>";
    }
    ?>
</div>
<script>
    function copiarEnlace() {
        var enlaceVideo = document.getElementById("enlaceVideo");

        // Seleccionar el contenido del campo de texto
        enlaceVideo.select();
        enlaceVideo.setSelectionRange(0, 99999); /* Para dispositivos móviles */

        // Copiar el contenido al portapapeles
        document.execCommand("copy");

        // Mostrar mensaje de éxito
        alert("Enlace copiado al portapapeles: " + enlaceVideo.value);
    }
</script>
        
    </body>

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
                <li><a href="#"> aaaaaaaaaaaaa</a></li>
                <!-- Agrega más elementos de la lista según sea necesario -->
            </ul>
        </div>
        <div class="footer-column">
            <h4>Contacto</h4>
            <ul>
                <li><a href="mailto:correos@gmail.com?Subject=Hola%20quisiera%20resolver%20una%20duda">Correo: videos@gmail.com</a></li>
                <li><a href="tel:+56948835577">Teléfono: +569 99999999</a></li>
                <!-- Agrega más elementos de la lista según sea necesario -->
            </ul>
        </div>
    </footer>
</html>

