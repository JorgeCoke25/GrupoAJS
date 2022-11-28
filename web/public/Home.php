<?php
session_start();
include_once '../include/conexion.php';
if (isset($_SESSION['admin'])) {
    $sql = 'SELECT * FROM usuario WHERE Nombre = ?';
    $g_unico = $pdo->prepare($sql);
    $g_unico->execute(array($_SESSION['admin']));
    $resultado = $g_unico->fetch();
} else {
    header('Location:registro.php');
}
$sql_leerProductos = 'SELECT * FROM items';
$gsent = $pdo->prepare($sql_leerProductos);
$gsent->execute();
$items = $gsent->fetchAll();

if($_POST){
    $id_item = $_POST['id_item'];
    $sql_buscarCarrito = 'SELECT * FROM carrito WHERE id_usuario = ? AND id_item = ?';
    $sentencia_buscarCarrito = $pdo->prepare($sql_buscarCarrito);
    $sentencia_buscarCarrito->execute(array($resultado['id'],$id_item));
    $itemCarrito = $sentencia_buscarCarrito->fetch();
    if($itemCarrito){
        $sql_modificarCarrito = 'UPDATE carrito SET cantidad = ? WHERE id_usuario = ? AND id_item = ?';
        $sentencia_editar = $pdo->prepare($sql_modificarCarrito);
        $sentencia_editar->execute(array($itemCarrito['cantidad']+1,$resultado['id'],$id_item));
    }else{
        $sql_agregarCarro = 'INSERT INTO Carrito(cantidad,id_usuario,id_item) VALUES (?,?,?)';
        $sentencia_agregar = $pdo->prepare($sql_agregarCarro);
        $sentencia_agregar->execute(array(1,$resultado['id'],$id_item));
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/f8650f493c.js" crossorigin="anonymous"></script>
    <title>Home</title>
</head>
<body style="background: #721c24">
<?php include('navbar.php') ?>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" >
    <ol class="carousel-indicators">
        <?php for($i=0;$i <= count($items);$i++){
            if ($i == 1) {
                print "<li data-target='#carouselExampleIndicators' data-slide-to='$i' class='active'></li>\n";
            }
            else{
                print "<li data-target='#carouselExampleIndicators' data-slide-to='$i'></li>\n";
            }
        }
        ?>
    </ol>
    <div class="carousel-inner">
        <?php foreach ($items as $item): ?>
        <?php if($item['id']==1): ?>
            <div class="carousel-item active">
                <img class="d-block h-100" src="<?php echo $item['path']?>" alt="<?php echo $item['Nombre']?>"  style="margin: auto;">
                <div class="carousel-caption d-none d-md-block">
                    <h5 style="-webkit-text-stroke: 1px black;"><?php echo $item['Nombre']?></h5>
                    <h4 style="-webkit-text-stroke: 1px black;">$ <?php echo $item['Precio']?></h4>
                    <h4 style="-webkit-text-stroke: 1px black;"><?php echo $item['Stock']?> Unidades</h4>
                    <form class="d-flex mx-auto" method="POST">
                        <input type="hidden" id="id_item" name="id_item" value="<?php echo $item['id']?>">
                        <button class="btn" stype="submit" style="background: #a2735f;color: white; margin: auto; border: 1px solid black"> Agregar al carrito</button>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <div class="carousel-item">
                <img class="d-block h-100" src="<?php echo $item['path']?>" alt="<?php echo $item['Nombre']?>" style="margin: auto;">
                <div class="carousel-caption d-none d-md-block">
                    <h5 style="-webkit-text-stroke: 1px black;"><?php echo $item['Nombre']?></h5>
                    <h4 style="-webkit-text-stroke: 1px black;">$ <?php echo $item['Precio']?></h4>
                    <h4 style="-webkit-text-stroke: 1px black;"><?php echo $item['Stock']?> Unidades</h4>
                    <form class="d-flex mx-auto" method="POST">
                        <input type="hidden" id="id_item" name="id_item" value="<?php echo $item['id']?>">
                        <button class="btn" stype="submit" style="background: #a2735f;color: white; margin: auto"> Agregar al carrito</button>
                    </form>
                </div>
            </div>
        <?php endif;?>
        <?php endforeach;?>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
</body>
</html>
