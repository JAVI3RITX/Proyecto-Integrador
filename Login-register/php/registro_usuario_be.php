<?php

include 'conexion_be.php';

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$rubro = $_POST['rubro'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$contrasena = $_POST['contrasena'];

// Verificar que todos los campos obligatorios estén completos
if (empty($nombre) || empty($correo) || empty($rubro) || empty($fecha_nacimiento) || empty($contrasena)) {
    echo '
        <script>
            alert("Tienes que llenar todos los campos obligatorios para poder iniciar sesión");
            window.location = "../index.php";
        </script>
        ';
    exit();
}

// Encripta la contraseña
$contrasena = hash('sha512', $contrasena);

// Verificar si el correo ya se ha utilizado
$verificar_correo = mysqli_query($con, "SELECT * FROM usuarios WHERE correo='$correo' ");

if (mysqli_num_rows($verificar_correo) > 0) {
    echo '
        <script>
            alert("Este correo ya se usó, intenta con otro");
            window.location = "../index.php";
        </script>
        ';
    exit();
}

// Asignación automática de roles
$rol = 'usuario'; // Rol predeterminado
// Puedes ajustar la lógica de asignación de roles según tus criterios específicos

$query = "INSERT INTO usuarios(nombre, correo, rubro, fecha_nacimiento, contrasena, rol) 
            VALUES('$nombre', '$correo', '$rubro', '$fecha_nacimiento', '$contrasena', '$rol')";

$ejecutar = mysqli_query($con, $query);

if ($ejecutar) {
    echo '
        <script>
            alert("Usuario almacenado exitosamente");
            window.location = "../index.php";
        </script>
    ';
} else {
    echo '
    <script>
        alert("Inténtalo nuevamente, el usuario no se almacenó");
        window.location = "../index.php";
    </script>
    ';
}

mysqli_close($con);

?>