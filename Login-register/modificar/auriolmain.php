<?php
$usuario = "admin";
$password = "1234";
$servidor = "localhost";
$basededatos = "login_db";
// Conexión a la base de datos
$conn = new mysqli($servidor, $usuario, $password, $basededatos);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener todos los IDs de la tabla usuarios
$sql = "SELECT id FROM usuarios";
$result = $conn->query($sql);

// Array para almacenar los IDs
$ids = array();

// Llenar el array con los IDs
while ($row = $result->fetch_assoc()) {
    $ids[] = $row['id'];
}

// Cierra la conexión
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesauriol.css">
    <script src="scriptauriol.js" defer></script>
   
    <title>Modificar Cuenta</title>
</head>

<body>
    <header>
        <div class="dropdown">
            <span>Menú</span>
            <div class="dropdown-content">
                <a href="cuenta.html">Cuenta</a>
                <a href="#!">Mis videos</a>
                <a href="ver_documentos.php">Mis documentos</a>
                <a href="#!">Modificar cuenta</a>
                <a href="php/cerrar_sesion.php">Cerrar sesión</a>
            </div>
        </div>
        <div class="logo">
            <a href="home.php">
                <img src="imagenes/home.png" alt="logo">
            </a>
        </div>
    </header>
    <div class="container">
        <div class="form-container">
             <h1>Modificar Usuario</h1>
    <form action="procesar.php" method="post">
        <label for="id-usuario">Selecciona un ID:</label>
        <select name="id-usuario" id="id-usuario" onchange="cargarDatosUsuario()">
            <?php
            foreach ($ids as $id) {
                echo "<option value=\"$id\">$id</option>";
            }
            ?>
        </select>

        <br><br>

                <div class="form-group">
                    <label for="nombre">Nombre Completo:</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Ingrese su nombre completo">
                    <div id="error-nombre-completo" class="error-message"></div>
                </div>

                <div class="form-group">
                    <label for="fecha-nacimiento">Fecha de Nacimiento:</label>
                    <input type="text" id="fecha-nacimiento" name="fecha-nacimiento">
                    <div id="error-fecha-nacimiento" class="error-message"></div>
                </div>

                <div class="form-group">
                    <label for="rubro">Rubro:</label>
                    <input type="text" id="rubro" name="rubro" placeholder="Ingrese su ocupación en la empresa">
                    <div id="error-rubro" class="error-message"></div>
                </div>

                <div class="form-group">
                    <label for="correo">Correo:</label>
                    <input type="email" id="correo" name="correo" placeholder="Ingrese su correo">
                    <input type="hidden" id="correo-oculto" name="correo-oculto" value="damian@gmail.com">
                    <div id="error-correo" class="error-message"></div>
                </div>

                <div class="form-group">
                    <label for="contrasena">Nueva Contraseña:</label>
                    <input type="password" id="contrasena" name="contrasena"
                        placeholder="Ingrese su nueva contraseña">
                    <div id="error-nueva-contrasena" class="error-message"></div>
                </div>

                

                <input id ="actualizar" type="submit" value="Actualizar">
    
            </form>
           
            <script>
    function cargarDatosUsuario() {
        // Obtener el valor seleccionado del droplist
        var selectedId = document.getElementById("id-usuario").value;

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
</script>

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
            <li><a href="#"> Quiénes somos?</a></li>
            <li><a href="#"> aaaaaaaaaaaaa</a></li>
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
