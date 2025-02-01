<?php

session_start();

use Core\Database;
$config = require base_path('config.php');
$db = new Database($config['database']);


$username = $_POST['username'];
$password = $_POST['password'];


if ($username === '' || $password === '') {
    dd('Please Enter Your Credentials');
}

$users = $db->getUsers($username);

if (!(sizeof($users) > 0)) {
    $err = 'Username does not exist';
    $_SESSION['__flash']['err'] = $err;
    header('location: /login');
    die();
}

foreach ($users as $user) {
    if (password_verify($password, $user['password'])) {
        $_SESSION['role'] = $user['role'];
        $_SESSION['uniqueId'] = $user['uniqueId'];

        if ($_SESSION['role'] == "Admin") {
            header('location: /faculty');
            die();
        }

        if ($_SESSION['role'] == "Adviser" || $_SESSION['role'] == "Sub-adviser") {
            $_SESSION['curriculum'] = $user['curriculum'];
            $_SESSION['batch'] = $user['advisee'];
            header("location: /students");
            die();
        }

        $err = 'You are not yet an adviser';
        $_SESSION['__flash']['err'] = $err;
        header('location: /login');
        die();

    }
}

$err = 'Username and Password do not match';
$_SESSION['__flash']['err'] = $err;
header('location: /login');
die();

