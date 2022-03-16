<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/db.php';
    include_once '../../models/TradeCapabilities.php';

    $database = new Db();
    $db = $database->connect();

    $tradeCapability = new TradeCapabilities($db);
    $tradeCapability->id = isset($_GET['id']) ? $_GET['id'] : die();

    $tradeCapability->getSingle();
    $tradeCapability_arr = array(
        'id' => $tradeCapability->id,
        'trade_id' => $tradeCapability->trade_id,
        'asset_id' => $tradeCapability->capability_id

    );

    print_r(json_encode($tradeCapability_arr));
