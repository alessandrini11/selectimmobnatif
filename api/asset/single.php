<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/db.php';
    include_once '../../models/Asset.php';

    $database = new Db();
    $db = $database->connect();

    $asset = new Asset($db);
    $asset->id = isset($_GET['id']) ? $_GET['id'] : die();

    $asset->getSingle();
    $user_arr = array(
        'id' => $asset->id,
        'label' => $asset->label,
        'ts_creation' => $asset->ts_creation,
        'user_creation' => $asset->user_creation,
        'ts_update' => $asset->ts_update,
        'user_update' => $asset->user_update,

    );

    print_r(json_encode($user_arr));
