<?php

    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/Trade.php';

    //init db
    $database = new Db();
    $db = $database->connect();

    //init trade
    $trade = new Trade($db);
    $data = json_decode(file_get_contents("php://input"));

    $trade->location_id = $data->location_id;
    $trade->gallery_id = $data->gallery_id;
    $trade->id_trade = $data->id_trade;
    $trade->price = $data->price;
    $trade->currency = $data->currency;
    $trade->title = $data->title;
    $trade->agreement = $data->agreement;
    $trade->completed = $data->completed;
    $trade->type = $data->type;
    $trade->ts_creation = $data->ts_creation;
    $trade->ts_update = $data->ts_update;
    $trade->user_creation = $data->user_creation;
    $trade->user_update = $data->user_update;

    if($trade->create()){
        echo json_encode(
            array(
                'message' => 'Trade created',
                'trade' => $trade
            )
        );
    } else {
        echo json_encode(
            array(
                'message' => 'Error'
            )
        );
    }

