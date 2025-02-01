<?php

session_start();

if (!isset($_SESSION['uniqueId'])) {
    header('location: /');
}

if ($_SESSION['role'] != "Admin") {
    header('location: /');
}

view('admin/add-faculty.view.php');