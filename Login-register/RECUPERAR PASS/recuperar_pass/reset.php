<?php 
if( isset($_GET['email'])  && isset($_GET['token']) ){
    $email=$_GET['email'];
    $token=$_GET['token'];
}else{
    header("Location: simular_pantalla_login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restablecer </title>
    <link rel="stylesheet" href="reset.css">
</head>
<body>
    <center>
    <div class="container">
            <form action="verificartoken.php" method="POST">
                <h1>-Restablecer Contraseña-</h1>
                <br>
                    <label for="c" class="form-label"> Ingrese el codigo</label>
                    <input type="number" class="form-control" id="codigo" name="codigo">
                    <input type="hidden" class="form-control" id="email" name="email" value="<?php echo $email;?>">
                    <input type="hidden" class="form-control" id="token" name="token" value="<?php echo $token;?>">
                <button type="submit" class="btn btn-primary">Restablecer</button>
            </form>
    </div>
    </center>
</body>
</html>