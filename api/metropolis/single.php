<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/db.php';
    include_once '../../models/Metropolis.php';

    $database = new Db();
    $db = $database->connect();

    $metropolis = new Metropolis($db);
    $metropolis->id = isset($_GET['id']) ? $_GET['id'] : die();

    $metropolis->getSingle();
    $metropolis_arr = array(
        'id' => $metropolis->id,
        'name' => $metropolis->name,
        'code' => $metropolis->code,
        'state' => $metropolis->state,
        'icon_url' => $metropolis->icon_url,
        'ts_creation' => $metropolis->ts_creation,
        'user_creation' => $metropolis->user_creation,
        'ts_update' => $metropolis->ts_update,
        'user_update' => $metropolis->user_update

    );

    print_r(json_encode($metropolis_arr));
