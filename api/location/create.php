<?php

    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/Location.php';

    $database = new Db();
    $db = $database->connect();

    $location = new Location($db);
    $data = json_decode(file_get_contents("php://input"));

    $location->name = $data->name;
    $location->description = $data->description;
    $location->ts_creation = $data->ts_creation;
    $location->user_creation = $data->user_creation;
    $location->ts_update = $data->ts_update;
    $location->user_update = $data->user_update;
    $location->metropolis_id = $data->metropolis_id;

    if($location->create()){
        echo json_encode(
            array(
                'message' => 'Location created',
                'location' => $location
            )
        );
    } else {
        echo json_encode(
            array(
                'message' => 'Error'
            )
        );
    }

