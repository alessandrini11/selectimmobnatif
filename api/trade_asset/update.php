<?php

        //headers
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods: PUT');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

        include_once '../../config/db.php';
        include_once '../../models/TradeAsset.php';

        //init db
        $database = new Db();
        $db = $database->connect();

        //init user
        $tradeAsset = new TradeAsset($db);


        //get data from user's entry
        $data = json_decode(file_get_contents("php://input"));

        //set user attributes
        $tradeAsset->id = isset($_GET['id']) ? $_GET['id'] : die();

        $tradeAsset->trade_id = $data->trade_id;
        $tradeAsset->asset_id = $data->asset_id;

        if($tradeAsset->update()){
            echo json_encode(
                array(
                    'message' => 'Trade_asset updated',
                    'metropolis' => $tradeAsset
                )
            );
        } else {
            echo json_encode(
                array(
                    'message' => 'Error'
                )
            );
        }

