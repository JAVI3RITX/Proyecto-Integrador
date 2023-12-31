<?php
    session_start();
        require("php/conexion_be.php");
    // Si no existe la variable de sesión usuario, redirige a la página home.php
    if (!isset($_SESSION['usuario'])) {
        echo '
            <script>
                alert("Debes iniciar sesión para poder entrar a esta página");
                window.location = "home.php";
            </script>';
        session_destroy();
        die();
    }
    $rolUsuario = $_SESSION['rol'];
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Registrar Video</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="styles2.css">
</head>
<body>
<header>
        <div class="navbar">
            <div class="dropdown" onclick="toggleDropdown()">
            <img src="imagenes/menu.png" alt="Menú" style="width: 30px; height: 30px;">

<div class="dropdown-content" id="myDropdown">
                <div class="dropdown">


        
        <?php
        // Mostrar opciones comunes para todos los usuarios

        
        // Mostrar opciones específicas para el rol de administrador
        if ($rolUsuario == 'administrador') {          
            echo '<a href="admin.php">Modificar cuenta</a>';
            echo '<a href="agregarVideo.php">Mis videos</a>';
            echo '<a href="videos.php">Todos Los Videos</a>';
            echo '<a href="ver_documentos.php">Mis documentos</a>';
            echo '<a href="todos_los_documentos.php">Todos Los Documentos</a>';
            echo '<a href="php\cerrar_sesion.php">Cerrar sesión</a>';
        }

        // Mostrar opciones específicas para el rol de usuario
        if ($rolUsuario == 'usuario') {
            echo '<a href="usuariosedit.php">Modificar cuenta</a>';
            echo '<a href="agregarVideo.php">Mis videos</a>';
            echo '<a href="videos.php">Todos Los Videos</a>';
            echo '<a href="ver_documentos.php">Mis documentos</a>';
            echo '<a href="todos_los_documentos.php">Todos Los Documentos</a>';
            echo '<a href="php\cerrar_sesion.php">Cerrar sesión</a>';
        }

        // Mostrar opciones específicas para el rol de invitado
        if ($rolUsuario == 'invitado') {
            
        }
        ?>

    </div>
    </div>
            <a href="home.php" class="home-button">
                <img src="imagenes/home.png" alt="home">
            </a>
        </div>          
    </header> 
<body>
<div class="container mt-5 pd-5">
<script>
    // Función para volver a la página anterior
    function volverAtras() {
        window.history.back();
    }
</script>
    <a class="btn-volver" onclick="volverAtras()">Volver </a>
    <h2 class="text-center">Sube un video a la plataforma</h2>
    <hr>

    <form action="recibVideoYoutube.php" method="post" onsubmit="return validarFormulario()">
    <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id_usuario']; ?>">
    <div class="form-group">
        <label for="nombreVideo">Nombre del Video</label>
        <input type="text" name="nombreVideo" id="nombreVideo" class="form-control">
    </div>
    <div class="form-group">
        <label for="urlVideo">Pegar URL del Video <em>(Desde Youtube)</em></label>
        <input type="text" name="urlVideo" id="urlVideo" class="form-control">
    </div>
    <div class="form-group">
    <label for="categoria">Seleccionar Categoría</label>
    <select id="categoria" name="categoria" class="form-control">
        <option value="" disabled selected>Selecciona una categoría</option>
        <option value="Categoria1">Categoria 1</option>
        <option value="Categoria2">Categoria 2</option>
        <option value="Categoria3">Categoria 3</option>
    </select>
    </div>
    <div class="form-group">
    <label>Seleccionar Tags (puedes seleccionar varios)</label><br>
    <div class="btn-group-toggle" data-toggle="buttons">
        <?php
        $tagsDisponibles = ["Mineria", "Emprendimiento", "redes Sociales", "Marketing digital", "Contabilidad", "E-commerce", "tecnología", "Comunidad emprendedora"]; // Agrega más tags según sea necesario
        foreach ($tagsDisponibles as $tag) {
            echo '<label class="btn btn-outline-secondary">';
            echo '<input type="checkbox" name="tags[]" value="' . $tag . '"> ' . $tag;
            echo '</label>';
        }
        ?>
    </div>
  </div>
  <div class="form-group">
            <label>Tipo de Video:</label><br>
            <label class="radio-inline">
                <input type="radio" name="tipo_video" value="publico"> Público
            </label>
            <label class="radio-inline">
                <input type="radio" name="tipo_video" value="privado"> Privado
            </label>
        </div>
        <br>
      <div class="form-group mb-5">
        <button type="submit" class="btn btn-primary  btn-lg btn-block">Registrar Video</button>
    </div>

  </form>
    
</body>
<script src="validacion.js"></script>
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