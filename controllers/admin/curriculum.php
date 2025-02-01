<?php

session_start();

if (!isset($_SESSION['role'])) {
    header('location: /login');
    die();
}

if ($_SESSION['role'] != 'Admin') {
    header('location: /faculty');
    die();
}

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$curriculumTarget = htmlspecialchars(substr(parse_url($_SERVER['REQUEST_URI'])['path'], 13));
$curriculumTarget = urldecode($curriculumTarget);
$curriculumData = $db->getCurriculumDataByName($curriculumTarget);
$curriculumDetails = $db->getCurriculumDetailsByName($curriculumTarget);
$curriculumYears = $db->query("SELECT DISTINCT subjectYear FROM curriculums where name = ?", [$curriculumTarget])->fetchAll();
$curriculumSemesters = ['1st Semester', '2nd Semester', 'Summer'];

$electives = $db->query("SELECT DISTINCT SubjectElec FROM curriculums WHERE name = ?", [$curriculumTarget])->fetchAll();
$eSubjects = $db->query("SELECT * FROM curriculums WHERE name = ? AND subjectElec IS NOT NULL", [$curriculumTarget])->fetchAll();

view('admin/curriculum.view.php', [
    'heading' => $curriculumTarget,
    'curriculum' => $curriculumDetails,
    'subjects' => $curriculumData,
    'years' => $curriculumYears,
    'semesters' => $curriculumSemesters,
    'electives' => $electives,
    'eSubjects' => $eSubjects
]);



