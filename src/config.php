<?php
define('USER', 'root');
define('PASSWORD', 'pr342fi9f3q9238ur23');
define('HOST', 'mysql');
define('DATABASE', 'fila_digital');
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');

try {
    $connection = new PDO("mysql:host=" . HOST . ";dbname=" . DATABASE, USER, PASSWORD);
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}

class Module
{
    public $id;
    public $name;
    public $description;
    public $created_at;
}

class Turn
{
    public $id;
    public $user_name;
    public $user_email;
    public $module_id;
    public $completed_at;
    public $created_at;
}
