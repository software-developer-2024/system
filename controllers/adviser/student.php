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

$studentId = htmlspecialchars(substr(parse_url($_SERVER['REQUEST_URI'])['path'], 10));
$student = $db->getStudentById($studentId);

$studentTable = preg_replace('/[\s-]+/', '_', $student['studentId']);

$origTable = $db->query("SELECT * FROM `curriculums` WHERE name = ?", [$student['curriculum']])->fetchAll();
$origYears = $db->query("SELECT DISTINCT year FROM `{$studentTable}`")->fetchAll();
$origSemesters = $db->query("SELECT DISTINCT semester FROM `{$studentTable}`")->fetchAll();

$curriculum = $db->query("SELECT * FROM `{$studentTable}` WHERE NOT status = 'CANCELLED' AND NOT status = 'INCREMENTED'")->fetchAll();
// $curriculum = $db->query("SELECT * FROM `{$studentTable}` WHERE NOT status = 'CANCELLED'")->fetchAll();
// $curriculum = $db->query("SELECT * FROM `{$studentTable}`")->fetchAll();
$curriculumYears = $db->query("SELECT DISTINCT year FROM `{$studentTable}`")->fetchAll();
$curriculumSemesters = $db->query("SELECT DISTINCT semester FROM `{$studentTable}`")->fetchAll();

$adviser = $db->user($_SESSION['uniqueId']);
$listOfStudents = $db->query(
    "SELECT * FROM students WHERE adviser = :adviser AND batch = :batch ORDER BY lastname ASC",
    [
        'adviser' => $adviser['uniqueId'],
        'batch' => $adviser['advisee']
    ]
)->fetchAll();

$previousStudent = "";
$nextStudent = "";
$arrayCount = 0;
foreach ($listOfStudents as $studentFromTheList) {
    if ($studentId == $studentFromTheList['studentId']) {
        $previousStudent = ($arrayCount == 0) ? $listOfStudents[sizeof($listOfStudents) - 1]['studentId'] : $listOfStudents[$arrayCount - 1]['studentId'];

        $nextStudent = ($arrayCount == (sizeof($listOfStudents) - 1)) ? $listOfStudents[0]['studentId'] : $listOfStudents[$arrayCount + 1]['studentId'];
    }
    $arrayCount++;
}

$studentName = "{$student['lastname']}, {$student['firstname']} {$student['middlename']}";
view(
    'adviser/student.view.php',
    [
        'db' => $db,
        'studentName' => $studentName,
        'student' => $student,
        'studentTable' => $studentTable,
        'subjects' => $curriculum,
        'years' => $curriculumYears,
        'semesters' => $curriculumSemesters,
        'origSubjects' => $origTable,
        'origYears' => $origYears,
        'origSemesters' => $origSemesters,
        'prev' => $previousStudent,
        'next' => $nextStudent

    ]
);

$_SESSION['location'] = parse_url($_SERVER['REQUEST_URI'])['path'];
