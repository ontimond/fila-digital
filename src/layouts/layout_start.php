<?php
include(__DIR__ . '/../config.php');
session_start(); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <title>Fila Digital</title>

    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/bootstrap-icons.css" />
    <link rel="stylesheet" href="/css/index.css" />
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</head>

<body>
    <!-- Navbar -->
    <?php include_once(__DIR__ . '/../layouts/navbar.php'); ?>

    <div class="container py-4">