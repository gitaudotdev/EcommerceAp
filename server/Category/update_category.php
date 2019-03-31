<?php
/**
 * Created by PhpStorm.
 * User: Ted
 * Date: 09/09/2018
 * Time: 11:30
 */
require_once '../../db_functions.php';
$db = new DB_Functions();

if(isset($_POST['id']))
{
    $id = $_POST['id'];
    $name = $_POST['name'];
    $imgPath =$_POST['imgPath'];

    $result =$db->updateCategory($id,$name,$imgPath);
    if($result)
        echo json_encode("Category Updated Successfully..");
    else
        echo json_encode("ERROR while performing updates");
}
else
    echo json_encode("Required parameters(id,name,imgPath)are missing!!");