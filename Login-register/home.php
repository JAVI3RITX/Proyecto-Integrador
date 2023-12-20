<?php
session_start();

// Incluir conexión a la base de datos
require("php/conexion_be.php");

$mostrarVerMas = !isset($_SESSION['usuario']) || (isset($_SESSION['rol']) && $_SESSION['rol'] !== 'administrador' && $_SESSION['rol'] !== 'usuario');

// Verificar si el usuario está logeado
$usuarioLogeado = isset($_SESSION['usuario']);

// Verificar si el usuario está logeado y asignar automáticamente el rol de "invitado" si no lo está
if (!$usuarioLogeado) {
    $_SESSION['rol'] = 'invitado';
}

// Obtener el nombre de usuario y el rol si está logeado
$nombreUsuario = $usuarioLogeado ? $_SESSION['usuario'] : null;
$rolUsuario = $usuarioLogeado ? $_SESSION['rol'] : 'invitado';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_homee.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>plantilla</title>
</head>
<body>
<header>
<div class="dropdown">
<img src="imagenes/menu.png" alt="Menú" style="width: 30px; height: 30px;">

    <div class="dropdown-content">

        
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

<?php
// Mostrar saludo personalizado según el rol
if ($rolUsuario == 'administrador') {
    echo '<p>Bienvenido administrador '  . '</p>';
    
} elseif ($rolUsuario == 'usuario') {
    echo '<p>Bienvenido ' . '</p>';

} elseif ($rolUsuario == 'invitado') {
    ?>
    <div class="logo">
<a href="index.php">Iniciar sesión</a>
<?php } ?>
    
</header> 
<br>
<br>
<br>
<!--AQUI EMPIEZA MI CODIGO "HOME"--------------------------------------------->

<div class="carousel-container">
    <div class="carousel">
        <a href="noti1.php">
            <img class="ima1" src="IMG\banner1.jpg" alt="BANNER 1">
        </a>
        <a class="ima2" href="noti2.php">
            <img class="ima2" src="IMG\banner2.png" alt="BANNER 2">
        </a>
        <!-- Aqui esta el codigo por si se quiere agregar otro banner
        <a href="..\HOTICIA 3\noti3.html">
            <img src="banner00.jpg" alt="Imagen 1">
        </a>
        -->        
        <!-- Agrega más imágenes según sea necesario -->
    </div>
    <div class="carousel-btn prev" onclick="prevSlide()">&#10094;</div>
    <div class="carousel-btn next" onclick="nextSlide()">&#10095;</div>
</div>
<br>
<div class="videooo">
    <h1>-HOME-</h1>
    <div class="videos">
        <video class="video" width="320" height="200" controls>
            <source src="Videos\video1.mp4" type="video/mp4">
        </video>
        <video class="video" width="320" height="200" controls>
            <source src="Videos\video2.mp4" type="video/mp4">
        </video>
    </div>

    <center>
        <?php if ($mostrarVerMas) : ?>
            <a href="index.php" class="btn-subir">¿Quieres ver mas videos?<br>Registrate</a>
        <?php endif; ?> 
    </center>



</div>

<div id="titulooo">
    <h1>-PLATAFORMAS AMIGAS-</h1>
</div>

<div class="orange-container"> <!--AQUI VAN LAS plataformas amigas-->
    <a href="https://www.ucentral.cl" class="black-square">
        <div class="contentt">
            <img src="IMG\ucen.png" alt="UCEN" class="img">
            <div class="text" >
                <h3 >UCENTRAL</h3>
                <p class="oculto">La UCEN es una de las universidades privadas más antiguas de Chile, está acreditada por 4 años y es parte del Sistema de Acceso a la educación superior.</p>
            </div>
        </div>
    </a>
    <a href="https://www.municoquimbo.cl/index.php/noticias/desarrollo/fomento-productivo" class="black-square">
        <div class="contentt">
            <img src="IMG\muni.png" alt="MUNI">
            <div class="text">
                <h3>La unidad de Fomento Productivo</h3>
                <p>La unidad de Fomento Productivo tiene como mision fomentar y promover el desarrollo económico local a través de la articulación de iniciativas orientadas al desarrollo productivo y la capacidad emprendedora.</p>
            </div>
        </div>
    </a>
    <a href="https://www.sercotec.cl" class="black-square">
        <div class="contentt">
            <img src="IMG\sercotec.png" alt="SERCOTEC">
            <div class="text">
                <h3>SERCOTEC</h3>
                <p>Sercotec ofrece a los pequeños empresarios y emprendedores del país, hombres y mujeres, apoyo para fortalecer su capacidad de gestión y desarrollar sus negocios.</p>
            </div>
        </div>
    </a>
</div>

<div class="orange-container"> <!--AQUI VAN LAS plataformas amigas segunda lineaa-->
    <a href="https://www.youtube.com/@ucenregioncoquimbo1754" class="black-square">
        <div class="contentt">
            <img src="IMG\YOUTUBE.png" alt="youtube ucen">
            <div class="text">
              <h3>YouTube UCEN</h3>
              <p>En el canal de youtube de la universidad central podras encontrar mucha variedad de videos sobre marketing digital, la metodologia de negocios, etc.</p>
            </div>
        </div>
    </a>
    <a href="https://www.youtube.com/@HECTORSEPULVEDA" class="black-square">
        <div class="contentt">
            <img src="IMG\HECTOR.png" alt="youtube hector">
            <div class="text">
                <h3>HECTOR SEPULVEDA</h3>
                <p>Actividades y contenidos relacionados con Pitch, Narrativas Comerciales, Storytelling, enfocado en las metodologías Power Pitch y Storytellinc de autoría de Héctor Sepúlveda.</p>
            </div>
        </div>
    </a>
    <a href="https://www.youtube.com/@centrodenegociossercotecco2536" class="black-square">
        <div class="contentt">
            <img src="IMG\CENTROS.png" alt="youtube Centro de Negocios Sercotec Coquimbo">
            <div class="text">
                <h3>Centro de Negocios Sercotec Coquimbo</h3>
                <p>Canal de You Tube del Centro de Negocios Sercotec Coquimbo.
                    ¡Mira acá las historias de emprendedoras y emprendedores que con nuestro apoyo potenciaron su negocio!</p>
            </div>
        </div>
    </a>
</div>

<div id="titulooo">
    <h1>-HERRAMIENTAS-</h1>
</div>

<div class="orange-container"> <!--AQUI VAN LAS HERRAMIENTAS-->
    <a href="https://www.canva.com/es_es/login/" class="black-square">
        <div class="contentt">
            <img src="IMG\canva.png" alt="canva">
            <div class="text">
              <h3>CANVA</h3>
              <p>Canva es una web de diseño gráfico y composición de imágenes para la comunicación fundada en 2012, y que ofrece herramientas online para crear tus propios diseños, tanto si son para ocio como si son profesionales. Su método es el de ofrecer un servicio freemium, que puedes utilizar de forma gratuita, pero con la alternativa de pagar para obtener opciones avanzadas.</p>
            </div>
        </div>
    </a>
    <a href="https://designthinking.es/" class="black-square">
        <div class="contentt">
            <img src="IMG\Design.png" alt="Design thinking">
            <div class="text">
                <h3>Design Thinking</h3>
                <p>Somos Dinngo, tu departamento externo de innovacion. Con foco en metodos como Desing Thinking o Lean Startup, ayudamos a organizaciones a crear productos y servicios innovadores y de exito.</p>
            </div>
        </div>
    </a>
    <a href="https://www.google.com/intl/es/drive/" class="black-square">
        <div class="contentt">
            <img src="IMG\deive.png" alt="drive">
            <div class="text">
                <h3>DRIVE</h3>
                <p>Drive puede proporcionar un acceso cifrado y seguro a tus archivos. Los archivos compartidos contigo se pueden analizar de forma proactiva y eliminar cuando se detecte software malicioso, spam, ransomware o suplantación de identidad (phishing).</p>
            </div>
        </div>
    </a>
</div>

<div id="titulooo">
    <h1>-QUIENES SOMOS-</h1>
</div>

<div class="about-us-container"> <!--AQUI VA QUIENES SOMOS-->
    <div class="about-us">
        <div class="image-container">
            <img src="IMG\uni.jpg" alt="Imagen Quiénes Somos">
        </div>
        <div class="text-container">
            <br>
            <p class="corto">La Universidad Central de Chile forma ciudadanos integrales con valores de tolerancia y diversidad.</p>
            <p class="largo">Nos definimos como entusiastas de la Ingeniería Civil en Computación e Informática, actualmente avanzando en nuestro cuarto año en la Universidad Central de Coquimbo. En este viaje académico, nos sumergimos en las complejidades de la tecnología, especializándonos en disciplinas como HTML, CSS y JavaScript. Estas herramientas no solo son códigos para nosotros; son puentes hacia la creación, el diseño y la interactividad. Además, exploramos el vasto mundo de las bases de datos, aprovechando su poder para estructurar y gestionar información vital en nuestros proyectos. Nos impulsa la pasión por la programación y la resolución de problemas, y estamos comprometidos a llevar la innovación a nuevos horizontes. Únete a nosotros mientras exploramos el fascinante mundo donde la creatividad se encuentra con el código. 🌐💻✨</p>
            <br>
            <p class="largo">La Universidad Central de Chile (UCEN) es una institución de educación superior de carácter nacional y privado —sin fines de lucro— que asume la formación académica desde un alto compromiso con el país para entregar a su patria un ciudadano con conciencia social, promotor de los valores de tolerancia, pluralismo y equidad, así como también del respeto y aceptación de la diversidad en todos los ámbitos de su quehacer. La UCEN tiene como valor fundacional la formación integral de sus estudiantes. Esta implica una perspectiva de aprendizaje intencionada, tendiente al fortalecimiento de una personalidad responsable, crítica, participativa, creativa, solidaria y con capacidad de reconocer e interactuar con su entorno y así construir su identidad cultural. Busca promover el crecimiento humano a través de un proceso que supone una visión multidimensional de la persona y tiende a desarrollar aspectos como la inteligencia emocional, intelectual, social, material y ética-valoral. También resulta de vital importancia el papel de la corporación como centro irradiador y difusor del conocimiento, arte, el deporte, las tradiciones y la historia patria en la sociedad. </p>
        </div>
    </div>
</div>

<script src="scriptt.js"></script>
    
<!--AQUI TERMINA MI CODIGO "HOME"-------------------------------------------->
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
            <li><a href="home.php"> Quiénes somos?</a></li>
            <li><a href="ayudamain.php"> Preguntas Frecuentes</a></li>
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
<button onclick="topFunction()" id="myBtn" title="Go to top" style="display: none;">
    <img src="up.png" alt="Go to top">
</button>

    <script>
        window.onscroll = function() {scrollFunction()};

        function scrollFunction() {
            var mybutton = document.getElementById("myBtn");
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }

        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>

</html>

