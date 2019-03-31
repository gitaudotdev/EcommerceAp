<?php
/**
 * Created by PhpStorm.
 * User: Ted
 * Date: 28/07/2018
 * Time: 14:03
 */

require_once  'db_functions.php';
$db = new DB_Functions();
/*
 * Endpoint :http;//<domain>/ecommerce/checkuser.php
 * Method: Post
 * params :phone
 * Result :json
 */

$response = array();


if(isset($_POST['phone']))
{
    $phone = $_POST['phone'];


    if($db->checkUserExists($phone))
    {
        $response["exists"] =TRUE;
        echo json_encode($response);
    }
    else
    {
        $response["exists"] =FALSE;
        echo json_encode($response);
    }

}
else{
    $response["error_msg"]= "Required parameter(phone)is missing!";
    echo json_encode($response);
}