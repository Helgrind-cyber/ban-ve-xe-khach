<?php
session_start();
include_once "../../config/utils.php";
checkAdminLoggedIn();
// lấy thông tin từ form gửi lên
$id = trim($_POST['id']);
$name = trim($_POST['name']);
$status = trim($_POST['status']);
$seat = trim($_POST['seat']);
// validate bằng php
$nameerr = "";

// check name
if(strlen($name) < 2 || strlen($name) > 191){
    $nameerr = "Yêu cầu nhập loại phương tiện nằm trong khoảng 2-191 ký tự";
}

// kiểm tra số ghế
if (is_numeric($seat)) {
    if ($seat < 9 || $seat > 40) {
        $seaterr = "Không thể đặt số ghế nhỏ hơn 9 và lớn hơn 40 chỗ";
    }
} else {
    $seaterr = "Hãy nhập số ghế bằng số";
}

if ($nameerr && $seaterr != "") {
    header('location: ' . ADMIN_URL . "vehicle_types/edit-form.php?nameerr=$nameerr&seaterr=$seaterr");
    die;
}

$updateVehicleTypeQuery = "update vehicle_types
                    set
                          name = '$name',
                          status = '$status',
                          seat = '$seat'
                    where id = '$id'";
queryExecute($updateVehicleTypeQuery, false);
header("location: " . ADMIN_URL . "vehicle_types");
die;