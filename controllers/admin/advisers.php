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

$adviser_query = "SELECT * FROM faculties WHERE role = 'Adviser' OR role = 'Sub-adviser' ORDER BY lastname ASC";
$listOfAdvisers = $db->query($adviser_query)->fetchAll();

// dd($listOfAdvisers);

view('admin/advisers.view.php', [
    'heading' => 'Advisers',
    'advisers' => $listOfAdvisers
]);