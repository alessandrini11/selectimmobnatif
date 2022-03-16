<?php

    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/Capability.php';

    $database = new Db();
    $db = $database->connect();

    $capability = new Capability($db);
    $data = json_decode(file_get_contents("php://input"));

    $capability->label = $data->label;
    $capability->ts_creation = $data->ts_creation;
    $capability->user_creation = $data->user_creation;
    $capability->ts_update = $data->ts_update;
    $capability->user_update = $data->user_update;

    if($capability->create()){
        echo json_encode(
            array(
                'message' => 'Capability created',
                'capability' => $capability
            )
        );
    } else {
        echo json_encode(
            array(
                'message' => 'Error'
            )
        );
    }

