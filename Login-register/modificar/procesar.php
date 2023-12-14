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

// Recoge los datos del formulario
$idUsuario = $_POST['id-usuario'];
$nombreCompleto = $_POST['nombre'];
$fechaNacimiento = $_POST['fecha-nacimiento'];
$rubro = $_POST['rubro'];
$correo = $_POST['correo'];
$nuevaContrasena = $_POST['contrasena'];

// Actualiza la información del usuario en la base de datos
$sql = "UPDATE usuarios SET 
        nombre = '$nombreCompleto',
        fecha_nacimiento = '$fechaNacimiento',
        rubro = '$rubro',
        correo = '$correo',
        contrasena = '$nuevaContrasena'
        WHERE id = $idUsuario";

// Ejecuta la consulta
if ($conn->query($sql) === TRUE) {
    echo "Usuario actualizado correctamente";
} else {
    echo "Error al actualizar usuario: " . $conn->error;
}

// Cierra la conexión
$conn->close();
?>
