<?php require_once __DIR__ . '/../layouts/layout_start.php'; ?>

<div class="card card-form mx-auto">
    <div class="card-body">
        <h5 class="card-title">Tu turno</h5>
        <form class="d-flex flex-column gap-2" method="post" action="./func.php">
            <div class="form-group">
                <label for="username" class="col-form-label">Nombre de usuario</label>
                <input type="text" class="form-control" id="username" name="username" />
            </div>
            <div class="form-group">
                <label for="email" class="col-form-label">Correo</label>
                <input type="email" class="form-control" id="email" name="email" />
            </div>
            <div class="form-group">
                <label for="password" class="col-form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" />
            </div>
            <input type="submit" class="btn btn-primary" value="Registrarse" />
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/layout_end.php'; ?>