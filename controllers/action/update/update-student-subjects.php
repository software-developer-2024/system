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


if ($_POST['submit'] == "Submit") {
    $subjectCount = $_POST['subjectCount'];
    $year = $_POST['year'];
    $semester = $_POST['semester'];
    $studentId = $_POST['studentId'];

    $studentTable = preg_replace('/[\s-]+/', '_', $studentId);

    $subjectReturn = [];

    for ($i = 0; $i < $subjectCount; $i++) {
        $subjectThisSem = [];
        $subjectThisSem[] = $_POST["subjectCode{$i}"];
        $subjectThisSem[] = $_POST["subjectAction{$i}"];
        $subjectThisSem[] = $_POST["subjectRemarks{$i}"];

        $subjectReturn[] = $subjectThisSem;
    }

    $finalReqSubjects = [];
    $reqSubjects = [];
    foreach ($subjectReturn as $subject) {
        $finalReqSubjects = $reqSubjects;

        if ($subject[1] == "take") {
            $db->query(
                "UPDATE `{$studentTable}` SET status = 'PENDING', remarks = :remarks WHERE year = :year AND semester = :semester AND code = :code",
                [
                    'year' => $year,
                    'semester' => $semester,
                    'code' => $subject[0],
                    'remarks' => $subject[2]
                ]
            );
        } else if ($subject[1] == "remove") {
            $subjectCode = $subject[0];
            $db->query(
                "UPDATE `{$studentTable}` SET status = 'CANCELLED',  remarks = :remarks  WHERE year = :year AND semester = :semester AND code = :code",
                [
                    'year' => $year,
                    'semester' => $semester,
                    'code' => $subjectCode,
                    'remarks' => $subject[2]
                ]
            );
            $reqSubjects[] = requisiteSubjects($db, $studentTable, $subjectCode);
        }

        $finalReqSubjects = $finalReqSubjects + $reqSubjects;
    }

    foreach (array_unique($finalReqSubjects)[0] as $subject) {

        $db->query(
            "UPDATE `{$studentTable}` SET status = 'INCREMENTED' WHERE year = :year AND semester = :semester AND code = :code",
            [
                'code' => $subject[0],
                'year' => $subject[1],
                'semester' => $subject[2],
            ]
        );

    }


    $incrementedSubjects = $db->query("SELECT * FROM {$studentTable} WHERE status = 'INCREMENTED'")->fetchAll();

    if (sizeof($incrementedSubjects) > 0) {
        foreach ($incrementedSubjects as $subject) {

            $nextYear = $subject['year'] + 1;

            $doesExist = $db->query("SELECT * FROM `{$studentTable}` WHERE year = :year AND semester = :semester AND code = :code", [
                'code' => $subject['code'],
                'year' => $nextYear,
                'semester' => $subject['semester']
            ])->fetchAll();

            if (sizeof($doesExist) == 0) {

                $insertSql = "
                            INSERT INTO `{$studentTable}` 
                            (curriculum_name, year, semester, code, description, units, preq, grade, status)
                            VALUES ('BSCPE-Curriculum-2018-2019', :year, :semester, :code, :description, :units, :preq,  NULL, 'Unavailable')
                        ";
                $db->query($insertSql, [
                    'year' => $nextYear,
                    'semester' => $subject['semester'],
                    'code' => $subject['code'],
                    'description' => $subject['description'],
                    'units' => $subject['units'],
                    'preq' => $subject['preq'],
                ]);
            }

            // $db->query("DELETE FROM `{$studentTable}` WHERE id = ?", [$subject['id']]);
        }
    }

    $cancelledSubjects = $db->query("SELECT * FROM {$studentTable} WHERE status = 'CANCELLED'")->fetchAll();

    if (sizeof($cancelledSubjects) > 0) {
        foreach ($cancelledSubjects as $subject) {

            $nextYear = $subject['year'] + 1;

            $doesExist = $db->query("SELECT * FROM `{$studentTable}` WHERE year = :year AND semester = :semester AND code = :code", [
                'code' => $subject['code'],
                'year' => $nextYear,
                'semester' => $subject['semester']
            ])->fetchAll();

            if (sizeof($doesExist) == 0) {

                $insertSql = "
                            INSERT INTO `{$studentTable}` 
                            (curriculum_name, year, semester, code, description, units, preq, grade, status)
                            VALUES ('BSCPE-Curriculum-2018-2019', :year, :semester, :code, :description, :units, :preq,  NULL, 'Unavailable')
                        ";
                $db->query($insertSql, [
                    'year' => $nextYear,
                    'semester' => $subject['semester'],
                    'code' => $subject['code'],
                    'description' => $subject['description'],
                    'units' => $subject['units'],
                    'preq' => $subject['preq'],
                ]);
            }

            // $db->query("DELETE FROM `{$studentTable}` WHERE id = ?", [$subject['id']]);
        }
    }


    header("location: /students/{$studentId}");
    die();
}


