<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/db.php';
    include_once '../../models/TradeAsset.php';

    $database = new Db();
    $db = $database->connect();

    $tradeAsset = new TradeAsset($db);
    $tradeAsset->id = isset($_GET['id']) ? $_GET['id'] : die();

    $tradeAsset->getSingle();
    $metropolis_arr = array(
        'id' => $tradeAsset->id,
        'trade_id' => $tradeAsset->trade_id,
        'asset_id' => $tradeAsset->asset_id

    );

    print_r(json_encode($metropolis_arr));
