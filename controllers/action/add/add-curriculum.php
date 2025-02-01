<?php

session_start();

if (!isset($_SESSION['role'])) {
    header('location: /');
    die();
}

if ($_SESSION['role'] != 'Admin') {
    header('location: /');
    die();
}

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$json = json_decode($_POST['subjectsJSON'], true);

$CURRICULUM_NAME = $_POST['curriculumName'];
$CURRICULUM_YEAR = $_POST['curriculumYear'];
$CURRICULUM_COLLEGE = $_POST['curriculumCollege'];
$CURRICULUM_DEPT = $_POST['curriculumDept'];

foreach ($json as $subject) {

    $db->query("INSERT INTO `curriculums`( `college`, `department`, `name`, `year`, `subjectYear`, `subjectSemester`, `subjectCode`, `subjectDesc`, `subjectLec`, `subjectLab`, `subjectUnit`, `subjectPreq`, `subjectElec`) 
    VALUES ( :college, :dept, :curriculum_name, :curriculum_year, :subjectYear, :subjectSemester, :subjectCode, :subjectDesc, :subjectLec, :subjectLab, :subjectUnit, :subjectPreq, :subjectElec)", [
        'college' => $CURRICULUM_COLLEGE,
        'dept' => $CURRICULUM_DEPT,
        'curriculum_name' => $CURRICULUM_NAME,
        'curriculum_year' => $CURRICULUM_YEAR,
        'subjectYear' => $subject['subjectYear'],
        'subjectSemester' => $subject['subjectSemester'],
        'subjectCode' => $subject['subjectCode'],
        'subjectDesc' => $subject['subjectDesc'],
        'subjectLec' => $subject['subjectLec'],
        'subjectLab' => $subject['subjectLab'],
        'subjectUnit' => $subject['subjectUnit'],
        'subjectPreq' => $subject['subjectPreq'],
        'subjectElec' => $subject['subjectElec']
    ]);
}

$_SESSION['__flash']['msg'] = 'Curriculum successfully Created';
header('location: /curriculums');

die();
