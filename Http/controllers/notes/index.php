<?php

// require("functions.php");
use Core\Database;
use Core\App;

// $config = require base_path("config.php");
// $db = new Database($config['database'], "akash", "info@del");

$db = App::resolve(Database::class);

// $heading = "My Notes";

$notes = $db->query("select * from notes where user_id = 1")->get();

view("notes/index.view.php", [
    'heading' => 'My Notes',
    'notes' => $notes
]);
