<?php require_once __DIR__ . '/../layouts/layout_start.php'; ?>

<?php

// Get all modules from the database
$query = $connection->prepare("SELECT * FROM module");
$query->execute();

$modules = $query->fetchAll(PDO::FETCH_CLASS, Module::class);

?>

<div class="card card-form mx-auto">
  <div class="card-body">
    <h5 class="card-title">Módulos</h5>
    <p class="card-text">
      Agrega un módulo para que puedas reservar turnos.
    </p>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarMódulo">
      Agregar modulo
    </button>
  </div>
  <ul class="list-group list-group-flush">

    <?php
    foreach ($modules as $module) :

      // Get count of turns not completed and not canceled
      $query = $connection->prepare("SELECT COUNT(*) FROM turn WHERE module_id = :module_id AND completed_at IS NULL AND canceled_at IS NULL");
      $query->bindParam(':module_id', $module->id);
      $query->execute();

      $turn_count = $query->fetchColumn();

    ?>

      <li class="list-group-item d-flex gap-2 align-items-center">
        <span class="badge bg-primary badge-pill"><?php echo $turn_count ?></span>
        <div class="flex-fill">Módulo <?php echo $module->name ?></div>
        <a class="btn btn-sm btn-danger" href="./func-delete.php?id=<?php echo $module->id ?>">Eliminar</a>
        <button class="btn btn-sm btn-info" onclick="openUpdateModal('<?php echo $module->id ?>', '<?php echo $module->name ?>',  '<?php echo $module->description ?>', '<?php echo $module->average_minutes ?>')">
          Actualizar</button>
      </li>

    <?php endforeach; ?>
  </ul>
</div>


<!-- Agregar modulo Modal -->
<div class="modal fade" id="agregarMódulo" tabindex="-1" role="dialog" aria-labelledby="AgregarMódulo" aria-hidden="true">
  <div class="modal-dialog" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar modulo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form method="post" action="./func.php">
        <div class="modal-body">
          <div class="form-group">
            <label for="name" class="col-form-label">Nombre:</label>
            <input type="text" class="form-control" id="name" name="name" required />
          </div>
          <div class="form-group">
            <label for="description" class="col-form-label">Descripcion:</label>
            <input type="text" class="form-control" id="description" name="description" />
          </div>
          <div class="form-group">
            <label for="average_minutes" class="col-form-label">Minutos promedio:</label>
            <input type="text" class="form-control" id="average_minutes" name="average_minutes" value="5" />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Cerrar
          </button>
          <button type="submit" class="btn btn-primary">Agregar</button>
        </div>

      </form>
    </div>
  </div>
</div>


<!-- Actualizar modulo Modal -->
<div class="modal fade" id="actualizarMódulo" tabindex="-1" role="dialog" aria-labelledby="ActualizarMódulo" aria-hidden="true">
  <div class="modal-dialog" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar modulo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form method="post" action="./func.php">
        <div class="modal-body">
          <input type="hidden" name="id" id="u_id" />
          <div class="form-group">
            <label for="name" class="col-form-label">Nombre:</label>
            <input type="text" class="form-control" id="u_name" name="name" required />
          </div>
          <div class="form-group">
            <label for="description" class="col-form-label">Descripcion:</label>
            <input type="text" class="form-control" id="u_description" name="description" />
          </div>
          <div class="form-group">
            <label for="average_minutes" class="col-form-label">Minutos promedio:</label>
            <input type="text" class="form-control" id="u_average_minutes" name="average_minutes" />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Cerrar
          </button>
          <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>

      </form>
    </div>
  </div>

  <script>
    // Open modal to update module
    function openUpdateModal(id, name, description, average_minutes) {
      const modal = new bootstrap.Modal('#actualizarMódulo')
      modal.show();

      document.getElementById('u_id').value = id;
      document.getElementById('u_name').value = name;
      document.getElementById('u_description').value = description;
      document.getElementById('u_average_minutes').value = average_minutes;
    }
  </script>

  <?php require_once __DIR__ . '/../layouts/layout_end.php'; ?>