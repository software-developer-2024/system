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

if (!isset($_POST['fname'])) {
    $err = 'System Error!';
    view(
        '/add/add-faculty',
        [
            'err' => $err
        ]
    );
    die();
}

if (!isset($_POST['lname'])) {
    $err = 'System Error!';
    view(
        '/add/add-faculty',
        [
            'err' => $err
        ]
    );
    die();
}

if (!isset($_POST['contact'])) {
    $err = 'System Error!';
    view(
        '/add/add-faculty',
        [
            'err' => $err
        ]
    );
    die();
}

if (!isset($_POST['email'])) {
    $err = 'System Error!';
    view(
        '/add/add-faculty',
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

$uniqueId = "";
for ($i = 0; $i < 10; $i++) {
    $rand = strval(mt_rand(0, 9));
    $uniqueId .= $rand;
}

$username = substr($fname, 0, 2) . "." . $lname;
$password = password_hash($contact, PASSWORD_DEFAULT);

$queryCount = $db->rowCount(
    'SELECT * FROM faculties WHERE uniqueId = :uniqueId',
    [
        'uniqueId' => $uniqueId
    ]
)
;

if ($queryCount > 0) {
    $_SESSION['__flash']['msg'] = 'System Error! Please click submit again.';
    view(
        '/add/add-faculty',
        [
            'fname' => $fname,
            'mname' => $mname,
            'lname' => $lname,
            'contact' => $contact,
            'email' => $email,
            'err' => $err
        ]
    );
    die();
}

$db->query(
    "INSERT INTO `faculties` 
    (`username`, `firstname`, `middlename`, `lastname`, `contact`, `email`, `department`, `role`, `advisee`, `curriculum`, `uniqueId`, `password`) 
    VALUES (:username, :fname, :mname, :lname, :contact, :email, 'BS Computer Engineering', 'None', '', '', :uniqueId, :password)",
    [
        'username' => $username,
        'fname' => $fname,
        'mname' => $mname,
        'lname' => $lname,
        'contact' => $contact,
        'email' => $email,
        'uniqueId' => $uniqueId,
        'password' => $password,
    ]
);
$_SESSION['__flash']['msg'] = "You have added a curriculum successfully";
header('location: /faculty');
die(); 