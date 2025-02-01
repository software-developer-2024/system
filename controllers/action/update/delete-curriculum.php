<?php

session_start();

if (!isset($_SESSION['role'])) {
    header('location: /login');
    die();
}

if ($_SESSION['role'] != 'Admin') {
    header('location: /logout');
    die();
}

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$curriculum = htmlspecialchars(substr(parse_url($_SERVER['REQUEST_URI'])['path'], 20));
$curriculumTarget = $db->getCurriculumDataByName($curriculum)[0]['curriculum_name'];

$db->query("DELETE FROM curriculums WHERE name = ?", [$curriculumTarget]);
$db->query("DELETE FROM electives WHERE curriculum = ?", [$curriculumTarget]);

$db->query("DROP TABLE `{$curriculum}`");

$_SESSION['__flash']['msg'] = "Successfully Deleted Curriculum";
header('location:/curriculums');