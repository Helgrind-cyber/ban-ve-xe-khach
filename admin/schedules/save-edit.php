<?php
session_start();
include_once "../../config/utils.php";
checkAdminLoggedIn();
// lấy thông tin từ form gửi lên
$id = trim($_POST['id']);
$route_id = trim($_POST['route_id']);
$vehicle_id = trim($_POST['vehicle_id']);
$price = trim($_POST['price']);
$start_time = trim($_POST['start_time']);
$end_time = trim($_POST['end_time']);

// // validate bằng php
$pricerr = "";
$start_timerr = "";
$end_timerr = "";


if($pricerr . $start_timerr . $end_timerr != "" ){
    header('location: ' . ADMIN_URL . "schedules/edit-form.php?id=$id&pricerr=$pricerr&start_time=$start_time&end_timerr=$end_timerr");
    die;
}

$updateSchedulesQuery = "update route_schedules 
                    set
                          route_id = '$route_id', 
                          vehicle_id = '$vehicle_id', 
                          price = '$price', 
                          start_time = '$start_time', 
                          end_time = '$end_time' 
                    where id = $id";
queryExecute($updateSchedulesQuery, false);
header("location: " . ADMIN_URL . "schedules");
die;