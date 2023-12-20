<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles_noti111.css">
    <title>NOTICIA_1</title>
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
            <img src="banner2.png" alt="Imagen 2">
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

<div class="containerr">
    <h1>-NOTICIAS-</h1>
</div>

<div class="historia">

    <div class="miDiv">
        <h1>Histórico Anuncio en la Universidad Central: Gratuidad Total para Todos sus Estudiantes</h1>
    </div>

    <P>
        Fecha: 27 de noviembre de 2023
    </P>
    <p>
        En un hecho sin precedentes, la Universidad Central ha anunciado la implementación de la gratuidad total para todos sus estudiantes a partir del próximo semestre académico. Este audaz movimiento ha sido recibido con entusiasmo y celebración en toda la comunidad educativa.

        La decisión, tomada por el cuerpo directivo de la institución, representa un hito significativo en el compromiso de la Universidad Central con la democratización de la educación superior. La medida busca eliminar las barreras económicas que a menudo impiden el acceso a la educación universitaria de calidad.
        
        La gratuidad cubrirá la totalidad de los costos asociados con la matrícula, aranceles, materiales de estudio y otros gastos relacionados con la formación académica. Este gesto audaz se alinea con la visión de la universidad de convertirse en un faro de igualdad de oportunidades y movilidad social.
        
        El rector de la Universidad Central, en una conferencia de prensa emocionante, expresó su satisfacción por este paso hacia adelante. "La educación es el motor que impulsa el progreso y la equidad en nuestra sociedad. Al hacer que la universidad sea accesible para todos, estamos construyendo un futuro más brillante y justo para nuestros estudiantes y, en última instancia, para nuestra nación".
        
        El anuncio también incluye un compromiso continuo de mejorar la calidad académica y las instalaciones de la universidad, asegurando que la gratuidad no comprometa la excelencia educativa. La Universidad Central planea establecer becas adicionales para aquellos que necesiten apoyo adicional, garantizando que la diversidad de talentos y perspectivas siga enriqueciendo el campus.
        
        Esta noticia ha sido aclamada por diversos sectores de la sociedad, incluyendo líderes gubernamentales, organizaciones estudiantiles y la comunidad académica en general. Se espera que este ejemplo inspire a otras instituciones educativas a considerar medidas similares para hacer que la educación superior sea más accesible para todos.
    </p>

    <div class="imagenDiv">
        <img src="IMG\NOTI1.jpg" alt="Descripción de la imagen">
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