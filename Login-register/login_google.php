<?php
session_start();

$clientId = '568239019506-nrh9dn2eocslk0sk3jln5a3tneljlb81.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/xampp/Login-register/login_google.php';

$authUrl = 'https://accounts.google.com/o/oauth2/auth';
$params = array(
    'response_type' => 'code',
    'client_id' => $clientId,
    'redirect_uri' => $redirectUri,
    'scope' => 'email profile'
);

if (isset($_GET['code'])) {
    $tokenUrl = 'https://accounts.google.com/o/oauth2/token';
    $params = array(
        'code' => $_GET['code'],
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'redirect_uri' => $redirectUri,
        'grant_type' => 'authorization_code'
    );

    $ch = curl_init($tokenUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $tokenData = json_decode($response, true);

    // Mensajes de depuración
    echo "<pre>";
    print_r($tokenData);
    echo "</pre>";

    if (isset($tokenData['access_token'])) {
        $_SESSION['access_token'] = $tokenData['access_token'];
        header('Location: logged_in.php');
        exit;
    } else {
        echo 'Error al obtener el token de acceso.';
    }
} else {
    header('Location: ' . $authUrl . '?' . http_build_query($params));
    exit;
}
?>
