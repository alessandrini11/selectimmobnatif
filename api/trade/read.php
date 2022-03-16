<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/db.php';
    include_once '../../models/Trade.php';

    //init database
    $database = new Db();
    $db = $database->connect();
    // init user
    $user = new Trade($db);
    // user query
    $results = $user->getAll();
    //row count
    $num = $results->rowCount();

    //check if any user
    if($num > 0 ){
        $trade_arr = array();
        $trade_arr['data'] = array();
        while($row = $results->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $trade_item = array(
                'id' => $id,
                'location_id' => $location_id,
                'gallery_id' => $gallery_id,
                'id_trade' => $id_trade,
                'price' => $price,
                'currency' => $currency,
                'title' => $title,
                'agreement' => $agreement,
                'completed' => $completed,
                'ts_creation' => $ts_creation,
                'user_creation' => $user_creation,
                'ts_update' => $ts_update,
                'user_update' => $user_update,
                'type' => $type,
            );
            //push to data
            array_push($trade_arr['data'],$trade_item);
        }
        //turn into json
        echo json_encode($trade_arr);
    } else {
        echo json_encode(
            array('message' => 'No trade found')
        );
    }