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
    <title>Editar Usuario</title>
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
    <h1>Editar Usuario</h1>
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

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre">
        <br>

        <label for="correo">Correo:</label>
        <input type="text" name="correo" id="correo">
        <br>

        <label for="rubro">Rubro:</label>
        <input type="text" name="rubro" id="rubro">
        <br>

        <label for="fecha-nacimiento">Fecha de Nacimiento:</label>
        <input type="text" name="fecha-nacimiento" id="fecha-nacimiento">
        <br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena">
        <br>

        <input type="submit" value="Actualizar">
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
    </script>
</body>

</html>