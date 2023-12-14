<!--
<?php 
    include "conexion.php";
    $email =$_POST['email'];
    $token =$_POST['token'];
    $codigo =$_POST['codigo'];
    $res=$conexion->query("select * from passwords where 
        correo='$email' and token='$token' and codigo=$codigo")or die($conexion->error);
    $correcto=false;
    if(mysqli_num_rows($res) > 0){
        $fila = mysqli_fetch_row($res);
        $fecha =$fila[4];
        $fecha_actual=date("Y-m-d h:m:s");
        $seconds = strtotime($fecha_actual) - strtotime($fecha);
        $minutos=$seconds / 60;
        $correcto=true;
    }else{
        $correcto=false;
    } 
?>
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cambiar password</title>
    <link rel="stylesheet" href="verificar.css">
</head>
<body>
    <div class="container">
            <?php if($correcto){ ?>
                <form action="cambiarpassword.php" method="POST" onsubmit="return validarContraseñas(event)">
                    <h1>-Restablecer contraseña-</h1>
                        <label for="password" class="form-label">Nueva contraseña</label>
                        <input type="password" class="form-control" id="password" name="p1">
                        <label for="confirm-password" class="form-label">Confirmar contraseña</label>
                        <input type="password" class="form-control" id="confirm-password" name="p2">
                        <input type="hidden" class="form-control" id="email" name="email" value="<?php echo $email?>">
                    <button type="submit" class="btn btn-primary" id="submitButton">Cambiar</button>
                </form>
            <?php } else { ?>
                <div class="alert alert-danger">Código incorrecto o vencido</div>
            <?php } ?>
    </div>
    <script>
       function validarContraseñas(event) {
        var password1 = document.getElementById('password').value;
        var password2 = document.getElementById('confirm-password').value;

        if (password1 !== password2) {
            alert('Las contraseñas no coinciden. Por favor, asegúrate de que las contraseñas ingresadas sean idénticas.');
            return false;
        }
        return true;
        }
    </script>
</body>
</html>
