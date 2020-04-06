<?php
session_start();
include_once "../../config/utils.php";
checkAdminLoggedIn();
$id = trim($_POST['id']);
$plate_number = trim($_POST['plate_number']);
$type_id = trim($_POST['vehicletype_id']);
// validate bằng php

$plate_numbererr = "";

if(strlen($plate_number) == 0){
    $plate_numbererr = "Yêu cầu nhập biển số xe";
}

// check plate_number đã tồn tại hay chưa
$checkPlateQuery = "select * from vehicles where plate_number = '$plate_number' and id != $id";

$plates = queryExecute($checkPlateQuery, true);
if($plates == "" && count($plates) > 0){
    $plate_numbererr = "Biển số đã tồn tại, vui lòng sử dụng biển số khác";
}


if($plate_numbererr != "" ){
    header('location: ' . ADMIN_URL . "vehicles/edit-form.php?plate_numbererr=$plate_numbererr");
    die;
}

$updateVehicleQuery = "update vehicles
                    set
                        type_id = '$type_id',
                        plate_number = '$plate_number'
                    where id = '$id'";
queryExecute($updateVehicleQuery, false);

header("location: " . ADMIN_URL . "vehicles?msg=Sửa thông tin phương tiện thành công");
die;