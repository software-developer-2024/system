<?php

function dd($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';

    die();
}

require 'Functions/path.php';

require 'Functions/route.php';

// Function to increment year for prerequisite subjects

function requisiteSubjects($db, $studentTable, $subjectCode, $status = 'Unavailable')
{
    $requisites = $db->query("SELECT * FROM {$studentTable} WHERE preq LIKE '%{$subjectCode}%' AND status LIKE '%{$status}%'")->fetchAll();
    $reqSubjects = [];
    if (sizeof($requisites) > 0) {

        foreach ($requisites as $requisite) {

            $subject = [];
            $subject[] = $requisite['code'];
            $subject[] = $requisite['year'];
            $subject[] = $requisite['semester'];
            $subject[] = $requisite['id'];
            $reqSubjects[] = $subject;
            $rCode = $requisite['code'];
            $requisites1 = $db->query("SELECT * FROM {$studentTable} WHERE preq LIKE '%{$rCode}%' AND status LIKE '%{$status}%'")->fetchAll();

            if (sizeof($requisites1) > 0) {

                foreach ($requisites1 as $requisite1) {
                    $subject1 = [];
                    $subject1[] = $requisite1['code'];
                    $subject1[] = $requisite1['year'];
                    $subject1[] = $requisite1['semester'];
                    $subject1[] = $requisite1['id'];
                    $reqSubjects[] = $subject1;

                    $rCode1 = $requisite1['code'];
                    $requisites2 = $db->query("SELECT * FROM {$studentTable} WHERE preq LIKE '%{$rCode1}%' AND status LIKE '%{$status}%'")->fetchAll();

                    if (sizeof($requisites2) > 0) {

                        foreach ($requisites2 as $requisite2) {
                            $subject2 = [];
                            $subject2[] = $requisite2['code'];
                            $subject2[] = $requisite2['year'];
                            $subject2[] = $requisite2['semester'];
                            $subject2[] = $requisite2['id'];
                            $reqSubjects[] = $subject2;

                            $rCode2 = $requisite2['code'];
                            $requisites3 = $db->query("SELECT * FROM {$studentTable} WHERE preq LIKE '%{$rCode2}%' AND status LIKE '%{$status}%'")->fetchAll();

                            if (sizeof($requisites3) > 0) {

                                foreach ($requisites3 as $requisite3) {
                                    $subject3 = [];
                                    $subject3[] = $requisite3['code'];
                                    $subject3[] = $requisite3['year'];
                                    $subject3[] = $requisite3['semester'];
                                    $subject3[] = $requisite3['id'];
                                    $reqSubjects[] = $subject3;

                                    $rCode3 = $requisite3['code'];
                                    $requisites4 = $db->query("SELECT * FROM {$studentTable} WHERE preq LIKE '%{$rCode3}%' AND status LIKE '%{$status}%'")->fetchAll();

                                    if (sizeof($requisites4) > 0) {

                                        foreach ($requisites4 as $requisite4) {
                                            $subject4 = [];
                                            $subject4[] = $requisite4['code'];
                                            $subject4[] = $requisite4['year'];
                                            $subject4[] = $requisite4['semester'];
                                            $subject4[] = $requisite4['id'];
                                            $reqSubjects[] = $subject4;

                                            $rCode4 = $requisite4['code'];
                                            $requisites5 = $db->query("SELECT * FROM {$studentTable} WHERE preq LIKE '%{$rCode4}%' AND status LIKE '%{$status}%'")->fetchAll();

                                            if (sizeof($requisites5) > 0) {

                                                foreach ($requisites5 as $requisite5) {
                                                    $subject5 = [];
                                                    $subject5[] = $requisite5['code'];
                                                    $subject5[] = $requisite5['year'];
                                                    $subject5[] = $requisite5['semester'];
                                                    $subject5[] = $requisite5['id'];
                                                    $reqSubjects[] = $subject5;

                                                    $rCode5 = $requisite5['code'];
                                                    $requisites6 = $db->query("SELECT * FROM {$studentTable} WHERE preq LIKE '%{$rCode5}%' AND status LIKE '%{$status}%'")->fetchAll();

                                                    if (sizeof($requisites6) > 0) {

                                                        foreach ($requisites6 as $requisite6) {
                                                            $subject6 = [];
                                                            $subject6[] = $requisite6['code'];
                                                            $subject6[] = $requisite6['year'];
                                                            $subject6[] = $requisite6['semester'];
                                                            $subject6[] = $requisite6['id'];
                                                            $reqSubjects[] = $subject6;

                                                            $rCode6 = $requisite6['code'];
                                                            $requisites7 = $db->query("SELECT * FROM {$studentTable} WHERE preq LIKE '%{$rCode6}%' AND status LIKE '%{$status}%'")->fetchAll();

                                                            if (sizeof($requisites7) > 0) {

                                                                foreach ($requisites7 as $requisite7) {
                                                                    $subject7 = [];
                                                                    $subject7[] = $requisite7['code'];
                                                                    $subject7[] = $requisite7['year'];
                                                                    $subject7[] = $requisite7['semester'];
                                                                    $subject7[] = $requisite7['id'];
                                                                    $reqSubjects[] = $subject7;

                                                                    $rCode7 = $requisite7['code'];
                                                                    $requisites8 = $db->query("SELECT * FROM {$studentTable} WHERE preq LIKE '%{$rCode7}%' AND status LIKE '%{$status}%'")->fetchAll();

                                                                    if (sizeof($requisites8) > 0) {

                                                                        foreach ($requisites8 as $requisite8) {
                                                                            $subject8 = [];
                                                                            $subject8[] = $requisite8['code'];
                                                                            $subject8[] = $requisite8['year'];
                                                                            $subject8[] = $requisite8['semester'];
                                                                            $subject8[] = $requisite8['id'];
                                                                            $reqSubjects[] = $subject8;

                                                                            $rCode8 = $requisite8['code'];
                                                                            $requisites9 = $db->query("SELECT * FROM {$studentTable} WHERE preq LIKE '%{$rCode8}%' AND status LIKE '%{$status}%'")->fetchAll();

                                                                            if (sizeof($requisites9) > 0) {

                                                                                foreach ($requisites9 as $requisite9) {
                                                                                    $subject9 = [];
                                                                                    $subject9[] = $requisite9['code'];
                                                                                    $subject9[] = $requisite9['year'];
                                                                                    $subject9[] = $requisite9['semester'];
                                                                                    $subject9[] = $requisite9['id'];
                                                                                    $reqSubjects[] = $subject9;

                                                                                    $rCode9 = $requisite9['code'];
                                                                                    $requisites10 = $db->query("SELECT * FROM {$studentTable} WHERE preq LIKE '%{$rCode9}%' AND status LIKE '%{$status}%'")->fetchAll();

                                                                                    if (sizeof($requisites10) > 0) {

                                                                                        foreach ($requisites10 as $requisite10) {
                                                                                            $subject10 = [];
                                                                                            $subject10[] = $requisite10['code'];
                                                                                            $subject10[] = $requisite10['year'];
                                                                                            $subject10[] = $requisite10['semester'];
                                                                                            $subject10[] = $requisite10['id'];
                                                                                            $reqSubjects[] = $subject10;
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }

                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    return $reqSubjects;
}

function recheckSubject($db, $studentTable, $subjectsToCheck, $year, $semester, $status = 'Unavailable')
{
    $finalReqSubjectsIncrement = [];
    $finalReqSubjectsIncremented = [];
    $reqSubjectsIncrement = [];
    $reqSubjectsIncremented = [];
    if (sizeof($subjectsToCheck) > 0) {

        foreach ($subjectsToCheck as $subject) {
            $finalReqSubjectsIncrement = $reqSubjectsIncrement;
            $finalReqSubjectsIncremented = $reqSubjectsIncremented;

            $subjectCode = $subject['code'];
            $db->query(
                "UPDATE `{$studentTable}` SET status = '{$status}' WHERE year = :year AND semester = :semester AND code = :code",
                [
                    'year' => $year,
                    'semester' => $semester,
                    'code' => $subjectCode
                ]
            );
            $reqSubjectsIncremented[] = requisiteSubjects($db, $studentTable, $subjectCode, 'Unavailable');
            $reqSubjectsIncrement[] = requisiteSubjects($db, $studentTable, $subjectCode, 'INCREMENTED');
            // dd($reqSubjectsIncrement);

            $finalReqSubjectsIncremented = $finalReqSubjectsIncremented + $reqSubjectsIncremented;
            $finalReqSubjectsIncrement = $finalReqSubjectsIncrement + $reqSubjectsIncrement;
        }


    }
    if (sizeof($finalReqSubjectsIncrement[0]) > 0) {
        foreach ($finalReqSubjectsIncrement[0] as $subject1) {
            $db->query("UPDATE `{$studentTable}` SET status = 'Unavailable', grade = NULL WHERE id = {$subject1[3]}");
        }
    }

    if (sizeof($finalReqSubjectsIncremented[0]) > 0) {
        foreach ($finalReqSubjectsIncremented[0] as $subject2) {
            $db->query("DELETE FROM `{$studentTable}` WHERE id = {$subject2[3]}");
        }
    }

}






// -- CREATE TABLE `2000_00000` (
//     --     `id` INT NOT NULL AUTO_INCREMENT, 
//     --     `curriculum_name` VARCHAR(255) NOT NULL DEFAULT "bscpe_curriculum_2018_2019", 
//     --     `year` INT(11) NOT NULL, 
//     --     `semester` VARCHAR(255) NOT NULL, 
//     --     `code` VARCHAR(255) NOT NULL, 
//     --     `description` VARCHAR(255) NOT NULL,
//     --     `units` INT(11) NOT NULL, 
//     --     `preq` VARCHAR(255) NOT NULL, 
//     --     `grade` VARCHAR(255) NOT NULL NULL, 
//     --     `status` VARCHAR(255) NOT NULL DEFAULT 'Unavailable', 
//     --     PRIMARY KEY (`id`)
//     --     ) ENGINE = InnoDB


//     INSERT INTO `2000_00000` 
//         (year, semester, code, description, units, preq) 
//         SELECT year, semester, code, description, units, preq
//         FROM `bscpe_curriculum_2018_2019`