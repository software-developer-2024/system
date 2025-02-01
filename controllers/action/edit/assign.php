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

if (!isset($_POST['advisee'])) {
    $_POST['advisee'] = '';
}
if (!isset($_POST['curriculum'])) {
    $_POST['curriculum'] = '';
}
if (!isset($_POST['role'])) {
    $_POST['role'] = 'None';
}


$id = $_GET['id'];
$role = $_POST['role'];
$advisee = $_POST['advisee'];
$curriculum = $_POST['curriculum'];

$query = "UPDATE `faculties` SET `role` = ?, `advisee` = ?, `curriculum` = ? WHERE `uniqueId` = ?";

$db->query($query ,[$role, $advisee, $curriculum, $id]);

header('location: /faculty');
