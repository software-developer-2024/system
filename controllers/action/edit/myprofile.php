<?php

session_start();

if (!isset($_SESSION['role'])) {
    header('location: /login');
    die();
}

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

if (!isset($_POST['fname'])) {
    $_SESSION['__flash']['fname'] = "err";
    header('location: /myaccount/profile');
} 

if (!isset($_POST['lname'])) {
    $_SESSION['__flash']['lname'] = "err";
    header('location: /myaccount/profile');
} 

$fname = $_POST['fname'];
$mname = $_POST['mname'] ?? "";
$lname = $_POST['lname'];

$user = $db->getUserById($_SESSION['uniqueId']);

if(password_verify($_POST['password'], $user['password'])) {
    $username = "{$fname[0]}{$fname[1]}.{$lname}";
    $db->query("UPDATE faculties SET firstname = :fname, middlename = :mname, lastname = :lname, username = :uname WHERE uniqueId = :uniqueId", [
        'fname' => $fname,
        'mname' => $mname,
        'lname' => $lname,
        'uname' => $username
    ]);

    header('location: /myaccount/profile');
} else {
    $_SESSION['__flash']['msg'] = "Error! Password Incorrect";
    header('location: /myaccount/profile');
}

die();
