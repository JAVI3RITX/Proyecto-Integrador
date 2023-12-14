<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="recuperar.css">
    <title>Recuperar clave</title>
</head>
<body>



    <div class="recuperarpass">
        <h1>-Restablecer Contraseña-</h1>
        <p>Introduce el correo electrónico asociado a tu cuenta para cambiar tu contraseña.</p>
        <form action="restablecer.php" method="POST">
            <div class="userInput">
                <div class="input">  
                    <input class="userInputText" type="email" placeholder="Ingresa tu correo" name="email">
                </div>
            </div>                               
                    <p><button class="Iniciar" type="submit">Aceptar</button></p>
                    <p><a href="../../home.php" class="Iniciar">Volver al inicio</a></p>
        </form> 
    </div> 
    
    


</body>
</html>
<script>
    if (window.location.href.indexOf('?correo_no_encontrado=true') > -1) {
    // Muestra una alerta indicando que el correo no fue encontrado
    alert('Correo no encontrado');
}
if (window.location.href.indexOf('?correo_no_encontrado=false') > -1) {
    // Muestra una alerta indicando que el correo no fue encontrado
    alert('Correo encontrado. Para recuperar su contraseña revise su correo');
}
if (window.location.href.indexOf('?estado=true') > -1) {
    // Muestra una alerta indicando que el correo no fue encontrado
    alert('Contraseña modificada correctamente');
}
</script>