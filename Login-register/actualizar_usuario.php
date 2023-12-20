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
$idUsuario = $_GET['id'];
// Obtener los datos del formulario POST

$columnName = $_POST['columnName'];
$newValue = $_POST['newValue'];
error_log("ID de Usuario: " . $idUsuario);
error_log("Columna a actualizar: " . $columnName);
error_log("Nuevo valor: " . $newValue);
// Sanitizar los datos
$idUsuario = $conn->real_escape_string($idUsuario);
$columnName = $conn->real_escape_string($columnName);
$newValue = $conn->real_escape_string($newValue);

// Consulta preparada para actualizar el valor en la base de datos
$sql = "UPDATE usuarios SET $columnName = ? WHERE id = ?";

$stmt = $conn->prepare($sql);


// Verificar si la preparación de la consulta fue exitosa
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

// Asociar los parámetros y ejecutar la consulta
$stmt->bind_param("si", $newValue, $idUsuario);
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