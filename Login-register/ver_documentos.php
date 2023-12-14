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
    die();


// Verificar si el usuario está logeado
$usuarioLogeado = isset($_SESSION['usuario']);
    
// Verificar si el usuario está logeado y asignar automáticamente el rol de "invitado" si no lo está
if (!$usuarioLogeado) {
        $_SESSION['rol'] = 'invitado';
}
    
// Obtener el nombre de usuario y el rol si está logeado
$nombreUsuario = $usuarioLogeado ? $_SESSION['usuario'] : null;
$rolUsuario = $usuarioLogeado ? $_SESSION['rol'] : 'invitado';
}

$usuario_id = $_SESSION['usuario'];

// Obtener la lista de documentos del usuario
$sql = "SELECT id, nombre_archivo, ruta_archivo, titulo, estado FROM documentos WHERE usuario_id = '$usuario_id'";
$result = $con->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Documentos</title>
    <link rel="stylesheet" href="style_documentos.css">
    <script>
        function confirmarEliminar(documento_id) {
            var confirmar = confirm('¿Seguro que quieres eliminar este documento?');
            if (confirmar) {
                window.location.href = 'eliminar_documento.php?documento_id=' + documento_id;
            }
        }

        function descargarDocumento(ruta) {
            window.location.href = ruta;

        }

       function editarDocumento(documento_id) {         
            window.location.href = 'editar_documento.php?documento_id=' + documento_id; }

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
        <h1>Mis documentos</h1>
        <?php
        // Muestra el mensaje de éxito o error
        if (isset($_SESSION['mensaje_exito'])) {
            echo "<p class='mensaje-exito'>{$_SESSION['mensaje_exito']}</p>";
            unset($_SESSION['mensaje_exito']); 
        } elseif (isset($_SESSION['mensaje_error'])) {
            echo "<p class='mensaje-error'>{$_SESSION['mensaje_error']}</p>";
            unset($_SESSION['mensaje_error']); 
        }
        ?>
        <table>
            <thead>
                <tr>
                    <th>Documentos</th>
                    <th>Estado</th>
                    <th>Eliminar</th>
                    <th>Descargar</th> 
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    $estado = isset($row['estado']) ? $row['estado'] : '';
                    $enlace_compartir = 'detalle_documento.php?id=' . $row['id'];
                    echo "<tr>
                            <td>{$row['titulo']}</td>
                            <td>{$estado}</td>
                            <td><span class='confirmar-eliminar' onclick='confirmarEliminar({$row['id']});'>Eliminar</span></td>
                            <td><span class='descargar-documento' onclick='descargarDocumento(\"{$row['ruta_archivo']}\", \"{$row['nombre_archivo']}\");'>Descargar</span></td>
                            <td><button onclick='editarDocumento({$row['id']});'>Editar</button></td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="subir_documento.php">Subir documentos</a>
    </div>
    <script src="scripts_documentos.js"></script>
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




