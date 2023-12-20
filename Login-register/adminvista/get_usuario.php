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

// Obtener el ID del usuario desde la solicitud GET
$idUsuario = $_GET['id'];

// Utilizar consulta preparada para evitar inyección SQL
$sql = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idUsuario); // "i" indica un parámetro de tipo entero

// Ejecutar la consulta preparada
$stmt->execute();

// Obtener los resultados de la consulta
$result = $stmt->get_result();

// Verificar si se encontró el usuario
if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
    // Devolver los datos en formato JSON
    echo json_encode($userData);
} else {
    // Devolver un mensaje de error si el usuario no se encuentra
    echo json_encode(["error" => "Usuario no encontrado"]);
}

// Cerrar la conexión y liberar los recursos
$stmt->close();
$conn->close();
?>
