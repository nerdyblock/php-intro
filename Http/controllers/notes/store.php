<?php

use Core\Database;
use Core\Validator;
use Core\App;

// $config = require base_path("config.php");
// $db = new Database($config['database'], "akash", "info@del");

$db = App::resolve(Database::class);

$errors = [];

if (!Validator::string($_POST['body'])) {
    $errors['body'] = "a body not more than 1000 character is required";
}

// if (strlen($_POST['body']) > 1000) {
//     $errors['body'] = "body cannot be more than 1000 characters";
// }

if (!empty($errors)) {
    view("notes/create.view.php", [
        'heading' => 'Create Note',
        'errors' => $errors
    ]);
}

$db->query('insert into notes(body, user_id) values(:body, :user_id)', [
    'body' => $_POST['body'],
    'user_id' => 1
]);


header('location: /notes');
die();
