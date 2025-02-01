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

$studentId = $_POST['studentId'];
$year = $_POST['year'];
$semester = $_POST['semester'];

$student = $db->getStudentById($studentId);
$studentTable = preg_replace('/[\s-]+/', '_', $studentId);
$curriculum = $db->query("SELECT * FROM `{$studentTable}` WHERE year = :year AND semester = :semester AND NOT status = 'CANCELLED' AND NOT status = 'INCREMENTED'", [
    'year' => $year,
    'semester' => $semester
])->fetchAll();

$submitUri = "/update/grades";
if ($curriculum[0]['status'] == "Unavailable") {
    $submitUri = "/update/subjects";
}

$studentName = "{$student['lastname']}, {$student['firstname']} {$student['middlename']}";
view(
    'adviser/update-student-subjects.view.php',
    [
        'studentName' => $studentName,
        'student' => $student,
        'subjects' => $curriculum,
        'year' => $year,
        'semester' => $semester,
        'submitUri' => $submitUri
    ]
);