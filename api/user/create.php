<?php

    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/user.php';

    $database = new Db();
    $db = $database->connect();

    $user = new User($db);
    $data = json_decode(file_get_contents("php://input"));

    $user->nom = $data->nom;
    $user->prenom = $data->prenom;
    $user->email = $data->email;
    $user->password = $data->password;

    if($user->create()){
        echo json_encode(
            array(
                'message' => 'User created',
                'user' => $user
            )
        );
    } else {
        echo json_encode(
            array(
                'message' => 'Error, User not found'
            )
        );
    }

