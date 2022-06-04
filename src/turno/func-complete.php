<?php

include_once '../config.php';

// Get query param turno
$turn_id = $_GET['turno'];

// Check if turn exists
$query = $connection->prepare("SELECT * FROM turn WHERE id = :turn_id");
$query->bindParam(':turn_id', $turn_id);
$query->execute();

if ($query->rowCount() == 0) {
    // Redirect to the previous page 

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

$turno = $query->fetchObject(Turn::class);

// Update turno to completed with the current date
$query = $connection->prepare("UPDATE turn SET completed_at = NOW() WHERE id = :turn_id");
$query->bindParam(':turn_id', $turn_id);
$query->execute();

// Redirect to the previous page
header('Location: ' . $_SERVER['HTTP_REFERER']);
