<?php
// filtrar_usuarios.php

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

// Obtener parámetros de la solicitud GET
$nombre = '%' . $_GET['nombre'] . '%'; // Agregar comodines para búsqueda parcial
$correo = '%' . $_GET['correo'] . '%';

// Utilizar consulta preparada para evitar inyección SQL
$sql = "SELECT * FROM usuarios WHERE nombre LIKE ? AND correo LIKE ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $nombre, $correo);
$stmt->execute();

// Obtener los resultados de la consulta
$result = $stmt->get_result();

// Obtener los usuarios filtrados
$usuariosFiltrados = array();
while ($row = $result->fetch_assoc()) {
    $usuariosFiltrados[] = $row;
}

// Devolver los datos en formato JSON
if (!empty($usuariosFiltrados)) {
    echo json_encode($usuariosFiltrados);
} else {
    // Mostrar mensaje con SweetAlert2 si no se encuentran usuarios
    echo json_encode(["error" => "No se encontraron usuarios"]);
}

// Cerrar la conexión y liberar los recursos
$stmt->close();
$conn->close();
?>
