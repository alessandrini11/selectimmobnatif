<?php

    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/Metropolis.php';

    $database = new Db();
    $db = $database->connect();

    $metropolis = new Metropolis($db);
    $data = json_decode(file_get_contents("php://input"));

    $metropolis->name = $data->name;
    $metropolis->code = $data->code;
    $metropolis->state = $data->state;
    $metropolis->icon_url = $data->icon_url;
    $metropolis->ts_creation = $data->ts_creation;
    $metropolis->user_creation = $data->user_creation;
    $metropolis->ts_update = $data->ts_update;
    $metropolis->user_update = $data->user_update;

    if($metropolis->create()){
        echo json_encode(
            array(
                'message' => 'Metropolis created',
                'metropolis' => $metropolis
            )
        );
    } else {
        echo json_encode(
            array(
                'message' => 'Error'
            )
        );
    }

