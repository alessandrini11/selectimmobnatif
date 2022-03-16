<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/db.php';
    include_once '../../models/TradeAsset.php';

    //init database
    $database = new Db();
    $db = $database->connect();
    // init user
    $tradeAsset = new TradeAsset($db);
    // user query
    $results = $tradeAsset->getAll();
    //row count
    $num = $results->rowCount();

    //check if any user
    if($num > 0 ){
        $tradeAsset_arr = array();
        $tradeAsset_arr['data'] = array();
        while($row = $results->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $tradeAsset_item = array(
                'id' => $id,
                'trade_id' => $trade_id,
                'asset_id' => $asset_id,
            );
            //push to data
            array_push($tradeAsset_arr['data'],$tradeAsset_item);
        }
        //turn into json
        echo json_encode($tradeAsset_arr);
    } else {
        echo json_encode(
            array('message' => 'No trade_asset found')
        );
    }