<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/db.php';
    include_once '../../models/Asset.php';

    //init database
    $database = new Db();
    $db = $database->connect();
    // init user
    $asset = new Asset($db);
    // user query
    $results = $asset->getAll();
    //row count
    $num = $results->rowCount();

    //check if any user
    if($num > 0 ){
        $asset_arr = array();
        $asset_arr['data'] = array();
        while($row = $results->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $asset_item = array(
                'id' => $id,
                'label' => $label,
                'ts_creation' => $ts_creation,
                'user_creation' => $user_creation,
                'ts_update' => $ts_update,
                'user_update' => $user_update,
            );
            //push to data
            array_push($asset_arr['data'],$asset_item);
        }
        //turn into json
        echo json_encode($asset_arr);
    } else {
        echo json_encode(
            array('message' => 'No asset found')
        );
    }