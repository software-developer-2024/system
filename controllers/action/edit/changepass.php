<?php

session_start();

if (!isset($_SESSION['role'])) {
    header('location: /login');
    die();
}

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);