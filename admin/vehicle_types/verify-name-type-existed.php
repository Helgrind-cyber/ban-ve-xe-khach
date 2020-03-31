<?php
session_start();
require_once '../../config/utils.php';
$name = $_POST['name'];

$typeId = isset($_POST['id']) ? $_POST['id'] : false;

$checkTypeQuery = "select * from vehicle_types where name = '$name'";

if($typeId !== false){
    $checkTypeQuery .= " and id != $typeId";
}

$types = queryExecute($checkTypeQuery, true);
echo count($types) == 0 ? "true" : "false";