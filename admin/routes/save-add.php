<?php
session_start();
include_once "../../config/utils.php";
checkAdminLoggedIn();
$distance = trim($_POST['distance']);
$estimate_time = trim($_POST['estimate_time']);
$begin_point = trim($_POST['begin_point']);
$end_point = trim($_POST['end_point']);

// validate bằng php
// $distanceerr = "";
// $estimate_timeerr = "";
// $begin_pointerr = "";
// $end_pointerr = "";

// if(strlen($begin_point) < 2 || strlen($begin_point) > 191){
//     $begin_pointrr = "Yêu cầu nhập trong khoảng 2-191 ký tự";
// }
// if(strlen($end_point) < 2 || strlen($end_point) > 191){
//     $end_pointrr = "Yêu cầu nhập trong khoảng 2-191 ký tự";
// }
// if(strlen($distance) == 0){
//     $distanceerr = "Yêu cầu nhập khoảng cách quãng đường";
// }

// // check quãng đường đã tồn tại hay chưa
// $checkTypeQuery = "select * from routes where begin_point = '$begin_point'";
// $types = queryExecute($checkTypeQuery, true);
// if($nameExisterr == "" && count($users) > 0){
//     $begin_pointerr = "Điểm bắt đầu đã tồn tại";
// }

// if($nameerr . $nameExisterr!= "" ){
//     header('location: ' . ADMIN_URL . "vehicle_types/add-form.php?nameerr=$nameerr&nameExisterr=$nameExisterr");
//     die;
// }

$insertRoutesQuery = "insert into routes
                          (distance, estimate_time, begin_point, end_point)
                    values
                          ('$distance', '$estimate_time','$begin_point', '$end_point')";

queryExecute($insertRoutesQuery, false);
// dd($insertRoutesQuery);
header("location: " . ADMIN_URL . "routes?msg=Thêm quãng đường thành công");
die;