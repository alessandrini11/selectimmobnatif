<?php

    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/TradeAsset.php';

    $database = new Db();
    $db = $database->connect();

    $tradeAsset = new TradeAsset($db);
    $data = json_decode(file_get_contents("php://input"));

    $tradeAsset->trade_id = $data->trade_id;
    $tradeAsset->asset_id = $data->asset_id;

    if($tradeAsset->create()){
        echo json_encode(
            array(
                'message' => 'Trade_asset created',
                'trade_asset' => $tradeAsset
            )
        );
    } else {
        echo json_encode(
            array(
                'message' => 'Error'
            )
        );
    }

