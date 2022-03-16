<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/db.php';
    include_once '../../models/Metropolis.php';

    //init database
    $database = new Db();
    $db = $database->connect();
    // init user
    $metropolis = new Metropolis($db);
    // user query
    $results = $metropolis->getAll();
    //row count
    $num = $results->rowCount();

    //check if any user
    if($num > 0 ){
        $metropolis_arr = array();
        $metropolis_arr['data'] = array();
        while($row = $results->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $metropolis_item = array(
                'id' => $id,
                'name' => $name,
                'code' => $code,
                'state' => $state,
                'icon_url' => $icon_url,
                'ts_creation' => $ts_creation,
                'user_creation' => $user_creation,
                'ts_update' => $ts_update,
                'user_update' => $user_update
            );
            //push to data
            array_push($metropolis_arr['data'],$metropolis_item);
        }
        //turn into json
        echo json_encode($metropolis_arr);
    } else {
        echo json_encode(
            array('message' => 'No metropolis found')
        );
    }