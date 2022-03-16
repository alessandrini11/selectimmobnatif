<?php

    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/Location.php';

    //init db
    $database = new Db();
    $db = $database->connect();

    //init user
    $location = new Location($db);


    //get data from user's entry
    $data = json_decode(file_get_contents("php://input"));

    //set user attributes
    $location->id = isset($_GET['id']) ? $_GET['id'] : die();

    $location->name = $data->name;
    $location->description = $data->description;
    $location->ts_creation = $data->ts_creation;
    $location->user_creation = $data->user_creation;
    $location->ts_update = $data->ts_update;
    $location->user_update = $data->user_update;
    $location->metropolis_id = $data->metropolis_id;

    if($location->update()){
        echo json_encode(
            array(
                'message' => 'Location updated',
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

