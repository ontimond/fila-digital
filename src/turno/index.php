<?php require_once __DIR__ . '/../layouts/layout_start.php'; ?>

<?php

include_once '../config.php';

// Get the turn id from the url query string
$turn_id = $_GET['turno'];

// Get the turn from the database
$query = $connection->prepare("SELECT * FROM turn WHERE id = :turn_id");
$query->bindParam(':turn_id', $turn_id);
$query->execute();

if ($query->rowCount() == 0) {
  die('<p>:( No se encontró el turno</p>');
}

$turn = $query->fetchObject(Turn::class);

// Get the module from the database
$query = $connection->prepare("SELECT * FROM module WHERE id = :module_id");
$query->bindParam(':module_id', $turn->module_id);
$query->execute();

$module = $query->fetchObject(Module::class);

// Get last turn not completed
// $query = $connection->prepare("SELECT * FROM turn WHERE module_id = :module_id AND completed = 0");
?>

<div class="card card-form mx-auto text-center">
  <div class="card-body">
    <h5 class="card-title">Tu turno</h5>
    <a href="#" class="btn btn-primary btn-turno rounded-circle position-relative" data-bs-toggle="modal" data-bs-target="#turnoModal">
      <h1><?php echo "{$module->name}{$turn->id}" ?></h1>
      <span class="shadow position-absolute top-100 start-50 translate-middle badge rounded-pill text-dark bg-warning d-flex justify-content-center align-items-center gap-1">
        A30
        <!-- Spinner -->
        <div class="spinner-grow spinner-grow-sm" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <span class="visually-hidden">Turno actual</span>
      </span>
    </a>
    <div class="card-text mt-4">
      <p>
        <?php echo $module->description ?>
      </p>
      <i class="bi bi-person-badge"></i> <?php echo $turn->user_name ?>
      <i class="bi bi-envelope"></i> <?php echo $turn->user_email ?>
      <div class="alert alert-warning" role="alert">
        <small>
          <i class="bi bi-info-circle-fill"></i>
          Tiempo de espera por turno: 10min</small>
      </div>
    </div>
  </div>
</div>

<!-- Turno: Modal: Eliminar -->

<div class="modal fade" id="turnoModal" tabindex="-1" role="dialog" aria-labelledby="turnoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="turnoModalLabel">Cancelar turno</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>¿Estas seguro de cancelar el turno?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">
          Eliminar
        </button>
      </div>
    </div>
  </div>
</div>


<?php require_once __DIR__ . '/../layouts/layout_end.php'; ?>