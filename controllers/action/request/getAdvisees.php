<?php

header("Content-Type: application/json");

// connection to database

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);


// fetch data from database
$response = $db->query("SELECT firstname, lastname, advisee FROM faculties WHERE NOT advisee = '' ORDER BY lastname ASC")->fetchAll();


$json = json_encode($response);

echo $json;
