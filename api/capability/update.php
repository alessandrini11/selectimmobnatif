<?php

    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/Capability.php';

    //init db
    $database = new Db();
    $db = $database->connect();

    //init user
    $capability = new Capability($db);


    //get data from user's entry
    $data = json_decode(file_get_contents("php://input"));

    //set user attributes
    $capability->id = isset($_GET['id']) ? $_GET['id'] : die();

    $capability->label = $data->label;
    $capability->ts_creation = $data->ts_creation;
    $capability->user_creation = $data->user_creation;
    $capability->ts_update = $data->ts_update;
    $capability->user_update = $data->user_update;

    if($capability->update()){
        echo json_encode(
            array(
                'message' => 'Capability updated',
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

