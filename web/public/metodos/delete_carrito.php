<?php
session_start();
include_once '../../include/conexion.php';
if(isset($_SESSION['admin'])){
    $sql = 'SELECT * FROM usuario WHERE Nombre = ?';
    $g_unico = $pdo->prepare($sql);
    $g_unico->execute(array($_SESSION['admin']));
    $resultado = $g_unico->fetch();
}else{
    header('Location:../Sesiones/registro.php');
}

$id_item = $_GET['id_item'];

$sql_borrar = 'DELETE FROM carrito WHERE id_item = ?';
$sentencia_editar = $pdo->prepare($sql_borrar);
$sentencia_editar->execute(array($id_item));


header('location:../Carrito.php');
?>