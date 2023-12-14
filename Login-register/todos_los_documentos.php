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
    die();}

// Obtener el término de búsqueda si se proporciona
$busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';

// Consulta SQL base para mostrar documentos públicos
$sql = "SELECT id, usuario_id, nombre_archivo, ruta_archivo, titulo FROM documentos WHERE estado = 'publico'";

// Agregar condición de búsqueda si se proporciona un término
if (!empty($busqueda)) {
    $sql .= " AND titulo LIKE '%$busqueda%'";
}

// Obtener el rol del usuario desde la sesión
$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : 'usuario';

// Ajustar la consulta según el rol del usuario
if ($rol === 'administrador') {
    $sql = "SELECT id, usuario_id, nombre_archivo, ruta_archivo, titulo FROM documentos";
}

$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos los Documentos</title>
    <link rel="stylesheet" href="style_documentos.css">
    <script>
        function descargarDocumento(ruta) {
            window.location.href = ruta;
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
        <h1>Todos los Documentos</h1>
        <form action="todos_los_documentos.php" method="GET">
            <label for="busqueda">Buscar por título:</label>
            <input type="text" name="busqueda" id="busqueda">
            <input type="submit" value="Buscar">
        </form>
        <table>
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Documento</th>
                    <th>Titulo</th>
                    <th></th> 
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['usuario_id']}</td>
                            <td>{$row['nombre_archivo']}</td>
                            <td>{$row['titulo']}</td>
                            <td><span class='descargar-documento' onclick='descargarDocumento(\"{$row['ruta_archivo']}\", \"{$row['nombre_archivo']}\");'>Descargar</span></td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    
    <script src="scripts_documentos.js"></script>
    
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