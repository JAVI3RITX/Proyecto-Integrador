<?php
session_start(); #para que se inicialicen las sesiones

include 'conexion_be.php';

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
$contrasena = hash('sha512', $contrasena); #algoritmo de encriptamiento

$validar_login = mysqli_query($con, "SELECT id, correo, rol FROM usuarios WHERE correo='$correo' and contrasena ='$contrasena' ");

if(mysqli_num_rows($validar_login) > 0){ #Si encuentra una fila que coincide con la consulta
    $usuario = mysqli_fetch_assoc($validar_login);

    # Guarda la información del usuario en la sesión
    $_SESSION['id_usuario'] = $usuario['id'];
    $_SESSION['usuario'] = $usuario['correo'];
    $_SESSION['nombre'] = $usuario['nombre'];
    $_SESSION['rol'] = $usuario['rol'];

    header("location: ../home.php");
    exit;
}else{
    echo '
        <script>
            alert("Esta cuenta no existe, verifica los datos");
            window.location = "../index.php";
        </script>
    ';
    exit;
}
?>
