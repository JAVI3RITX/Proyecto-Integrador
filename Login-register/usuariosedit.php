<?php
// Archivo: config.php
$usuario = "root";
$password = "";
$servidor = "localhost";
$basededatos = "login_db";

// Conexión a la base de datos
$conn = new mysqli($servidor, $usuario, $password, $basededatos);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Inicia la sesión si aún no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifica si el usuario ha iniciado sesión
if (isset($_SESSION['id_usuario'])) {
    $idUsuarioAutenticado = $_SESSION['id_usuario'];

    // Obtener el identificador del usuario de la variable $_GET
    $identificador = isset($_GET['id']) ? $_GET['id'] : $idUsuarioAutenticado;

    // Consultar la base de datos para obtener los datos del usuario
    $query = "SELECT nombre, fecha_nacimiento, rubro, correo, contrasena FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $identificador);
    $stmt->execute();
    $stmt->bind_result($nombre, $fechaNacimiento, $rubro, $correo, $contrasena);
    $stmt->fetch();
    $stmt->close();
} else {
    // Redirige o toma alguna acción si el usuario no ha iniciado sesión
    header("Location: login.php"); // Por ejemplo, redirige a la página de inicio de sesión
    exit();
}

// Cierra la conexión si no necesitas más operaciones en la base de datos
// $conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesaurioluser.css">
    <script src="scriptauriol.js" defer></script>

    <title>Modificar Cuenta</title>
</head>

<body>
    <header>
        <div class="navbar">
            <div class="dropdown" onclick="toggleDropdown()">
                <img src="imagenes\menu.png" alt="Menú" style="width: 30px; height: 30px;">
                <div class="dropdown-content" id="myDropdown">
                    <a href="usuariosedit.php">Modificar cuenta</a>
                    <a href="agregarVideo.php">Mis videos</a>
                    <a href="videos.php">Todos Los Videos</a>
                    <a href="ver_documentos.php">Mis documentos</a>
                    <a href="todos_los_documentos.php">Todos Los Documentos</a>
                    <a href="php\cerrar_sesion.php">Cerrar sesión</a>
                </div>
            </div>
            <a href="home.php" class="home-button">
                <img src="imagenes\home.png" alt="home" style="width: 30px; height: 30px;">
            </a>
        </div>
    </header>
    <div class="container">
        <div class="form-container">
            <h1>Modificar Usuario</h1>
            <form id="tu_formulario_id" action="procesar.php" method="post" onsubmit="return enviarFormulario()">


                <div class="form-group">
                    <label for="id-usuario">Id usuario: <?php echo "$identificador" ?></label>
                    <input value="<?php echo "$identificador" ?>" id="id-usuario" name="id-usuario" type="hidden">
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre Completo:</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Ingrese su nombre completo" value="<?php echo $nombre; ?>">
                    <div id="error-nombre-completo" class="error-message"></div>
                </div>

                <div class="form-group">
                    <label for="fecha-nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" id="fecha-nacimiento" name="fecha-nacimiento" value="<?php echo $fechaNacimiento; ?>">
                    <div id="error-fecha-nacimiento" class="error-message"></div>
                </div>

                <div class="form-group">
                    <label for="rubro">Rubro:</label>
                    <input type="text" id="rubro" name="rubro" placeholder="Ingrese su ocupación en la empresa" value="<?php echo $rubro; ?>">
                    <div id="error-rubro" class="error-message"></div>
                </div>

                <div class="form-group">
                    <label for="correo">Correo:</label>
                    <input type="email" id="correo" name="correo" placeholder="Ingrese su correo" value="<?php echo $correo; ?>">
                    <input type="hidden" id="correo-oculto" name="correo-oculto" value="damian@gmail.com">
                    <div id="error-correo" class="error-message"></div>
                </div>

                <div class="form-group">
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" id="contrasena" name="contrasena" placeholder="Ingrese su contraseña" value="<?php echo $contrasena; ?>">
                    <div id="error-contrasena" class="error-message"></div>
                </div>

                <div class="form-group">
                    <label for="confirmar-password">Confirmar Contraseña:</label>
                    <input type="password" id="confirmar-password" name="confirmar-password"
                        placeholder="Confirme su contraseña">
                    <div id="error-confirmar-password" class="error-message"></div>
                </div>

                <div class="form-group">
                    <input class="btn" type="button" value="Modificar" onclick="validarYActualizarDatos();">
                </div>

            </form>
        </div>
    </div>
    <script>
        // Incluir el identificador al cargar la página
        var selectedId = <?php echo json_encode($identificador); ?>;

        // Llamar a la función para cargar datos del usuario si hay un identificador
        if (selectedId !== null) {
            cargarDatosUsuario();
        }

        function cargarDatosUsuario() {
            // Obtener el valor seleccionado del droplist
            var selectedId = <?php echo $identificador?>;

            // Hacer una solicitud AJAX para obtener los datos del usuario
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Parsear la respuesta JSON
                    var userData = JSON.parse(xhr.responseText);

                    // Rellenar los campos del formulario con los datos del usuario
                    document.getElementById("nombre").value = userData.nombre;
                    document.getElementById("correo").value = userData.correo;
                    document.getElementById("rubro").value = userData.rubro;
                    document.getElementById("fecha-nacimiento").value = userData.fecha_nacimiento;
                    document.getElementById("contrasena").value = userData.contrasena;
                }
            };

            // Hacer la solicitud GET al script que obtiene los datos del usuario
            xhr.open("GET", "get_usuario.php?id=" + selectedId, true);
            xhr.send();
        }

        function validarFormulario() {
            var nombre = document.getElementById("nombre").value;
            var fechaNacimiento = document.getElementById("fecha-nacimiento").value;
            var rubro = document.getElementById("rubro").value;
            var correo = document.getElementById("correo").value;
            var contrasena = document.getElementById("contrasena").value;

            // Validaciones básicas en el lado del cliente
            if (!nombre || !fechaNacimiento || !rubro || !correo || !contrasena) {
                alert("Por favor, complete todos los campos.");
                return false;
            }

            // Puedes agregar más validaciones según tus requisitos, por ejemplo, validar el formato del correo.

            // Si todas las validaciones pasan, puedes enviar el formulario
            return true;
        }

        function validarContraseñas() {
            var contrasena = document.getElementById("contrasena").value;
            var confirmarPassword = document.getElementById("confirmar-password").value;

            // Validar que las contraseñas coincidan
            if (contrasena !== confirmarPassword) {
                alert("Las contraseñas no coinciden.");
                return false;
            }

            return true;
        }

        function validarYActualizarDatos() {
            if (validarFormulario() && validarContraseñas()) {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: 'Esta acción actualizará el usuario.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, actualizar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Continuar con el envío del formulario
                        document.getElementById('tu_formulario_id').submit();
                    }
                });
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Función para mostrar la alerta de SweetAlert
        function mostrarAlerta() {
            Swal.fire({
                title: 'Actualización exitosa',
                text: 'Los datos se han actualizado correctamente.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        }
    </script>
    <script>
        function validarContraseñas() {
    var contrasena = document.getElementById("contrasena").value;
    var confirmarPassword = document.getElementById("confirmar-password").value;

    // Verificar si las contraseñas coinciden
    if (contrasena !== confirmarPassword) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Las contraseñas no coinciden. Por favor, verifica.',
        });
        return false;
    }

    return true;
}

function enviarFormulario() {
    if (validarFormulario() && validarContraseñas()) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción actualizará el usuario.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, actualizar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Continuar con el envío del formulario
                document.getElementById('tu_formulario_id').submit();
            }
        });
    }

    // Cancelar el envío del formulario si la validación falla o si el usuario cancela en SweetAlert
    return false;
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
</html>
