<?php
session_start();

// Incluir conexión a la base de datos
require("php/conexion_be.php");

// Verificar si el usuario tiene el rol de "administrador"
if ($_SESSION['rol'] !== 'administrador') {
    // Redirigir a una página de acceso no autorizado si el usuario no es un administrador
    header("Location: acceso_no_autorizado.php");
    exit();
}

// Obtener los datos del formulario
$nombreUsuario = $_POST['nombreUsuario'];
$nuevoRol = $_POST['nuevoRol'];

// Actualizar el rol del usuario en la base de datos
$sqlActualizarRol = "UPDATE usuarios SET rol = '$nuevoRol' WHERE nombre_usuario = '$nombreUsuario'";
mysqli_query($con, $sqlActualizarRol);

// Redirigir de vuelta a la interfaz de administración
header("Location: interfaz_administracion.php");
exit();
?>
