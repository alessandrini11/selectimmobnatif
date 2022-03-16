<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/db.php';
    include_once '../../models/Location.php';

    $database = new Db();
    $db = $database->connect();

    $location = new Location($db);
    $location->id = isset($_GET['id']) ? $_GET['id'] : die();

    $location->getSingle();
    $location_arr = array(
        'id' => $location->id,
        'name' => $location->name,
        'description' => $location->description,
        'ts_creation' => $location->ts_creation,
        'user_creation' => $location->user_creation,
        'ts_update' => $location->ts_update,
        'user_update' => $location->user_update,
        'metropolis_id' => $location->metropolis_id,

    );

    print_r(json_encode($location_arr));
