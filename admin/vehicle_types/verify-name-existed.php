<?php
session_start();
require_once '../../config/utils.php';
$name = $_POST['name'];
$typeId = isset($_POST['id']) ? $_POST['id'] : false;
$checkVehicleTypeQuery = "select * from vehicle_types where name = '$name'";

if($typeId !== false){
    $checkVehicleTypeQuery .= " and id != $typeId";
}

$types = queryExecute($checkVehicleTypeQuery, true);
echo count($types) == 0 ? "true" : "false";