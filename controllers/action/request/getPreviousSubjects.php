<?php

header("Content-Type: application/json");

// connection to database

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$data = file_get_contents("php://input");
$search = json_decode($data, true);

$search = $search['query'] ?? '';

$subjects = $db->query("SELECT *
            FROM `curriculums`
            WHERE (`subjectCode` LIKE '%{$search}%'
                OR `subjectDesc` LIKE '%{$search}%') 
                GROUP BY `subjectCode`")->fetchAll();

$json = json_encode($subjects);

echo $json;
