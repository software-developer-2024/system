<?php

session_start();

if (!isset($_SESSION['role'])) {
    header('location: /logout');
    die();
}

if($_SESSION['role'] != 'Admin'){
    header('location: /students');
    die();
}

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$uniqueId = htmlspecialchars(substr(parse_url($_SERVER['REQUEST_URI'])['path'], 10));

$adviser = $db->user($uniqueId);


$students = $db->query(
    "SELECT * FROM list_of_students WHERE adviser = :adviser AND batch = :batch ORDER BY lastname ASC",
    [
        'adviser' => $adviser['uniqueId'],
        'batch' => $adviser['advisee']
    ]
    )->fetchAll();

$heading = "{$adviser['department']} BATCH {$adviser['advisee']}";

view('admin/advisers-list.view.php', [
    'heading' => $heading,
    'students' => $students,
    'curriculum' => $adviser['curriculum'],
    'db' => $db
]);
