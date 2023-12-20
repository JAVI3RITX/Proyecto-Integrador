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

    // Consulta SQL para seleccionar videos y calcular el rating promedio
    if ($rolUsuario === 'administrador') {
        // Si es administrador, mostrar todos los videos
            // Consulta SQL modificada para incluir el estado del video y excluir los videos inactivos
        $sqlVideo = "SELECT videos.*, AVG(comentarios.rating) AS rating_promedio
        FROM videos
        LEFT JOIN comentarios ON videos.id = comentarios.id_video
        WHERE videos.estado = 1  -- Cambia la condición a 1 para videos activos
        GROUP BY videos.id
        ORDER BY videos.id DESC";


    } else {
        // Obtén el ID del usuario en sesión
        $idUsuario = $_SESSION['id_usuario'];
        // Consulta SQL modificada para seleccionar solo los videos del usuario en sesión y calcular el rating promedio
        $sqlVideo = "SELECT videos.*, AVG(comentarios.rating) AS rating_promedio
        FROM videos
        LEFT JOIN comentarios ON videos.id = comentarios.id_video
        WHERE videos.id_usuario = $idUsuario AND videos.estado = 1
        GROUP BY videos.id
        ORDER BY videos.id DESC";

        
    }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Registrar Video</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous">
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
    

    <?php
    $queryVideo = mysqli_query($con, $sqlVideo);
    ?>
    
    <br>   
    <br>
    <script>
    // Función para volver a la página anterior
    function volverAtras() {
        window.history.back();
    }
</script>
    <a class="btn-volver" onclick="volverAtras()">Volver </a>
    <h2 class="text-center mt-5 mb-3">Mis Videos</h2>
    <a href="formularioVideos.php" class="btn-subir">Subir Video</a>

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Titulo Video</th>
                    <th>Video</th>
                    <th>Categoria</th>
                    <th>Tags</th>
                    <th>Tipo de video</th>
                    <th>Rating </th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($dataVideo = mysqli_fetch_array($queryVideo)) {
                ?>
                <tr>
                    <td><?php echo $dataVideo['nombreVideo']; ?></td>
                    <td>
                        <iframe width="350" height="200" src="<?php echo $dataVideo['urlVideo']; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </td>
                    <td><?php echo $dataVideo['categoria']; ?></td>
                    <td><?php echo $dataVideo['tags']; ?></td>
                    <td><?php echo $dataVideo['tipo_video']; ?></td>
                    <td><?php echo round($dataVideo['rating_promedio'], 2); ?></td>
                    <td>
                
                <a href="#" class="btn-delete" onclick="confirmarEliminar(<?php echo $dataVideo['id']; ?>)">
    <i class="fas fa-trash-alt"></i> <!-- Ícono de la papelera -->
</a>
<br>
<br>
<br>
<a href="#" class="btn btn-primary btn-sm" onclick="confirmarEditar(<?php echo $dataVideo['id']; ?>)">
    <i class="fas fa-edit"></i>
</a>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmarEliminar(idVideo) {
        Swal.fire({
            title: '¿Estás seguro que deseas eliminar el Video?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirigir a desactivarVideo.php con el ID del video
                window.location.href = `desactivarVideo.php?idVideo=${idVideo}`;
            }
        });
        return false; // Evita que el enlace se siga ejecutando normalmente
    }

    function confirmarEditar(idVideo) {
        Swal.fire({
            title: '¿Quieres editar este Video?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, editar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirigir a editar_video.php con el ID del video
                window.location.href = `editar_video.php?id=${idVideo}`;
            }
        });
        return false; // Evita que el enlace se siga ejecutando normalmente
    }
</script>
                </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
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
