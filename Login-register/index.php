<?php
    include('configuracion.php');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Pagina de videos</title>
</head>


<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="php/registro_usuario_be.php" method="POST" class="formulario__register">
                <h1>Crear cuenta nueva</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google"></i></a>
                </div>
                <span>O usa tus datos personales para registrarte</span>
                <input type="text" placeholder="Nombre completo" name="nombre">
                <input type="email" placeholder="Correo" name="correo">
                <input type="rubro" placeholder="Rubro" name="rubro">
                <input type="fecha_nacimiento" placeholder="Fecha de nacimiento" name="fecha_nacimiento">
                <input type="password" placeholder="Contraseña" name="contrasena">
                <button>Registrarse</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="php/login_usuario_be.php" method="POST" class="formulario__login">
                <h1>Acceder</h1>
                <div class="enlace">
                    <?php require ('autentificacion.php')?>
                    <a href="login_google.php">
                        <img src="imagenes/ui.svg" alt="Botón de Google Login">Iniciar Sesion con Google
                    </a>
                </div>
                <span>O usa tu correo y contraseña</span>
                <input type="email" placeholder="Correo" name="correo">
                <input type="password" placeholder="Contraseña" name="contrasena">
                <a href="RECUPERAR PASS\recuperar_clave.php">Olvidaste tu contraseña?</a>
                <button>Acceder</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Acceder</h1>
                    <p>Para poder usar todas las funciones de la página</p>
                    <button class="hidden" id="login">Acceder</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Registrarse</h1>
                    <p>Es rápido y fácil, registrate para usar todas las funciones de la página</p>
                    <button class="hidden" id="register">Registrarse</button>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>