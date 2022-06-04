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
  die("
    <p>:( No se encontró el turno</p>
    <script>
    // Try to get turno from local storage
    var turno = localStorage.getItem('turno');
    if (turno) {
      window.location.href = '/turno/index.php?turno=' + turno;
    }
    </script>
  ");
}

$turn = $query->fetchObject(Turn::class);

// Get the module from the database
$query = $connection->prepare("SELECT * FROM module WHERE id = :module_id");
$query->bindParam(':module_id', $turn->module_id);
$query->execute();

$module = $query->fetchObject(Module::class);

// Get last turn not completed
$query = $connection->prepare("SELECT * FROM turn WHERE module_id = :module_id AND completed_at IS NULL AND canceled_at IS NULL ORDER BY id ASC LIMIT 1");
$query->bindParam(':module_id', $turn->module_id);
$query->execute();

$currentTurn = $query->fetchObject(Turn::class);

// Get number of turns before the turn
$query = $connection->prepare("SELECT COUNT(*) AS turns FROM turn WHERE module_id = :module_id AND completed_at IS NULL AND canceled_at IS NULL AND id < :turn_id");
$query->bindParam(':module_id', $turn->module_id);
$query->bindParam(':turn_id', $turn->id);
$query->execute();

// Calculate the time to wait based on module.average_minutes and the number of turns before the turn
$turnsBefore = $query->fetchObject(Turn::class)->turns;
$timeToWait = $module->average_minutes * $turnsBefore;

?>

<div class="card card-form mx-auto text-center">
  <div class="card-body">
    <h5 class="card-title">Tu turno
      <!-- If turno completado show completed red icon -->
      <?php if ($turn->completed_at) : ?>
        <div class="text-danger">
          TOMADO a las <?php echo date('H:i', strtotime($turn->completed_at)) ?>
          <i class="bi bi-check-circle text-danger" data-toggle="tooltip" data-placement="top" title="Turno completado"></i>
        </div>
      <?php endif ?>

    </h5>
    <a href="#" class="btn btn-primary btn-turno rounded-circle position-relative <?php if ($turn->completed_at) : ?> disabled <?php endif ?>" data-bs-toggle="modal" data-bs-target="#turnoModal">
      <h1><?php echo "{$module->name}{$turn->id}" ?></h1>
      <span class="shadow position-absolute top-100 start-50 translate-middle badge rounded-pill text-dark bg-warning d-flex justify-content-center align-items-center gap-1">
        <?php echo "{$module->name}{$currentTurn->id}" ?>
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
      <div>
        <i class="bi bi-person-badge"></i> <?php echo $turn->user_name ?>
      </div>
      <div>
        <i class="bi bi-envelope"></i> <?php echo $turn->user_email ?>
      </div>
      <?php if (!$turn->completed_at && $timeToWait != 0) : ?>
        <div class="alert alert-warning" role="alert">
          <small>
            <i class="bi bi-info-circle-fill"></i>
            Tiempo de espera: <?php echo $timeToWait ?>min</small>
        </div>
      <?php elseif (!$turn->completed_at) : ?>
        <div class="alert alert-success" role="alert">
          <i class="bi bi-info-circle-fill"></i>
          Es tu turno!

        </div>
      <?php endif ?>
    </div>
    <div id="cont_84a3d4a106d093eb1e481948a075f772">
      <script type="text/javascript" async src="https://www.theweather.com/wid_loader/84a3d4a106d093eb1e481948a075f772"></script>
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
        <a type="button" class="btn btn-danger" data-dismiss="modal" href="./func-cancel.php?turno=<?php echo $turn_id ?>">
          Eliminar
        </a>
      </div>
    </div>
  </div>
</div>

<script>
  // Get turno query param
  var turno = <?php echo $turn_id ?>;
  var canceled = <?php echo $turn->canceled_at ? 'true' : 'false' ?>;
  var timeToWait = <?php echo $timeToWait ?>;

  if (!canceled) {
    // Set turno to local storage
    localStorage.setItem('turno', turno);
  } else {
    // Remove turno from local storage
    localStorage.removeItem('turno');
    // Reload page
    window.location.reload();
  }

  // Update page every n minutes
  if (timeToWait != 0) {
    setInterval(function() {
      window.location.reload();
    }, timeToWait * 60000);
  }
</script>


<?php require_once __DIR__ . '/../layouts/layout_end.php'; ?>