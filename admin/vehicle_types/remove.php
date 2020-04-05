<?php
session_start();
include_once "../../config/utils.php";
checkAdminLoggedIn();
// get id from url
$id = isset($_GET['id']) ? $_GET['id'] : -1;

$getVehicleTypesQuery = "select * from vehicle_types where id = '$id'";
$vehicleTypes = queryExecute($getVehicleTypesQuery, false);
if(!$vehicleTypes){
    header("location: " . ADMIN_URL . "vehicle_types?msg=Loại phương tiện không tồn tại");
    die;
}

$removeVehicleTypesQuery = "delete from vehicle_types where id = '$id'";
queryExecute($removeVehicleTypesQuery, false);
header("location: " . ADMIN_URL . "vehicle_types?msg=Xóa loại phương tiện thành công");
die;