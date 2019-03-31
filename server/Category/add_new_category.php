<?php
/**
 * Created by PhpStorm.
 * User: Ted
 * Date: 08/09/2018
 * Time: 14:42
 */
require_once  '../../db_functions.php';
$db = new DB_Functions();
//$result=array();

if(isset($_POST['name'])
    && isset($_POST['imgPath']))
{
    $name = $_POST['name'];
    $imgPath = $_POST['imgPath'];

    $result = $db->insertNewCategory($name,$imgPath);
    if($result)
        echo json_encode("Category Added Successfully");
    else
        echo json_encode("Error while writing to database");

}
else
    echo json_encode("Required parameters (name , imgPath) are missing");