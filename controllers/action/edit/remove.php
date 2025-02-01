
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

$id = $_GET['id'];

$db->query(
    "DELETE FROM `faculties` WHERE `faculties`.`uniqueId` = :uniqueId",
    ['uniqueId' => $id]
);

header('location: /faculty');