<?php

session_start();

if (!isset($_SESSION['role'])) {
    header('location: /login');
    die();
}


if ($_SESSION['role'] == "None") {
    header('location: /logout');
    die();
}

if (!isset($_POST['submit'])) {
    header('location: /');
}

$_SESSION['POST']['value'] = $_POST['submit'];

if ($_SESSION['role'] == 'Admin') {
    switch ($_SESSION['POST']['value']) {

        case 'Add Faculty':
            action("add/add-faculty.php");
            break;
    
        case 'Add Curriculum':
            action("add/add-curriculum.php");
            break;
    
        default:
            # code...
            break;
    }
    die();
}

switch ($_SESSION['POST']['value']) {

    case 'Add Student':
        action("add/add-student.php");
        break;

    default:
        # code...
        break;
}
die();