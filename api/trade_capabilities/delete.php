<?php

    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/TradeCapabilities.php';

    //init db
    $database = new Db();
    $db = $database->connect();

    //init user
    $tradeCapability = new TradeCapabilities($db);

    //set user attributes
    $tradeCapability->id = isset($_GET['id']) ? $_GET['id'] : die();

    if($tradeCapability->delete()){
        echo json_encode(
            array(
                'message' => 'Trade_capability deleted'
            )
        );
    } else {
        echo json_encode(
            array(
                'message' => 'Error'
            )
        );
    }

