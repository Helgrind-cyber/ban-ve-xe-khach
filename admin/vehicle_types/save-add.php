<?php
session_start();
include_once "../../config/utils.php";
checkAdminLoggedIn();
$name = trim($_POST['name']);
$status = $_POST['status'];

// validate bằng php
$nameerr = "";
$nameExisterr = "";
$statuserr = "";
// check name
if(strlen($name) < 2 || strlen($name) > 191){
    $nameerr = "Yêu cầu nhập tên loại phương tiện nằm trong khoảng 2-191 ký tự";
}

// check loại xe đã tồn tại hay chưa
$checkTypeQuery = "select * from vehicle_types where name = '$name'";
$types = queryExecute($checkTypeQuery, true);
if($nameExisterr == "" && count($users) > 0){
    $nameExisterr = "Loại phương tiện đã tồn tại";
}

if($nameerr . $nameExisterr!= "" ){
    header('location: ' . ADMIN_URL . "vehicle_types/add-form.php?nameerr=$nameerr&nameExisterr=$nameExisterr");
    die;
}
$insertTypeQuery = "insert into vehicle_types
                          (name, status)
                    values
                          ('$name', '$status')";
queryExecute($insertTypeQuery, false);
header("location: " . ADMIN_URL . "vehicle_types");
die;