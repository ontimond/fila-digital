<?php require_once __DIR__ . '/../layouts/layout_start.php'; ?>

<?php
// Get module id from the url query string
$module_id = $_GET['modulo'];

// Get the module from the database
$query = $connection->prepare("SELECT * FROM module WHERE id = :module_id");
$query->bindParam(':module_id', $module_id);
$query->execute();

// If module not found, redirect to index
if ($query->rowCount() == 0) {
    // Redirect using script
    echo "<script>window.location.href = '/modulos/index.php'</script>";
}

$module = $query->fetchObject(Module::class);

// Get all turns not completed
$query = $connection->prepare("SELECT * FROM turn WHERE module_id = :module_id AND completed_at IS NULL ORDER BY id ASC");
$query->bindParam(':module_id', $module_id);
$query->execute();

$turns = $query->fetchAll(PDO::FETCH_CLASS, Turn::class);

// Get current turn 
$query = $connection->prepare("SELECT * FROM turn WHERE module_id = :module_id AND completed_at IS NULL AND canceled_at IS NULL ORDER BY id ASC LIMIT 1");
$query->bindParam(':module_id', $module_id);
$query->execute();

$currentTurn = $query->fetchObject(Turn::class);

?>

<!-- Card with the list of turns -->


<div class="card card-form mx-auto text-center">
    <div class="card-body">
        <h5 class="card-title">Turnos</h5>

        <!-- Current turn -->

        <?php if ($currentTurn) : ?>
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Turno actual</h4>
                <p>
                    <?php echo "{$module->name}{$currentTurn->id}" ?>
                </p>
            </div>
        <?php endif ?>

        <!-- Button to complete the current turn -->

        <?php if ($currentTurn) : ?>
            <!-- Href para completar el turno -->
            <a href="/turno/func-complete.php?turno=<?php echo $currentTurn->id ?>" class="btn btn-success">
                <!-- Bootstrap next icon -->
                <i class="bi bi-check-circle"></i>
                Completar <?php echo "{$module->name}{$currentTurn->id}" ?>
            </a>
        <?php endif ?>

        <hr />

        <h5>
            Turnos pendientes
        </h5>
        <div class="list-group">
            <?php foreach ($turns as $turn) : ?>
                <a href="/turno/index.php?turno=<?php echo $turn->id ?>" class="list-group-item list-group-item-action">
                    <h4><?php echo "{$module->name}{$turn->id}" ?></h4>
                </a>
            <?php endforeach; ?>
        </div>
    </div>


    <?php require_once __DIR__ . '/../layouts/layout_end.php'; ?>