<?php

session_start();

if (!isset($_SESSION['role'])) {
    header('location: /');
    die();
}

if($_SESSION['role'] != 'Admin'){
    header('location: /');
    die();
}

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

if (!isset($_POST['mname'])) {
    $_POST['mname'] = '';
}

$id = $_GET['id'];
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$contact = $_POST['contact'];
$email = $_POST['email'];

$db->query(
    "UPDATE `faculties` SET `firstname` = :fname, `middlename` = :mname, `lastname` = :lname, `contact` = :contact, `email` = :email WHERE `faculties`.`uniqueId` = :uniqueId",
    [
        'uniqueId' => $id,
        'fname' => $fname,
        'mname' => $mname,
        'lname' => $lname,
        'contact' => $contact,
        'email' => $email
    ]
);

header('location: /faculty');