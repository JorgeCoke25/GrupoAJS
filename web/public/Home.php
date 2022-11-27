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
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
            crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/f8650f493c.js" crossorigin="anonymous"></script>
    <style>

        body nav h1 {
            font-size: 1.4em;
            width: 600px;
            position: relative;
            right: 50px;
        }

        body nav div.collapse.navbar-collapse {
            width: 500px;
            position: relative;
            left: 2em;
        }

        body nav div.btn-group {
            height: 4em;
            width: 10em;
        }

        body h1 {
            text-align: center;
        }

        body h2 {
            display: inline;
            margin-right: 1em;
            padding-top: 3px;
            padding-left: 10px;
            font-size: auto;
            text-align: center;
        }

        body h5 {
            text-align: center;
        }

        body nav {
            height: 4em;
        }

        body ul.navbar-nav.mx-4.mb-2.mb-lg {
            width: 100em;
            text-align: center;
        }

        body ul.navbar-nav.mx-4.mb-2.mb-lg li a {
            border: 1px solid;
            width: 31em;
            text-align: center;
        }

        body ul.navbar-nav.mx-4.mb-2.mb-lg li {
            text-align: center;
            margin-right: auto;
            margin-left: auto;
        }

        body a.btn.btn-danger {
            position: relative;
            border: 1px solid;
        }

        body nav div.collapse.navbar-collapse {
            justify-content: left;
            position: relative;
            left: -5em;
        }
    </style>
    <title>Home</title>
</head>
<body>
<?php include('navbar.php') ?>
</body>
</html>
