<?php
//headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/db.php';
    include_once '../../models/user.php';
    $database = new Db();
    $db = $database->connect();

    $user = new User($db);
    $user->id = isset($_GET['id']) ? $_GET['id'] : die();

    $user->getSingle();
    $user_arr = array(
        'id' => $user->id,
        'nom' => $user->nom,
        'prenom' => $user->prenom,
        'email' => $user->email,
        'password' => $user->password,

    );

    print_r(json_encode($user_arr));
