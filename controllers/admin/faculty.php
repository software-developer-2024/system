<?php

session_start();

if (!isset($_SESSION['role'])) {
    header('location: /');
    die();
}

if($_SESSION['role'] != 'Admin'){
    header('location: /');
    die();
}

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$_SESSION['location'] = parse_url($_SERVER['REQUEST_URI'])['path'];

$total = $db->query("SELECT * FROM faculties WHERE NOT role = 'Admin'")->fetchAll();
$adviser = $db->query("SELECT * FROM faculties WHERE role = 'Adviser' ORDER BY lastname ASC")->fetchAll();
$sub_adviser = $db->query("SELECT * FROM faculties WHERE role = 'Sub-adviser' ORDER BY lastname ASC")->fetchAll();
$none = $db->query("SELECT * FROM faculties WHERE role = 'None' ORDER BY lastname ASC")->fetchAll();


view('admin/faculty.view.php', [
    'heading' => 'Faculty Members',
    'adviser' => $adviser,
    'sub_adviser' => $sub_adviser,
    'none' => $none,
    'total' => $total
]);