<?php

include '../config.php';


$name = $_POST['name'];
$email = $_POST['email'];
$module_id = $_POST['module_id'];

$query = $connection->prepare("INSERT INTO turn (user_name, user_email, module_id) VALUES (:name, :email, :module_id)");
$query->bindParam(':name', $name);
$query->bindParam(':email', $email);
$query->bindParam(':module_id', $module_id);

$response = $query->execute();

$turn_id = $connection->lastInsertId();

header("Location: /turno/index.php?turno={$turn_id}");
