<?php require_once 'layouts/layout.php'; ?>

<div class="card card-form mx-auto">
    <div class="card-body">
        <h5 class="card-title">Empresa</h5>
        <p class="card-text">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates,
            quisquam.
        </p>

        <form class="d-flex flex-column gap-2">
            <!-- Form group -->
            <!-- Nombre -->
            <div class="form-group">
                <label class="form-label" for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" placeholder="Nombre" />
            </div>

            <!-- Logo -->
            <div class="form-group">
                <label class="form-label" for="logo">Logo</label>
                <input type="text" class="form-control" id="logo" placeholder="Logo" />
            </div>

            <!-- Select: Color -->
            <div class="form-group">
                <label class="form-label" for="color">Color</label>
                <select class="form-control" id="color">
                    <option>Azul</option>
                    <option>Rojo</option>
                    <option>Verde</option>
                    <option>Amarillo</option>
                </select>
            </div>

            <input type="submit" class="btn btn-primary" value="Guardar" />
        </form>
    </div>
</div>