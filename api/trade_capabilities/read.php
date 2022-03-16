<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/db.php';
    include_once '../../models/TradeCapabilities.php';

    //init database
    $database = new Db();
    $db = $database->connect();
    // init user
    $tradeCapabilities = new TradeCapabilities($db);
    // user query
    $results = $tradeCapabilities->getAll();
    //row count
    $num = $results->rowCount();

    //check if any user
    if($num > 0 ){
        $tradeCapabilities_arr = array();
        $tradeCapabilities_arr['data'] = array();
        while($row = $results->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $tradeCapabilities_item = array(
                'id' => $id,
                'trade_id' => $trade_id,
                'capability_id' => $capability_id,
            );
            //push to data
            array_push($tradeCapabilities_arr['data'],$tradeCapabilities_item);
        }
        //turn into json
        echo json_encode($tradeCapabilities_arr);
    } else {
        echo json_encode(
            array('message' => 'No trade_capability found')
        );
    }