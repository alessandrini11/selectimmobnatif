<?php

    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/Asset.php';

    $database = new Db();
    $db = $database->connect();

    $asset = new Asset($db);
    $data = json_decode(file_get_contents("php://input"));

    $asset->label = $data->label;
    $asset->ts_creation = $data->ts_creation;
    $asset->user_creation = $data->user_creation;
    $asset->ts_update = $data->ts_update;
    $asset->user_update = $data->user_update;

    if($asset->create()){
        echo json_encode(
            array(
                'message' => 'Asset created',
                'asset' => $asset
            )
        );
    } else {
        echo json_encode(
            array(
                'message' => 'Error'
            )
        );
    }

