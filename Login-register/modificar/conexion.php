<?php
$usuario = "admin";
$password = "1234";
$servidor = "localhost";
$basededatos = "login_db";

// Conexión a la base de datos
$con = mysqli_connect($servidor, $usuario, $password, $basededatos) or die("No se ha podido conectar al Servidor");

// Verificar la conexión
if ($con->connect_error) {
    die("Conexión fallida: " . $con->connect_error);
}

// Recoge los datos del formulario
$idUsuario = $_POST['id-usuario'];
$nombreCompleto = $_POST['nombre-completo'];
$fechaNacimiento = $_POST['fecha-nacimiento'];
$rubro = $_POST['rubro'];
$correo = $_POST['correo'];
$nuevaContrasena = $_POST['nueva-contrasena'];

// Actualiza la información del usuario en la base de datos
$sql = "UPDATE usuarios SET 
        nombre_completo = '$nombreCompleto',
        fecha_nacimiento = '$fechaNacimiento',
        rubro = '$rubro',
        correo = '$correo',
        contrasena = '$nuevaContrasena'
        WHERE id = $idUsuario";

// Ejecuta la consulta
if (mysqli_query($con, $sql)) {
    echo "Usuario actualizado correctamente";
} else {
    echo "Error al actualizar usuario: " . mysqli_error($con);
}

// Cierra la conexión
mysqli_close($con);
?>
