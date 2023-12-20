<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles_noti222.css">
    <title>NOTICIA_2</title>
</head>
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
            <img src="imagenes/home.png" alt="home" style="width: 30px; height: 30px;">
        </a>
    </div>
</header>
<!--AQUI EMPIEZA MI CODIGO "HOME"--------------------------------------------->

<br>
<br>
<br>
<br>

<div class="carousel-container">
    <div class="carousel">
        <a href="noti1.php">
            <img src="banner1.jpg" alt="Imagen 1">
        </a>
        <a href="noti2.php">
            <img src="banner2.png" alt="Imagen 1">
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

<div class="containerrr">
    <h1>-NOTICIAS-</h1>
</div>

<div class="historia2">

    <div class="miDiv2">
        <h1>Universidad Central Amplía su Oferta Académica con un Impresionante Catálogo de Nuevas Carreras en 2024</h1>
    </div>

    <P>
        Fecha: 16 de septiembre de 2023
    </P>
    <p>
        La Universidad Central ha anunciado una expansión significativa de su oferta académica para el próximo año, con la incorporación de una variedad de nuevas carreras diseñadas para abordar las cambiantes demandas del mercado laboral y fomentar la diversidad de opciones educativas.
        El plan estratégico de crecimiento de la universidad incluirá la introducción de programas innovadores en diversas disciplinas, desde tecnología hasta artes liberales. Entre las nuevas carreras que se ofrecerán se encuentran Inteligencia Artificial Aplicada, Sostenibilidad Ambiental, Diseño de Experiencia del Usuario (UX), Ciencia de Datos para la Salud, y muchas más.
        El rector de la Universidad Central expresó su entusiasmo por esta iniciativa, destacando el compromiso de la institución con la adaptación constante a las necesidades del mundo actual. "En un entorno cambiante y altamente competitivo, es esencial que nuestra universidad ofrezca programas que preparen a los estudiantes para los desafíos del futuro. Estamos comprometidos a brindar oportunidades educativas que no solo sean relevantes, sino que también inspiren la innovación y la excelencia".
        La decisión de ampliar la oferta académica fue el resultado de un exhaustivo análisis de las tendencias del mercado laboral, consultas con expertos de la industria y retroalimentación de la comunidad estudiantil. Se espera que estas nuevas carreras no solo satisfagan las demandas del mercado, sino que también contribuyan al desarrollo de profesionales altamente capacitados y con habilidades especializadas.
        Además, la universidad planea implementar programas de apoyo, como mentorías y pasantías, para garantizar que los estudiantes tengan la oportunidad de aplicar sus conocimientos en entornos profesionales y adquieran experiencia práctica relevante.
        Este ambicioso proyecto de expansión no solo fortalecerá la posición de la Universidad Central como líder en educación superior, sino que también brindará a los estudiantes una amplia gama de opciones para seguir sus pasiones y metas profesionales en un mundo cada vez más diverso y tecnológicamente avanzado.
    </p>

    <div class="imagenDiv2">
        <img src="IMG\NOTI2.png" alt="Descripción de la imagen">
    </div>
</div>

<center>
    <!-- Botón con enlace a la página de inicio -->
    <a href="home.php" class="boton-home">HOME</a>
</center>
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