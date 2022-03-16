<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/db.php';
    include_once '../../models/Capability.php';

    //init database
    $database = new Db();
    $db = $database->connect();
    // init user
    $capability = new Capability($db);
    // user query
    $results = $capability->getAll();
    //row count
    $num = $results->rowCount();

    //check if any user
    if($num > 0 ){
        $capability_arr = array();
        $capability_arr['data'] = array();
        while($row = $results->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $capability_item = array(
                'id' => $id,
                'label' => $label,
                'ts_creation' => $ts_creation,
                'user_creation' => $user_creation,
                'ts_update' => $ts_update,
                'user_update' => $user_update,
            );
            //push to data
            array_push($capability_arr['data'],$capability_item);
        }
        //turn into json
        echo json_encode($capability_arr);
    } else {
        echo json_encode(
            array('message' => 'No capability found')
        );
    }