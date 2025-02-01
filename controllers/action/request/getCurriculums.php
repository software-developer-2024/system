<?php

header("Content-Type: application/json");

// connection to database

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);


// fetch data from database
$response = $db->query("SELECT DISTINCT name FROM curriculums ORDER BY name DESC")->fetchAll();


$json = json_encode($response);

echo $json;
