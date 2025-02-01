
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
$user = $db->getUserById($id);
$password = password_hash($user['contact'], PASSWORD_BCRYPT);

$db->query(
    "UPDATE `faculties` SET `password` = :password WHERE `faculties`.`uniqueId` = :uniqueId",
    [
        'uniqueId' => $id,
        'password' => $password
    ]
);

header('location: /faculty');