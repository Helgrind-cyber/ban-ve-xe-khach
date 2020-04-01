<?php
session_start();
include_once "../../config/utils.php";
checkAdminLoggedIn();
$id = isset($_GET['id']) ? $_GET['id'] : -1;

$getRemoveVehiclesQuery = "select * from vehicles where id = $id";
$removeVehicle = queryExecute($getRemoveVehiclesQuery, false);
if(!$removeVehicle){
    header("location: " . ADMIN_URL . "vehicles?msg=Phương tiện không tồn tại");
    die;
}

$removeVehicleQuery = "delete from vehicles where id = $id";
queryExecute($removeVehicleQuery, false);
header("location: " . ADMIN_URL . "vehicles?msg=Xóa phương tiện thành công");
die;