<?php
require_once 'db_functions.php';
$db = new DB_FUNCTIONS();

$drinks = $db->getAllDrinks();
if($drinks)
	echo json_encode($drinks);
else
	echo json_encode("Error");