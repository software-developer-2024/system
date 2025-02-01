<?php

session_start();

if (!isset($_SESSION['role'])) {
    header('location: /');
    die();
}

if (!$_SESSION['role'] == 'Admin') {
    header('location: /logout');
    die();
}

if (!isset($_POST['submit'])) {
    header('location: /logout');
    die();
}

switch ($_POST['submit']) {
    case 'Assign':
        action("edit/assign.php");
        break;

    case 'Save Changes':
        action("edit/editprof.php");
        break;

    case 'Reset Password':
        action("edit/resetpass.php");
        break;

    case 'Remove':
        action("edit/remove.php");
        break;

    case 'Apply Changes':
        action("edit/myprofile.php");
        break;

    case 'Change Password':
        action("edit/changepass.php");
        break;
        

    default:
        # code...
        break;
}
die();