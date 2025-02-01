<?php

session_start();

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

if (!isset($_SESSION['role'])) {
    header('location: /login');
    die();
}

if ($_SESSION['role'] == 'Admin') {
    header('location: /faculty');
    die();
}

if ($_SESSION['role'] == 'None') {
    header('location: /logout');
    die();
}

$adviser = $db->user($_SESSION['uniqueId']);

$curriculumTarget = htmlspecialchars($_SESSION['curriculum']);
$curriculumTarget = strtolower($curriculumTarget);
$curriculumTarget = preg_replace('/[\s-]+/', '_', $curriculumTarget);

$curriculumData = $db->getCurriculumDataByName($curriculumTarget);

$curriculum = $curriculumData[0]['curriculum_name'];
$curriculumDetails = $db->getCurriculumDetailsByName($curriculum);
$curriculumYears = $db->query("SELECT DISTINCT year FROM `{$curriculumTarget}`")->fetchAll();
$curriculumSemesters = $db->query("SELECT DISTINCT semester FROM `{$curriculumTarget}`")->fetchAll();

$electives = $db->query("SELECT DISTINCT elective_name FROM electives WHERE curriculum = ?", [$curriculum])->fetchAll();
$eSubjects = $db->query("SELECT * FROM electives where curriculum = ?", [$curriculum])->fetchAll();

$heading = "{$adviser['department']} -  A.Y. {$adviser['advisee']}";


view('adviser/static-curriculum.view.php', [
    'heading' => $heading,
    'details' => $curriculumDetails,
    'subjects' => $curriculumData,
    'years' => $curriculumYears,
    'semesters' => $curriculumSemesters,
    'uri' => $adviser['uniqueId'],
    'curriculum' => $adviser['curriculum'],
    'electives' => $electives,
    'eSubjects' => $eSubjects
]);



