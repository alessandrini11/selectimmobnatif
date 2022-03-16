<?php

    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/TradeCapabilities.php';

    $database = new Db();
    $db = $database->connect();

    $tradeCapability = new TradeCapabilities($db);
    $data = json_decode(file_get_contents("php://input"));

    $tradeCapability->trade_id = $data->trade_id;
    $tradeCapability->capability_id = $data->capability_id;

    if($tradeCapability->create()){
        echo json_encode(
            array(
                'message' => 'Trade_capability created',
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

