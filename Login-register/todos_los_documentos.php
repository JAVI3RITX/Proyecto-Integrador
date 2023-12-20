<?php
session_start();
require("php/conexion_be.php");

// Obtener el término de búsqueda si se proporciona
$busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';
$filtroTipo = isset($_GET['filtro_tipo']) ? $_GET['filtro_tipo'] : 'todos';

// Consulta SQL base para mostrar documentos públicos
$sql = "SELECT id, usuario_id, nombre_archivo, ruta_archivo, titulo, tipo_documento FROM documentos WHERE estado = 'publico' and documento_estado = 1";

// Agregar condición de búsqueda si se proporciona un término
if (!empty($busqueda)) {
    $sql .= " AND titulo LIKE '%$busqueda%'";
}

// Agregar condición de filtro por tipo
if ($filtroTipo !== 'todos') {
    $sql .= " AND tipo_documento = '$filtroTipo'";
}

// Obtener el rol del usuario desde la sesión
$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : 'usuario';

// Ajustar la consulta según el rol del usuario
if ($rol === 'administrador') {
    $sql = "SELECT id, usuario_id, nombre_archivo, ruta_archivo, titulo, tipo_documento FROM documentos WHERE documento_estado = 1";

    if (!empty($busqueda)) {
        $sql .= " AND titulo LIKE '%$busqueda%'";
    }
    if ($filtroTipo !== 'todos') {
        $sql .= " AND tipo_documento = '$filtroTipo'";
    }
}

$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos los Documentos</title>
    <link rel="stylesheet" href="style_documentoss.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function descargarDocumento(ruta) {
            window.location.href = ruta;
        }

        function descargarDocumento(ruta, nombreArchivo) {
            var enlaceDescarga = document.createElement('a');
            enlaceDescarga.href = ruta;
            enlaceDescarga.download = nombreArchivo;
            enlaceDescarga.click();
}

        function confirmarEliminar(documento_id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción eliminará el documento.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'eliminar_documento.php?documento_id=' + documento_id;
                }
            });
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
                <img src="imagenes/home.png" alt="home" style="width: 30px; height: 30px;">
            </a>
        </div>
    </header>
    <br>
    <br>
    <br>
    <div class="container">
        <h1>Todos los Documentos</h1>
        <!-- Formulario de filtrado por tipo -->
        <form action="todos_los_documentos.php" method="GET">
            <label for="busqueda">Buscar por título:</label>
            <input type="text" name="busqueda" id="busqueda">
            <label for="filtro_tipo">Filtrar por tipo:</label>
            <select name="filtro_tipo">
                <option value="todos">Todos</option>
                <option value="pdf">PDF</option>
                <option value="xlsx">xlsx</option>
            </select>
            <input type="submit" value="Buscar">
        </form>
        <!-- Tabla de documentos -->
        <table>
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Titulo</th>
                    <th>Tipo</th>
                    <th>Descargar</th>
                    <?php if ($rol === 'administrador') : ?>
                        <th>Eliminar</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['usuario_id']}</td>
                            <td>{$row['titulo']}</td>
                            <td>{$row['tipo_documento']}</td>
                            <td><span class='descargar-documento' onclick='descargarDocumento(\"{$row['ruta_archivo']}\", \"{$row['nombre_archivo']}\");'><i class='fas fa-download'></i></span></td>";
                    if ($rol === 'administrador') {
                        echo "<td><span class='confirmar-eliminar' onclick='confirmarEliminar({$row['id']});'><i class='far fa-trash-alt'></i></span></td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

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
