<?php
session_start();
include_once "../../config/utils.php";
checkAdminLoggedIn();
$id = trim($_POST['id']);
$route_id = trim($_POST['route_id']);
$vehicle_id = trim($_POST['vehicle_id']);
$price = (int) ($_POST['price']);
$start_time = trim($_POST['start_time']);
$end_time = trim($_POST['end_time']);
// validate bằng PHP
$priceerr = "";
$scheduleserr = "";
if ($price < 0) {
    $priceerr = "Không được nhập giá trị là số âm";
}

if ($price > 500000) {
    $priceerr = "Giá tiền không vượt quá 500,000 VND";
}

// kiểm tra xem tin tức có tồn tại hay không
$getSchedulesQuery = "select * from route_schedules where id = '$id'";
$schedules = queryExecute($getSchedulesQuery, false);
if ($scheduleserr == "" && count($schedules) == 0) {
    $scheduleserr = "Lịch trình không tồn tại, không thể sửa";
}

if ($scheduleserr != "") {
    header('location: ' . ADMIN_URL . "schedules/edit-form.php?msg=$scheduleserr");
    die;
}

if ($priceerr != "") {
    header('location: ' . ADMIN_URL . "schedules/edit-form.php?priceerr=$priceerr");
    die;
}


$updateSchedulesQuery = "update route_schedules
                    set
                          route_id = '$route_id',
                          vehicle_id = '$vehicle_id',
                          price = '$price',
                          start_time = '$start_time',
                          end_time = '$end_time'
                    where id = '$id'";
queryExecute($updateSchedulesQuery, false);
header("location: " . ADMIN_URL . "schedules?msg=Sửa lịch trình thành công");
die;