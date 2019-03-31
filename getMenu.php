<?php
/**
 * Created by PhpStorm.
 * User: Ted
 * Date: 13/08/2018
 * Time: 14:17
 */

require_once  'db_functions.php';
$db = new DB_Functions();

    $menu = $db->getMenu();
    echo json_encode($menu);