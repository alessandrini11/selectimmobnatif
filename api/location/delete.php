<?php

    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/Location.php';

    //init db
    $database = new Db();
    $db = $database->connect();

    //init user
    $location = new Location($db);

    //set user attributes
    $location->id = isset($_GET['id']) ? $_GET['id'] : die();

    if($location->delete()){
        echo json_encode(
            array(
                'message' => 'Location deleted'
            )
        );
    } else {
        echo json_encode(
            array(
                'message' => 'Error'
            )
        );
    }

