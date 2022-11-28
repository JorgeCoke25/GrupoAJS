<?php

include_once '../include/conexion.php';

session_start();

if($_POST){

    $Correo = $_POST['correo'];
    $Contraseña = $_POST['contraseña'];

    $rqlen = strlen($Correo)*strlen($Contraseña);

    if($rqlen>0){
        $sql_Correo = 'SELECT * FROM usuario WHERE Correo = ?';
        $g_correo = $pdo->prepare($sql_Correo);
        $g_correo->execute(array($Correo));
        $resultado_correo = $g_correo->fetch();

        if(!$resultado_correo){
            echo 'No existe el usuario';
        }else{
            if(password_verify($Contraseña,$resultado_correo['Contraseña'])){
                $_SESSION['admin']=$resultado_correo['Nombre'];
                header('Location:Home.php');
            }else{
                echo 'La contraseña no es correcta';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/f8650f493c.js" crossorigin="anonymous"></script>
    <style>
        body{
            background: #2e3436;
            color: white;
            margin: auto;
            height: 100vh;
            width: 100vh;
            display: flex;
            justify-content: center;
        }
        div.login {
            margin: auto;
            display: flex;
            align-content: center;
            flex-direction: column;
        }
        form{
            color: black;
        }
        div.col-12{
            margin: auto;
        }
    </style>

    <title>LogIn</title>
</head>
<body style="background: #721c24">

<div class="login" style="background: #a2735f;border: 1px solid black">
    <form class="row g-2" method="POST" style="margin: auto">
        <div class="form-floating mb-3" >
            <input type="email" class="form-control" id="floatingInput" placeholder="nombre@ejemplo.com" name = "correo">
            <label for="floatingInput">Correo</label>
        </div>
        <div class="form-floating mb-3 d-xs-grid">
            <input type="password" class="form-control" id="floatingPassword" placeholder="contraseña" name= "contraseña">
            <label for="floatingPassword">Contraseña</label>
        </div>
        <div class="col-12">
            <button style="width:60em ; background: #721c24; color: white" type="submit" class="btn">Iniciar Sesion</button>
        </div>
    </form>
    <br><?= $mensaje ?><br>

    <br>Si aun no te has registrado
    <a href="Registro.php">SingUp</a>
</div>


</body>
</html>