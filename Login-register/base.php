<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$asunto = $_POST['asunto'];
$mensaje = $_POST['mensaje'];

$mail = new PHPMailer();

try {
    // Configuración del servidor SMTP (puedes usar el de tu proveedor de correo)
    //$mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = 'sandbox.smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Username = '34c1b5ad2242f5';
    $mail->Password = '104d7295232725';
    //$mail->SMTPSecure = 'tls';
    $mail->Port = 2525;

    // Configuración del mensaje
    $mail->isHTML(true);
    $mail->setFrom($email, $nombre);
    $mail->addAddress('matias.auriol@alumnos.ucentral.cl');
    $mail->Subject = $asunto;
    $mail->Body = $mensaje;

    // Enviar el correo
    $mail->send();
    echo 'El mensaje se ha enviado correctamente.';
} catch (Exception $e) {
    echo 'Error al enviar el mensaje: ', $mail->ErrorInfo;
}
?>