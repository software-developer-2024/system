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
    for ($i = 0; $i < $_POST['subjectCount']; $i++) {
        $grades = $_POST["subjectGrades{$i}"];
    }

    $year = $_POST['year'];
    $semester = $_POST['semester'];
    $studentId = $_POST['studentId'];

    $studentTable = preg_replace('/[\s-]+/', '_', $studentId);

    $droppedThisSemester = $db->query("SELECT * FROM `{$studentTable}` WHERE status = 'DROPPED' AND year = '{$year}' AND semester = '{$semester}'")->fetchAll();
    if (sizeof($droppedThisSemester) > 0) {
        recheckSubject($db, $studentTable, $droppedThisSemester, $year, $semester, 'PENDING');
    }

    $failedThisSemester = $db->query("SELECT * FROM `{$studentTable}` WHERE status = 'FAILED' AND year = '{$year}' AND semester = '{$semester}'")->fetchAll();
    if (sizeof($failedThisSemester) > 0) {
        recheckSubject($db, $studentTable, $failedThisSemester, $year, $semester, 'PENDING');
    }

    $subjectReturn = [];

    for ($i = 0; $i < $subjectCount; $i++) {
        $subject = [];
        $subject[] = $_POST["subjectCode{$i}"];
        $subject[] = $_POST["subjectGrades{$i}"];
        $subject[] = $_POST["subjectId{$i}"];
        $subject[] = $_POST["subjectRemarks{$i}"];

        $subjectReturn[] = $subject;
    }

    $finalReqSubjects = [];
    $reqSubjects = [];
    foreach ($subjectReturn as $subject) {
        $finalReqSubjects = $reqSubjects;

        if ($subject[1] == "5.0" || $subject[1] == "INC / 5.0") {
            $subjectCode = $subject[0];
            $subjectGrade = $subject[1];
            $subjectId = $subject[2];
            $subjectRemarks = $subject[3];
            $db->query(
                "UPDATE `{$studentTable}` SET status = 'FAILED', grade = :grade, remarks = :remarks WHERE id = :id",
                [
                    'id' => $subjectId,
                    'grade' => $subjectGrade,
                    'remarks' => $subjectRemarks
                ]
            );

            $reqSubjects[] = requisiteSubjects($db, $studentTable, $subjectCode, 'Unavailable');
        } else if ($subject[1] == "UW" || $subject[1] == "AW") {
            $subjectCode = $subject[0];
            $subjectGrade = $subject[1];
            $subjectId = $subject[2];
            $subjectRemarks = $subject[3];
            $db->query(
                "UPDATE `{$studentTable}` SET status = 'DROPPED', grade = :grade, remarks = :remarks WHERE id = :id",
                [
                    'id' => $subjectId,
                    'grade' => $subjectGrade,
                    'remarks' => $subjectRemarks
                ]
            );
            $reqSubjects[] = requisiteSubjects($db, $studentTable, $subjectCode, 'Unavailable');
        } else if ($subject[1] == "INC" || $subject[1] == "DG") {
            $subjectCode = $subject[0];
            $subjectGrade = $subject[1];
            $subjectId = $subject[2];
            $subjectRemarks = $subject[3];
            $db->query(
                "UPDATE `{$studentTable}` SET status = 'ON HOLD', grade = :grade, remarks = :remarks WHERE id = :id",
                [
                    'id' => $subjectId,
                    'grade' => $subjectGrade,
                    'remarks' => $subjectRemarks
                ]
            );
        } else if ($subject[1] == "") {
            $subjectCode = $subject[0];
            $subjectGrade = $subject[1];
            $subjectId = $subject[2];
            $subjectRemarks = $subject[3];
            $db->query(
                "UPDATE `{$studentTable}` SET status = 'PENDING', grade = :grade, remarks = :remarks WHERE id = :id",
                [
                    'id' => $subjectId,
                    'grade' => $subjectGrade,
                    'remarks' => $subjectRemarks
                ]
            );
        } else {
            $subjectCode = $subject[0];
            $subjectGrade = $subject[1];
            $subjectId = $subject[2];
            $subjectRemarks = $subject[3];
            $db->query(
                "UPDATE `{$studentTable}` SET status = 'PASSED', grade = :grade, remarks = :remarks WHERE id = :id",
                [
                    'id' => $subjectId,
                    'grade' => $subjectGrade,
                    'remarks' => $subjectRemarks
                ]
            );
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

    $incrementedSubjects = $db->query("SELECT * FROM {$studentTable} WHERE status = 'INCREMENTED' AND grade IS NULL")->fetchAll();

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

    $failedSubjects = $db->query("SELECT * FROM {$studentTable} WHERE status = 'FAILED'")->fetchAll();

    if (sizeof($failedSubjects) > 0) {
        foreach ($failedSubjects as $failedSubject) {
            $nextYear = $failedSubject['year'] + 1;

            $doesExist = $db->query("SELECT * FROM `{$studentTable}` WHERE year = :year AND semester = :semester AND code = :code", [
                'code' => $failedSubject['code'],
                'year' => $nextYear,
                'semester' => $failedSubject['semester']
            ])->fetchAll();

            if (sizeof($doesExist) == 0) {
                $insertSql = "
                            INSERT INTO `{$studentTable}` 
                            (curriculum_name, year, semester, code, description, units, preq, grade, status)
                            VALUES ('BSCPE-Curriculum-2018-2019', :year, :semester, :code, :description, :units, :preq,  NULL, 'Unavailable')
                        ";
                $db->query($insertSql, [
                    'year' => $nextYear,
                    'semester' => $failedSubject['semester'],
                    'code' => $failedSubject['code'],
                    'description' => $failedSubject['description'],
                    'units' => $failedSubject['units'],
                    'preq' => $failedSubject['preq'],
                ]);
            }

        }
    }

    $withdrawnSubjects = $db->query("SELECT * FROM {$studentTable} WHERE status = 'CANCELLED' AND grade IS NULL")->fetchAll();

    if (sizeof($withdrawnSubjects) > 0) {
        foreach ($withdrawnSubjects as $withdrawnSubject) {
            $nextYear = $withdrawnSubject['year'] + 1;

            $doesExist = $db->query("SELECT * FROM `{$studentTable}` WHERE year = :year AND semester = :semester AND code = :code", [
                'code' => $withdrawnSubject['code'],
                'year' => $nextYear,
                'semester' => $withdrawnSubject['semester']
            ])->fetchAll();

            if (sizeof($doesExist) == 0) {

                $insertSql = "
                            INSERT INTO `{$studentTable}` 
                            (curriculum_name, year, semester, code, description, units, preq, grade, status)
                            VALUES ('BSCPE-Curriculum-2018-2019', :year, :semester, :code, :description, :units, :preq,  NULL, 'Unavailable')
                        ";
                $db->query($insertSql, [
                    'year' => $nextYear,
                    'semester' => $withdrawnSubject['semester'],
                    'code' => $withdrawnSubject['code'],
                    'description' => $withdrawnSubject['description'],
                    'units' => $withdrawnSubject['units'],
                    'preq' => $withdrawnSubject['preq'],
                ]);

            }

        }
    }

    // dropPreReqSubjects($db, $studentTable);

    header("location: /students/{$studentId}");
    die();
}


