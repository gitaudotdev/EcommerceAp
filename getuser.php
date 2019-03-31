<?php
/**
 * Created by PhpStorm.
 * User: Ted
 * Date: 28/07/2018
 * Time: 14:13
 */

require_once  'db_functions.php';
$db = new DB_Functions();
/*
 * Endpoint :http;//<domain>/ecommerce/getuser.php
 * Method: POST
 * params :phone
 * Result :JSON
 */

$response = array();
if(isset($_POST['phone'])) {
    $phone = $_POST['phone'];


//       create new user
    $user = $db->getUserInformation($phone);

    if ($user) {
        $response["phone"] = $user["Phone"];
        $response["name"] = $user["Name"];
        $response["birthdate"] = $user["Birthdate"];
        $response["address"] = $user["Address"];
        $response["avatarUrl"] = $user["avatarUrl"];

        echo json_encode($response);
    } else {
        $response["error_msg"] = "User does not Exist!! ";
        echo json_encode($response);
    }
}

else{
        $response["error_msg"] = "Required parameter(phone)is missing!";
        echo json_encode($response);


}