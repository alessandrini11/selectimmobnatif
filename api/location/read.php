<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/db.php';
    include_once '../../models/Location.php';

    //init database
    $database = new Db();
    $db = $database->connect();
    // init user
    $location = new Location($db);
    // user query
    $results = $location->getAll();
    //row count
    $num = $results->rowCount();

    //check if any user
    if($num > 0 ){
        $location_arr = array();
        $location_arr['data'] = array();
        while($row = $results->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $location_item = array(
                'id' => $id,
                'name' => $name,
                'description' => $description,
                'ts_creation' => $ts_creation,
                'user_creation' => $user_creation,
                'ts_update' => $ts_update,
                'user_update' => $user_update,
                'metropolis_id' => $metropolis_id
            );
            //push to data
            array_push($location_arr['data'],$location_item);
        }
        //turn into json
        echo json_encode($location_arr);
    } else {
        echo json_encode(
            array('message' => 'No location found')
        );
    }