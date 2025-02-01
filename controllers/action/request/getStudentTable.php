<?php

if (!isset($_POST)) {
    header("location: /logout");
}

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$data = file_get_contents("php://input");
$student = json_decode($data, true);
$student = preg_replace('/[\s-]+/', '_', $student['studentId']);

$studentTable = $db->query("SELECT * FROM {$student}")->fetchAll();
$numberOfYears = $db->query("SELECT DISTINCT year FROM {$student}")->fetchAll();
$numberOfSemesters = $db->query("SELECT DISTINCT semester FROM {$student}")->fetchAll();

$json = [
    "studentTable" => $studentTable,
    "numberOfYears" => $numberOfYears,
    "numberOfSemesters" => $numberOfSemesters
];


echo json_encode($json);

