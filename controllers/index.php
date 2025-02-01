<?php

session_start();

if (!isset($_SESSION['role'])) {
    header('location: /login');
    die();
}

switch ($_SESSION['role']) {
    case 'Admin':
        header('location: /faculty');
        break;
    default:
        header('location: /students');
        break;
}
die();