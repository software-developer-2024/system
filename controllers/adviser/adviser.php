<?php

session_start();

if (!isset($_SESSION['role'])) {
    header('location: /');
    die();
}

if ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'None') {
    header('location: /');
    die();
}

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$_SESSION['location'] = parse_url($_SERVER['REQUEST_URI'])['path'];

$adviser = $db->user($_SESSION['uniqueId']);


$students = $db->query(
    "SELECT * FROM students WHERE adviser = :adviser AND batch = :batch ORDER BY lastname ASC",
    [
        'adviser' => $adviser['uniqueId'],
        'batch' => $adviser['advisee']
    ]
)->fetchAll();

$years = $db->query("SELECT DISTINCT subjectYear FROM curriculums WHERE name = ?", [$adviser['curriculum']])->fetchAll();
$yearCount = sizeof($years);

$yearShouldStay = $db->getYearsShouldToCompleteCurriculum($_SESSION['curriculum']);
$yearsCanStay = $yearShouldStay + 2;

$heading = "{$adviser['department']} -  A.Y. {$adviser['advisee']}";
view('adviser/adviser.view.php', [
    'heading' => $heading,
    'students' => $students,
    'uri' => $adviser['uniqueId'],
    'curriculum' => $adviser['curriculum'],
    'years' => $yearCount,
    'yearShouldStay' => $yearShouldStay,
    'yearsCanStay' => $yearsCanStay,
    'db' => $db
]);