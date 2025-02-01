<?php

session_start();

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$_SESSION['location'] = parse_url($_SERVER['REQUEST_URI'])['path'];

if (!isset($_SESSION['role'])) {
    header('location: /');
    die();
}

if($_SESSION['role'] != 'Admin'){
    header('location: /');
    die();
}

$curriculums = $db->query("SELECT * FROM curriculums WHERE 1 GROUP BY name ORDER BY name DESC");

$msg = $_SESSION['__flash']['msg'] ?? NULL;

view('admin/curriculums.view.php', [
    'heading' => 'List of Curriculums',
    'curriculums' => $curriculums,
    'msg' => $msg
]);


