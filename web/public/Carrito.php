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
$sql_leerCarrito = 'SELECT * FROM carrito WHERE id_usuario = ?';
$gsent = $pdo->prepare($sql_leerCarrito);
$gsent->execute(array($resultado['id']));
$carrito = $gsent->fetchAll();

$Total = 0;

foreach ($carrito as $se):
    $sql_leer = 'SELECT * FROM items WHERE id = ?';
    $gC = $pdo->prepare($sql_leer);
    $gC->execute(array($se['id_item']));
    $item = $gC->fetch();
    $precio = intval($se['cantidad']) * intval($item['Precio']);
    $Total += $precio;
endforeach;
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
    <title>Carrito</title>
</head>
<body style="background: #721c24">
<?php include ('navbar.php')?>
<h2 style="margin: auto; margin-top: 1em;background:#a2735f;width: 8.8em; border: 1px solid black">Carrito de compras</h2>
<hr/>
    <table class="table table-bordered table-dark">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Imagen</th>
            <th scope="col">Producto</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Precio</th>
            <th scope="col">Eliminar</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($carrito as $seleccion): ?>
            <tr>
                <?php
                    $sql_leer_item = 'SELECT * FROM items WHERE id = ?';
                    $gC = $pdo->prepare($sql_leer_item);
                    $gC->execute(array($seleccion['id_item']));
                    $item = $gC->fetch();
                ?>
                <th style="padding-top: 5.2em;padding-left: 2em" scope="row"><?php echo $seleccion['id_item']?></th>
                <td width="30em"><img src="<?php echo $item['path'] ?>" width="320" height="180" style="margin-left: 1em"></td>
                <td style="padding-top: 5.2em;padding-left: 2em"><?php echo $item['Nombre'] ?></td>
                <td style="padding-top: 5.2em;padding-left: 2em"><?php echo $seleccion['cantidad'] ?></td>
                <td style="padding-top: 5.2em;padding-left: 2em">$
                    <?php
                        $precio = intval($seleccion['cantidad']) * intval($item['Precio']);
                        echo $precio;
                    ?></td>
                <td style="padding-top: 5.2em;padding-left: 2em">
                    <a class="btn btn-danger" onclick="return ConfirmDelete()" role="button"
                       href="metodos/delete_carrito.php?id_item=<?php echo $seleccion['id_item'] ?>"><i class="fas fa-trash-alt"></i></a>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
    <h2 style="margin: auto; margin-top: 1em;margin-bottom: 1em;background:#a2735f;width: 7em; border: 1px solid black">Total: $<?php echo $Total?></h2>
    <button class="btn" style="background: #a2735f;color: white; margin: auto; width: 117.4em">Pagar</button>
</body>