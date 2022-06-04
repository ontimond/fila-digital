<?php

include_once '../config.php';

// Get id from query param
$id = $_GET['id'];

// Check if modulo exists
$query = $connection->prepare("SELECT * FROM module WHERE id = :id");
$query->bindParam(':id', $id);
$query->execute();

// If modulo does not exist, redirect to index
if ($query->rowCount() == 0) {
    header("Location: /modulos/index.php");
}

// Remove modulo
$query = $connection->prepare("DELETE FROM module WHERE id = :id");
$query->bindParam(':id', $id);
$query->execute();

// Redirect to index
header("Location: /modulos/index.php");
