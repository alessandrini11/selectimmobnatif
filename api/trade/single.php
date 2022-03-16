<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/db.php';
    include_once '../../models/Trade.php';
    //inti db
    $database = new Db();
    $db = $database->connect();
    //init trade
    $trade = new Trade($db);
    $trade->id = isset($_GET['id']) ? $_GET['id'] : die();

    $trade->getSingle();

    $user_arr = array(
        'id' => $trade->id,
        'location_id' => $trade->location_id,
        'gallery_id' => $trade->gallery_id,
        'id_trade' => $trade->id_trade,
        'price' => $trade->price,
        'currency' => $trade->currency,
        'title' => $trade->title,
        'agreement' => $trade->agreement,
        'completed' => $trade->completed,
        'type' => $trade->type,
        'ts_creation' => $trade->ts_creation,
        'ts_update' => $trade->ts_update,
        'user_creation' => $trade->user_creation,
        'user_update' => $trade->user_update,
    );
    print_r(json_encode($user_arr));
