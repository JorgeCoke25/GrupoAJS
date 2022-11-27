<?php
$link = 'mysql:host=mysql;dbname=test;charset=utf8;port=3306';
$usuario = 'dev';
$pass = 'dev';

try{
    $pdo = new PDO($link,$usuario,$pass);
}catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}