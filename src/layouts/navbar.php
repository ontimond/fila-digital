<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">Fila Digital</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="/" aria-current="page">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/turno/index.php">Mi turno</a>
                </li>
                <?php if (isset($_SESSION['user'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/modulos">Módulos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/empresa">Empresa</a>
                    </li>
                <?php endif; ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i>
                    </a>
                    <ul class="dropdown-menu shadow" aria-labelledby="navbarDropdownMenuLink">
                        <?php if (!isset($_SESSION['user'])) : ?>
                            <li><a class="dropdown-item" href="/login/admin.php">Ingresar</a></li>
                            <li><a class="dropdown-item" href="/register/admin.php">Registrarse</a></li>
                        <?php else : ?>
                            <li><a class="dropdown-item" href="/logout.php">Cerrar sesion</a></li>
                        <?php endif; ?>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>