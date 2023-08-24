<?php

use Core\Database;
use Core\App;
use Core\Authenticator;
use Core\Validator;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];

if (!Validator::email($email)) {
    $errors['email'] = 'Please provide Valid Email address!';
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Please provide password of at least 7 characters!';
}

if (!empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}

$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();



if ($user) {
    // dd($user);
    header('location: /');
    exit();
} else {
    $db->query('insert into users(email, password) values(:email, :password)', [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

    (new Authenticator)->login($user);

    header('location: /');
    exit();
}
