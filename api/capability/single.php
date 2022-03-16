<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/db.php';
    include_once '../../models/Capability.php';

    $database = new Db();
    $db = $database->connect();

    $capability = new Capability($db);
    $capability->id = isset($_GET['id']) ? $_GET['id'] : die();

    $capability->getSingle();
    $capability_arr = array(
        'id' => $capability->id,
        'label' => $capability->label,
        'ts_creation' => $capability->ts_creation,
        'user_creation' => $capability->user_creation,
        'ts_update' => $capability->ts_update,
        'user_update' => $capability->user_update,

    );

    print_r(json_encode($capability_arr));
