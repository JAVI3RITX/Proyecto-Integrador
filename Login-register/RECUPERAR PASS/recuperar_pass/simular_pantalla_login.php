<!DOCTYPE html>
<html>
<head>
    <title>Enviar a recuperar_clave.php</title>
</head>
<body>

    <form action="recuperar_clave.php" method="post">
        <input type="submit" name="submit" value="Enviar a recuperar_clave.php">
    </form>

</body>
</html>
<script>
    if (window.location.href.indexOf('?estado=true') > -1) {
    // Muestra una alerta indicando que el correo no fue encontrado
    alert('Contraseña modificada correctamente');
}
</script>