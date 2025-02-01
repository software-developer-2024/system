<?php

session_start();

if (!isset($_SESSION['uniqueId'])) {
    header('location: /');
    die();
}

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$user = $db->user($_SESSION['uniqueId']);
$location = $_SESSION['location'];



view('adviser/myaccount.view.php', [
    'heading' => 'My Account',
    'user' => $user,
    'location' => $location
]);