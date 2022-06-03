<?php require_once __DIR__ . '/../layouts/layout_start.php'; ?>

<div class="card card-form mx-auto">
  <div class="card-body">
    <h5 class="card-title">Registrar turno</h5>
    <form class="d-flex flex-column gap-2" method="post" action="./func.php">
      <div class="form-group">
        <label for="name" class="col-form-label">Nombre</label>
        <input type="text" class="form-control" id="name" name="name" required />
      </div>
      <div class="form-group">
        <label for="email" class="col-form-label">Correo</label>
        <input type="email" class="form-control" id="email" name="email" required />
      </div>
      <div class="form-group">
        <label class="form-label" for="module_id">Módulo</label>
        <select class="form-select" id="module_id" name="module_id" required>
          <?php


          $query = $connection->prepare("SELECT * FROM module");
          $query->execute();
          $modules = $query->fetchAll(PDO::FETCH_CLASS, Module::class);

          foreach ($modules as $module) {
            echo '<option value="' . $module->id . '">' . $module->name . '</option>';
          }

          ?>
        </select>
      </div>
      <input type="submit" class="btn btn-primary" value="Solicitar" />
    </form>
  </div>
</div>

<?php require_once __DIR__ . '/../layouts/layout_end.php'; ?>