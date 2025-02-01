<?php

if (!isset($_SESSION['role'])) {
    header('location: /');
    die();
}

if ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'None') {
    header('location: /logout');
    die();
}

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);



if (!isset($_POST['fname'])) {
    $err = 'System Error!';
    view(
        '/add/add-student',
        [
            'err' => $err
        ]
    );
    die();
}

if (!isset($_POST['lname'])) {
    $err = 'System Error!';
    view(
        '/add/add-student',
        [
            'err' => $err
        ]
    );
    die();
}

if (!isset($_POST['studentId'])) {
    $err = 'System Error!';
    view(
        '/add/add-student',
        [
            'err' => $err
        ]
    );
    die();
}

if (!isset($_POST['contact'])) {
    $err = 'System Error!';
    view(
        '/add/add-student',
        [
            'err' => $err
        ]
    );
    die();
}

if (!isset($_POST['email'])) {
    $err = 'System Error!';
    view(
        '/add/add-student',
        [
            'err' => $err
        ]
    );
    die();
}


$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$contact = $_POST['contact'];
$email = $_POST['email'];
$studentId = $_POST['studentId'];
$adviser = $_SESSION['uniqueId'];
$curriculum = $_SESSION['curriculum'];
$batch = $_SESSION['batch'];

if ($db->checkIfStudentIdExist($studentId)) {
    $_SESSION['__flash']['fname'] = $fname;
    $_SESSION['__flash']['mname'] = $mname;
    $_SESSION['__flash']['lname'] = $lname;
    $_SESSION['__flash']['contact'] = $contact;
    $_SESSION['__flash']['email'] = $email;
    $_SESSION['__flash']['msg'] = "Student Id already Exist";
    header('location: /add/student');
    die();
}

$db->query(
    "INSERT INTO `students` 
    (`firstname`, `middlename`, `lastname`, `contact`, `email`, `studentId`, `adviser`,`curriculum`, `batch`, `department`) 
    VALUES (:firstname, :middlename, :lastname, :contact, :email, :studentId, :adviser, :curriculum, :batch, :dept)",
    [
        "firstname" => $fname,
        "middlename" => $mname,
        "lastname" => $lname,
        "contact" => $contact,
        "email" => $email,
        "studentId" => $studentId,
        "adviser" => $adviser,
        "curriculum" => $curriculum,
        "batch" => $batch,
        "dept" => "BS Computer Engineering"
    ]
);
$studentTable = preg_replace('/[\s-]+/', '_', $studentId);

$db->query(
    "CREATE TABLE `{$studentTable}` (
    `id` INT NOT NULL AUTO_INCREMENT, 
    `curriculum_name` VARCHAR(255) NOT NULL DEFAULT '{$curriculum}', 
    `year` VARCHAR(255) NOT NULL, 
    `semester` VARCHAR(255) NOT NULL, 
    `code` VARCHAR(255) NOT NULL, 
    `description` VARCHAR(255) NOT NULL,
    `units` VARCHAR(255) NOT NULL, 
    `preq` VARCHAR(255) NOT NULL, 
    `elec` VARCHAR(255) NOT NULL, 
    `grade` VARCHAR(255) NOT NULL NULL, 
    `status` VARCHAR(255) NOT NULL DEFAULT 'Unavailable', 
    PRIMARY KEY (`id`)
    ) ENGINE = InnoDB"
);

$db->query("ALTER TABLE `{$studentTable}` ADD `remarks` TEXT NOT NULL AFTER `status`");

$db->query(
    "INSERT INTO `{$studentTable}` 
    (year, semester, code, description, units, preq, elec) 
    SELECT 
    subjectYear, subjectSemester, subjectCode, subjectDesc, subjectUnit, subjectPreq, subjectElec
    FROM `curriculums` WHERE name = ?", [$curriculum]
);



$_SESSION['__flash']['msg'] = "You have added a new student";
header('location: /students');
die();