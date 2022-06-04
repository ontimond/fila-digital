<?php

include_once '../config.php';

// Get body params
$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$average_minutes = $_POST['average_minutes'];

// If id is not set, create new modulo
if (!isset($id)) {
    // Create new modulo
    $query = $connection->prepare("INSERT INTO module (name, description, average_minutes) VALUES (:name, :description, :average_minutes)");
} else {
    // Update modulo
    $query = $connection->prepare("UPDATE module SET name = :name, description = :description, average_minutes = :average_minutes WHERE id = :id");
    $query->bindParam(':id', $id);
}

$query->bindParam(':name', $name);
$query->bindParam(':description', $description);
$query->bindParam(':average_minutes', $average_minutes);
$query->execute();

// Redirect to index
header("Location: /modulos/index.php");
