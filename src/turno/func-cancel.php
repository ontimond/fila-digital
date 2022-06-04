<?php

include_once '../config.php';

// Get query param turno
$turn_id = $_GET['turno'];

// Check if turn exists
$query = $connection->prepare("SELECT * FROM turn WHERE id = :turn_id");
$query->bindParam(':turn_id', $turn_id);
$query->execute();

if ($query->rowCount() == 0) {
    // Redirect to index
    header("Location: /turno/index.php");
}

$turno = $query->fetchObject(Turn::class);

// Update turno to canceled with the current date
$query = $connection->prepare("UPDATE turn SET canceled_at = NOW() WHERE id = :turn_id");
$query->bindParam(':turn_id', $turn_id);
$query->execute();

// Redirect to index
header("Location: /");
