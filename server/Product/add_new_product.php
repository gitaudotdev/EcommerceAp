<?php
/**
 * Created by PhpStorm.
 * User: Gitau.dev
 * Date: 21/09/2018
 * Time: 17:10
 */
require_once '../../db_functions.php';
$db = new DB_Functions();
//$response = array();

if(isset($_POST['name'])&&
isset($_POST['imgPath']))
{
    $name = $_POST['name'];
    $imgPath = $_POST['imgPath'];

    $result =$this->conn->prepare("");


}
else
    echo json_encode("Required parameters (name , imgPath) are missing");