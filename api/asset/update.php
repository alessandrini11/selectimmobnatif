<?php

    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/Asset.php';

    //init db
    $database = new Db();
    $db = $database->connect();

    //init user
    $asset = new Asset($db);


    //get data from user's entry
    $data = json_decode(file_get_contents("php://input"));

    //set user attributes
    $asset->id = isset($_GET['id']) ? $_GET['id'] : die();

    $asset->label = $data->label;
    $asset->ts_creation = $data->ts_creation;
    $asset->user_creation = $data->user_creation;
    $asset->ts_update = $data->ts_update;
    $asset->user_update = $data->user_update;

    if($asset->update()){
        echo json_encode(
            array(
                'message' => 'Asset updated',
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

