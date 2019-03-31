<?php
/**
 * Created by PhpStorm.
 * User: Ted
 * Date: 13/08/2018
 * Time: 16:48
 */
require_once  'db_functions.php';
$db = new DB_Functions();
/*
 * Endpoint :http;//<domain>/ecommerce/getdrink.php
 * Method: POST
 * params :menuId
 * Result :JSON
 */

$response = array();
if(isset($_POST['menuid'])) {

    $menuid = $_POST['menuid'];



    $drinks = $db->getDrinkByMenuID($menuid);

        echo json_encode($drinks);

}

else {
    $response["error_msg"] = "Required parameter(menuid)is missing!";
    echo json_encode($response);
}