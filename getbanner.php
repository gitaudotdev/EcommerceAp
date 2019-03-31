<?php
/**
 * Created by PhpStorm.
 * User: Ted
 * Date: 28/07/2018
 * Time: 14:13
 */

require_once  'db_functions.php';

$db = new DB_Functions();

    $banners = $db->getBanners();
    echo json_encode($banners);



