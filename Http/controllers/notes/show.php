<?php

// require("functions.php");
use Core\App;
use Core\Database;

// $config = require base_path("config.php");
// $db = new Database($config['database'], "akash", "info@del");

$db = App::resolve(Database::class);

$currentUserId = 1;


$note = $db->query("select * from notes where id = :id", [
    'id' => $_GET["id"]
])->findOrFail();

authorize($note["user_id"] === $currentUserId);


view("notes/show.view.php", [
    'heading' => 'Note',
    'note' => $note
]);


// require "views/notes/show.view.php";
