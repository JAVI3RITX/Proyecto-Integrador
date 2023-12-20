<?php
include "conexion.php";
$email = $_POST['email'];

// Verificar si el correo existe en la base de datos
$result = $conexion->query("SELECT correo FROM usuarios WHERE correo = '$email'");
if ($result->num_rows > 0) {
    // Si el correo existe, generar el token y realizar la inserción
    $bytes = random_bytes(5);
    $token = bin2hex($bytes);

    include "mail_reset.php";
    if ($enviado) {
        $conexion->query("INSERT INTO passwords(correo, token, codigo) 
            VALUES ('$email','$token','$codigo')") or die($conexion->error);
        // Redirigir a login.php con un parámetro para mostrar la alerta
        header("Location: ./recuperar_clave.php?correo_no_encontrado=false");
        exit();
    }
} else {
    // Redirigir a login.php con un parámetro para mostrar la alerta de correo no encontrado
    header("Location: ./recuperar_clave.php?correo_no_encontrado=true");
    exit();
}
?>