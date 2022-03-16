    <?php

    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/db.php';
    include_once '../../models/user.php';

    //init db
    $database = new Db();
    $db = $database->connect();

    //init user
    $user = new User($db);


    //get data from user's entry
    $data = json_decode(file_get_contents("php://input"));

    //set user attributes
    $user->id = $data->id;
    $user->nom = $data->nom;
    $user->prenom = $data->prenom;
    $user->email = $data->email;
    $user->password = $data->password;

    if($user->update()){
        echo json_encode(
            array(
                'message' => 'User updated',
                'user' => $user
            )
        );
    } else {
        echo json_encode(
            array(
                'message' => 'Error'
            )
        );
    }

