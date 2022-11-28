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
                </div>
            </div>
        <?php else: ?>
            <div class="carousel-item">
                <img class="d-block h-100" src="<?php echo $item['path']?>" alt="<?php echo $item['Nombre']?>" style="margin: auto;">
                <div class="carousel-caption d-none d-md-block">
                    <h5 style="-webkit-text-stroke: 1px black;"><?php echo $item['Nombre']?></h5>
                    <h4 style="-webkit-text-stroke: 1px black;">$ <?php echo $item['Precio']?></h4>
                    <h4 style="-webkit-text-stroke: 1px black;"><?php echo $item['Stock']?> Unidades</h4>
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
