<?php

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

// Obtener el ID del usuario desde la solicitud GET
$idUsuario = $_GET['id'];

// Consulta preparada para actualizar el estado del usuario a 0
$sql = "UPDATE usuarios SET estado = 0 WHERE id = ?";
$stmt = $conn->prepare($sql);

// Verificar si la preparación de la consulta fue exitosa
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

// Asociar el parámetro y ejecutar la consulta
$stmt->bind_param("i", $idUsuario);
$result = $stmt->execute();

// Verificar si la consulta fue exitosa
if ($result === false) {
    die("Error al ejecutar la consulta: " . $stmt->error);
}

// Cerrar la conexión y liberar recursos
$stmt->close();
$conn->close();

// Devolver una respuesta JSON exitosa
echo json_encode(["success" => true]);
?>
