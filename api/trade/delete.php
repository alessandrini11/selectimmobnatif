<?php

    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/Trade.php';

    //init db
    $database = new Db();
    $db = $database->connect();

    //init user
    $trade = new Trade($db);

    //set user attributes
    $trade->id = isset($_GET['id']) ? $_GET['id'] : die();

    if($trade->delete()){
        echo json_encode(
            array(
                'message' => 'Trade deleted'
            )
        );
    } else {
        echo json_encode(
            array(
                'message' => 'Error'
            )
        );
    }

