<?php
session_start();
include_once "../../config/utils.php";
checkAdminLoggedIn();
$name = trim($_POST['name']);
$status = trim($_POST['status']);
// $seat = trim($_POST['seat']);
$seat = (int)($_POST['seat']);
// validate bằng php
$nameerr = "";
$seaterr = "";
// check name
if(strlen($name) < 2 || strlen($name) > 191){
    $nameerr = "Yêu cầu nhập tên loại phương tiện nằm trong khoảng 2-191 ký tự";
}

// check loại xe đã tồn tại hay chưa
$checkTypeQuery = "select * from vehicle_types where name = '$name'";
$checkVehicleTypes = queryExecute($checkTypeQuery, true);
if($nameerr == "" && count($users) > 0){
    $nameerr = "Loại phương tiện đã tồn tại";
}
// kiểm tra số ghế
// if (is_string($seat)) {
//     $seaterr = "Hãy nhập số ghế bằng số";
// }
if ($seat < 9 || $seat > 40) {
    $seaterr = "Không thể đặt số ghế nhỏ hơn 9 và lớn hơn 40 chỗ";
}

if($nameerr . $seaterr != ""){
    header('location: ' . ADMIN_URL . "vehicle_types/add-form.php?nameerr=$nameerr&seaterr=$seaterr");
    die;
}
$insertTypeQuery = "insert into vehicle_types
                          (name, status, seat)
                    values
                          ('$name', '$status', '$seat')";
queryExecute($insertTypeQuery, false);
header("location: " . ADMIN_URL . "vehicle_types");
die;