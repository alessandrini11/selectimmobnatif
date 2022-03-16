<?php

    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/TradeAsset.php';

    //init db
    $database = new Db();
    $db = $database->connect();

    //init user
    $tradeAsset = new TradeAsset($db);

    //set user attributes
    $tradeAsset->id = isset($_GET['id']) ? $_GET['id'] : die();

    if($tradeAsset->delete()){
        echo json_encode(
            array(
                'message' => 'Trade_asset deleted'
            )
        );
    } else {
        echo json_encode(
            array(
                'message' => 'Error'
            )
        );
    }

