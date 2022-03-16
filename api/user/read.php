<?php
//headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json'); 

    include_once '../../config/db.php';
    include_once '../../models/user.php';

    //init database
    $database = new Db();
    $db = $database->connect();
    // init user
    $user = new User($db);
    // user query
    $results = $user->getAll();
    //row count
    $num = $results->rowCount();

    //check if any user
    if($num > 0 ){
        $users_arr = array();
        $users_arr['data'] = array();
        while($row = $results->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $user_item = array(
                'id' => $id,
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'password' => $password,
            );
            //push to data
            array_push($users_arr['data'],$user_item);
        }
        //turn into json
        echo json_encode($users_arr);
    } else {
        echo json_encode(
            array('message' => 'No user found')
        );
    }