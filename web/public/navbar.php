<nav class="navbar navbar-expand-lg navbar-light " style="background: #a2735f; border: 1px solid; color: black;">
    <div class="container-fluid">
        <?php if (isset($_SESSION['admin'])): ?>
            <a class="btn" href="Home.php" style="background: #721c24;color: white">GrupoAJS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        <?php endif; ?>
        <?php if (!isset($_SESSION['admin'])): ?>
            <a class="btn" href="Home.php" style="background: #721c24;color: white">GrupoAJS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="btn" href="Login.php" role="button" style="background: #721c24;color: white">Iniciar Sesion</a>
        <?php endif;?>
        <?php if (isset($_SESSION['admin'])): ?>
            <a class="btn" href="metodos/Cerrar.php" role="button" style="background: #721c24;color: white">Cerrar Sesion</a>
            <h1 style="margin: auto"> ¡Bienvenido, <?php echo $_SESSION['admin']?>!</h1>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="d-flex mx-auto" method="GET" action="Buscador.php">
                    <input class="form-control form-control-lg  me-2" name="busqueda" type="search" placeholder="Buscar"
                           value="<?php echo $Busqueda ?>" aria-label="Buscar" size="50">
                    <button class="btn" type="submit" style="background: #721c24;color: white">Buscar <i class="fas fa-search" ></i></button>
                </form>
            </div>
            <a class="btn" style="background: #721c24;color: white" href="Carrito.php">
                Carrito
                <i class="fa-solid fa-cart-shopping"></i>
            </a>
        <?php endif; ?>
    </div>
</nav>