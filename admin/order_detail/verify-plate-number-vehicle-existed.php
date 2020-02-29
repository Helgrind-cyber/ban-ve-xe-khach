<?php
session_start();
require_once '../../config/utils.php';
$plate_number = $_POST['plate_number'];

$vehicleId = isset($_POST['id']) ? $_POST['id'] : false;

$checkPlateNumberQuery = "select * from vehicles where plate_number = '$plate_number'";

if($vehicleId !== false){
    $checkPlateNumberQuery .= " and id != $vehicleId";
}

$plate_numbers = queryExecute($checkPlateNumberQuery, true);
echo count($plate_numbers) == 0 ? "true" : "false";