<?php
session_start();
include_once "../../config/utils.php";
checkAdminLoggedIn();
// lấy thông tin từ form gửi lên
$id = trim($_POST['id']);
$name = trim($_POST['name']);
$status = $_POST['status'];

// validate bằng php
$nameerr = "";

// check name
if(strlen($name) < 2 || strlen($name) > 191){
    $nameerr = "Yêu cầu nhập loại phương tiện nằm trong khoảng 2-191 ký tự";
}

if($nameerr != "" ){
    header('location: ' . ADMIN_URL . "vehicle_types/edit-form.php?id=$id&nameerr=$nameerr");
    die;
}


$updateVehicleTypeQuery = "update vehicle_types
                    set
                          name = '$name',
                          status = '$status'
                    where id = $id";

queryExecute($updateVehicleTypeQuery, false);
header("location: " . ADMIN_URL . "vehicle_types");
die;