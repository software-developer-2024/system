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

$studentTable = preg_replace('/[\s-]+/', '_', $_GET['id']);
$year = $_GET['yearlvl'];
$semester = $_GET['semester'];


$droppedThisSemester = $db->query("SELECT * FROM `{$studentTable}` WHERE status = 'DROPPED' AND year = '{$year}' AND semester = '{$semester}'")->fetchAll();
if (sizeof($droppedThisSemester) > 0) {
    foreach ($droppedThisSemester as $subject) {
        $db->query(
            "DELETE FROM `{$studentTable}` WHERE year = :year AND semester = :semester AND code = :code",
            [
                'year' => $year + 1,
                'semester' => $semester,
                'code' => $subject['code']
            ]
        );
    }
    recheckSubject($db, $studentTable, $droppedThisSemester, $year, $semester, 'PENDING');
}

$failedThisSemester = $db->query("SELECT * FROM `{$studentTable}` WHERE status = 'FAILED' AND year = '{$year}' AND semester = '{$semester}'")->fetchAll();
if (sizeof($failedThisSemester) > 0) {
    foreach ($failedThisSemester as $subject) {
        $db->query(
            "DELETE FROM `{$studentTable}` WHERE year = :year AND semester = :semester AND code = :code",
            [
                'year' => $year + 1,
                'semester' => $semester,
                'code' => $subject['code']
            ]
        );
    }
    recheckSubject($db, $studentTable, $failedThisSemester, $year, $semester, 'PENDING');
}

$cancelledThisSemester = $db->query("SELECT * FROM `{$studentTable}` WHERE status = 'CANCELLED' AND year = '{$year}' AND semester = '{$semester}'")->fetchAll();
if (sizeof($cancelledThisSemester) > 0) {
    foreach ($cancelledThisSemester as $subject) {
        $db->query(
            "DELETE FROM `{$studentTable}` WHERE year = :year AND semester = :semester AND code = :code",
            [
                'year' => $year + 1,
                'semester' => $semester,
                'code' => $subject['code']
            ]
        );
    }
    recheckSubject($db, $studentTable, $cancelledThisSemester, $year, $semester, 'PENDING');
}

$db->query("UPDATE `{$studentTable}` SET status = 'Unavailable', grade = '' WHERE year = :year AND semester = :semester AND NOT status = 'INCREMENTED'", [
    'year' => $year,
    'semester' => $semester
]);

header("location: /students/{$_GET['id']}");

die();


