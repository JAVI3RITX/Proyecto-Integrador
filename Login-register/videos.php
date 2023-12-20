<?php
session_start();

// Incluir conexión a la base de datos
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

// Verificar si el usuario está logeado
$usuarioLogeado = isset($_SESSION['usuario']);

// Verificar si el usuario está logeado y asignar automáticamente el rol de "invitado" si no lo está
if (!$usuarioLogeado) {
    $_SESSION['rol'] = 'invitado';
}

// Obtener el nombre de usuario y el rol si está logeado
$nombreUsuario = $usuarioLogeado ? $_SESSION['usuario'] : null;
$rolUsuario = $usuarioLogeado ? $_SESSION['rol'] : 'invitado';

// Obtener la consulta de búsqueda desde la URL
$query = isset($_GET['query']) ? $_GET['query'] : '';
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
$tags = isset($_GET['tags']) ? $_GET['tags'] : '';
$ordenVistas = isset($_GET['ordenVistas']) ? $_GET['ordenVistas'] : '';
$ordenRating = isset($_GET['ordenRating']) ? $_GET['ordenRating'] : '';
$sqlVideo = "SELECT videos.*, AVG(comentarios.rating) AS rating_promedio
             FROM videos
             LEFT JOIN comentarios ON videos.id = comentarios.id_video
             WHERE videos.estado = 1";

// Agregar condiciones de filtro
if (!empty($query)) {
    $sqlVideo .= " AND nombreVideo LIKE '%$query%'";
}

if (!empty($categoria)) {
    $sqlVideo .= " AND categoria = '$categoria'";
}

if (!empty($tags)) {
    $sqlVideo .= " AND tags LIKE '%$tags%'";
}

// Otros filtros...

// Completar la consulta para usuarios (excluye videos privados)
if ($rolUsuario != 'administrador') {
    $sqlVideo .= " AND tipo_video <> 'privado'";
}

// Agrupar por el ID del video para calcular el rating promedio
$sqlVideo .= " GROUP BY videos.id";

// Ordenar por número de vistas
if ($ordenVistas == 'masVistas') {
    $sqlVideo .= " ORDER BY num_vistas DESC";
} elseif ($ordenVistas == 'menosVistas') {
    $sqlVideo .= " ORDER BY num_vistas ASC";
}

// Ordenar por rating promedio
if ($ordenRating == 'mejorRating') {
    $sqlVideo .= " ORDER BY rating_promedio DESC";
} elseif ($ordenRating == 'peorRating') {
    $sqlVideo .= " ORDER BY rating_promedio ASC";
}
// Ejecutar la consulta y manejar errores
$queryVideo = mysqli_query($con, $sqlVideo);

if (!$queryVideo) {
    // Manejar el error, imprimir mensaje o redirigir a una página de error
    die("Error en la consulta: " . mysqli_error($con));
}

// Resto del código para mostrar los resultados, iterar sobre $queryVideo, etc.
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pagina de Videos</title>
    <link rel="stylesheet" href="styles2.css">


    <style>
        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
            justify-content: center;
        }
        .video-title{
            text-align: center
        }

        .video-item {
            text-align:justify

        }
    </style>
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
            echo '<a href="auriolmain.php">Modificar cuenta</a>';
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
    <br>

<div class="container mt-5 pd-5">
<script>
    // Función para volver a la página anterior
    function volverAtras() {
        window.history.back();
    }
</script>
    <a class="btn-volver" onclick="volverAtras()">Volver </a>

        <h2 class="text-center">Pagina de Videos</h2>
        <form action="" method="get">
            <input type="text" name="query" placeholder="Buscar videos...">
            <select name="categoria">
                <option value="">Todas las categorías</option>
                <option value="categoria1">Categoria 1</option>
                <option value="categoria2">Categoria 2</option>
                <option value="categoria3">Categoria 3</option>
            </select>
            <input type="text" name="tags" placeholder="Buscar por tags...">
            <select name="ordenVistas">
                <option value="">Ordenar por vistas</option>
                <option value="masVistas">Más vistas primero</option>
                <option value="menosVistas">Menos vistas primero</option>
            </select>
            <select name="ordenRating">
            <option value="">Ordenar por rating</option>
            <option value="mejorRating">Mejor rating primero</option>
            <option value="peorRating">Peor rating primero</option>
            </select>
            <input type="submit" value="Buscar">
        </form>


        <hr>
        <div class="video-grid">
        <?php
        while ($dataVideo = mysqli_fetch_array($queryVideo)) {
            ?>
            <div class="video-item">
                <iframe width="350" height="200" src="<?php echo $dataVideo['urlVideo']; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <h3 class="video-title"><a href="ver_video.php?id=<?php echo $dataVideo['id']; ?>"><?php echo $dataVideo['nombreVideo']; ?></a></h3>
                <p class="video-info">
                    <span class="category">Categoría: <?php echo $dataVideo['categoria']; ?></span>
                    <br>
                    <span class="tags">Tags: <?php echo $dataVideo['tags']; ?></span>
                    <br>
                    <span class="rating">Rating Promedio: <?php echo number_format($dataVideo['rating_promedio'], 2); ?></span>
                    <br>
                    <span>Cantidad de vistas: <?php echo $dataVideo['num_vistas']; ?></span>
                    <br>
                </p>
            </div>
            <?php
         } ?>
            
        </div>
    </div>

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
