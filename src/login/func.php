<?php

session_start();
include('../config.php');

if (!isset($_POST['email']) || !isset($_POST['password']))
    return header('Location: /');

$email = $_POST['email'];
$password = $_POST['password'];

$query = $connection->prepare("SELECT * FROM users WHERE email=:email");
$query->bindParam("email", $email, PDO::PARAM_STR);
$query->execute();

$result = $query->fetch(PDO::FETCH_ASSOC);

if (!$result) {
    echo '<p class="error">Username password combination is wrong!</p>';
} else {
    if (password_verify($password, $result['password'])) {
        $_SESSION['user'] = $result;
        return header('Location: /');
    } else {
        echo '<p class="error">Username password combination is wrong!</p>';
    }
}
