<?php
session_start();
include 'conexion.php'; // Incluye el archivo de conexión

$accessToken = isset($_SESSION['access_token']) ? $_SESSION['access_token'] : null;

if ($accessToken) {
    $userInfoUrl = 'https://www.googleapis.com/oauth2/v1/userinfo?access_token=' . $accessToken;
    $userInfo = json_decode(file_get_contents($userInfoUrl));

    if ($userInfo && isset($userInfo->email)) {
        // Obtener el correo electrónico del usuario
        $correo = $userInfo->email;

        // Consulta para verificar si el correo ya existe en la base de datos
        $consulta = "SELECT correo FROM usuarios WHERE correo = '$correo'";
        $resultadoConsulta = mysqli_query($conexion, $consulta);

        if(mysqli_num_rows($resultadoConsulta) > 0) {
                $_SESSION['correo'] = $correo;
                $_SESSION['rol'] = 'usuario';

                // Inserción exitosa, redirige a home.php
                header('Location: home.php');
                exit; // Asegúrate de terminar la ejecución después de la redirección
        } else {
            // El correo no existe, procede con la inserción
            $nombre = 'N/A';
            $fechaNacimiento = 'N/A';
            $contrasena = 'xxxxxxxxx';
            $rol = 'usuario';

            // Insertar los datos en la tabla de usuarios
            $query = "INSERT INTO usuarios (nombre, correo, fecha_nacimiento, contrasena, rol) VALUES ('$nombre', '$correo', '$fechaNacimiento', '$contrasena', '$rol')";
            
            // Ejecutar la consulta de inserción
            $resultado = mysqli_query($conexion, $query);

            if($resultado) {
                // Almacenar datos en la sesión antes de redirigir a home.php
                $_SESSION['correo'] = $correo;
                $_SESSION['rol'] = $rol;

                // Inserción exitosa, redirige a home.php
                header('Location: home.php');
                exit; // Asegúrate de terminar la ejecución después de la redirección
            } else {
                echo "Error al insertar en la base de datos: " . mysqli_error($conexion);
            }
        }
    } else {
        echo 'No se pudo obtener la información del usuario.';
    }

    echo '<form action="index.php" method="post"><input type="submit" value="Cerrar sesión"></form>';
} else {
    echo 'No se encontró el token de acceso.';
}
?>
