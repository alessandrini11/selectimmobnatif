<?php

    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/TradeCapabilities.php';

    //init db
    $database = new Db();
    $db = $database->connect();

    //init user
    $tradeCapability = new TradeCapabilities($db);


    //get data from user's entry
    $data = json_decode(file_get_contents("php://input"));

    //set user attributes
    $tradeCapability->id = isset($_GET['id']) ? $_GET['id'] : die();

    $tradeCapability->trade_id = $data->trade_id;
    $tradeCapability->capability_id = $data->capability_id;

    if($tradeCapability->update()){
        echo json_encode(
            array(
                'message' => 'Trade_asset updated',
                'trade_capability' => $tradeCapability
            )
        );
    } else {
        echo json_encode(
            array(
                'message' => 'Error'
            )
        );
    }

