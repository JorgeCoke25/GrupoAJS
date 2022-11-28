<?php
include_once '../include/conexion.php';

if($_POST){
    $Nombre = $_POST['Nombre'];
    $Correo = $_POST['Correo'];
    $C_Correo= $_POST['C_Correo'];
    $Contraseña = $_POST['Contraseña'];
    $C_Contraseña =$_POST['C_Contraseña'];

    $rqlen = strlen($Nombre)*strlen($Correo)*strlen($Contraseña)*strlen($C_Contraseña)*strlen($C_Correo);

    if($rqlen>0){
        $sql_Correo = 'SELECT * FROM usuario WHERE Correo = ?';
        $g_correo = $pdo->prepare($sql_Correo);
        $g_correo->execute(array($Correo));
        $resultado_correo = $g_correo->fetch();

        $sql_Nombre = 'SELECT * FROM usuario WHERE Nombre = ?';
        $g_nombre = $pdo->prepare($sql_Nombre);
        $g_nombre->execute(array($Nombre));
        $resultado_nombre = $g_nombre->fetch();

        if($resultado_correo==false){
            if($resultado_nombre==false){
                if($C_Contraseña===$Contraseña && $Correo===$C_Correo){
                    $Contraseña= password_hash($Contraseña, PASSWORD_DEFAULT);
                    $sql_registrar = 'INSERT INTO usuario(Nombre,Correo,Contraseña) VALUES (?,?,?)';
                    $sentencia_agregar = $pdo->prepare($sql_registrar);
                    $sentencia_agregar->execute(array($Nombre,$Correo,$Contraseña));
                    header("location: Login.php");
                    die('died');
                }elseif($C_Contraseña!==$Contraseña && $Correo===$C_Correo){
                    echo 'Las contraseñas no son iguales';
                }elseif($C_Contraseña===$Contraseña && $Correo!==$C_Correo){
                    echo 'Los correos no son iguales';
                }else{
                    echo 'Las contraseñas no son iguales';
                    echo '<br>';
                    echo 'Los correos no son iguales';
                }
            }else{
                echo 'El nombre de usuario ya existe';

            }
        }else{
            echo 'El correo ya existe';
        }
    }else{
        echo 'Por favor, Rellene todos los campos requeridos';

    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/f8650f493c.js" crossorigin="anonymous"></script>
    <title>Registrarse</title>
</head>
<body style="background: #721c24; height: 100vh">
<?php include('navbar.php')?>
<form class="row" method="POST" style="margin: auto; width: 40em; color: white ;background: #a2735f; border: 1px solid black; margin-top: 15em">
    <div class="col-md-12">
        <label for="inputEmail4" class="form-label">Nombre de usuario</label>
        <input type="text" class="form-control" id="inputUsuario" name= "Nombre">
    </div>
    <div class="col-md-6">
        <label for="inputEmail4" class="form-label">Correo</label>
        <input type="email" class="form-control" id="inputEmail4" name= "Correo">
    </div>
    <div class="col-md-6">
        <label for="inputEmail4" class="form-label">Confirmar Correo</label>
        <input type="email" class="form-control" id="inputEmail4-Verify" name = "C_Correo">
    </div>
    <div class="col-md-6">
        <label for="inputPassword4" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="inputPassword4" name= "Contraseña">
    </div>
    <div class="col-md-6">
        <label for="inputPassword4" class="form-label">Confirmar Contraseña</label>
        <input type="password" class="form-control" id="inputPassword4-Verify" name="C_Contraseña">
    </div>
    <hr/>
    <fieldset class="row mb-3">
        <div class="col-12">
            <button type="submit" class="btn" style="background: #721c24 ;color: white; width: 38.5em">Registrarse</button>
        </div>
</form>
</body>
</html>