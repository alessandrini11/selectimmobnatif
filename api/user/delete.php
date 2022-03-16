    <?php

    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/user.php';

    //init db
    $database = new Db();
    $db = $database->connect();

    //init user
    $user = new User($db);

    //set user attributes
    $user->id = isset($_GET['id']) ? $_GET['id'] : die();

    if($user->delete()){
        echo json_encode(
            array(
                'message' => 'User deleted'
            )
        );
    } else {
        echo json_encode(
            array(
                'message' => 'Error'
            )
        );
    }

