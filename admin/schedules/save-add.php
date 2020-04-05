<?php
session_start();
include_once "../../config/utils.php";
checkAdminLoggedIn();
$route_id = trim($_POST['route_id']);
$vehicle_id = trim($_POST['vehicle_id']);
$price = (int)($_POST['price']);
$start_time = trim($_POST['start_time']);
$end_time = trim($_POST['end_time']);
// validate bằng PHP
$priceerr = "";
if ($price < 0) {
      $priceerr = "Không được nhập giá trị là số âm";
}

if ($price > 500000) {
      $priceerr = "Giá tiền không vượt quá 500,000 VND";
}

if ($priceerr != "") {
      header('location: ' . ADMIN_URL . "schedules/add-form.php?priceerr=$priceerr");
      die;
}

$insertSchedulesQuery = "insert into route_schedules
                          (route_id, vehicle_id, price, start_time, end_time)
                    values
                          ('$route_id', '$vehicle_id', '$price', '$start_time', '$start_time')";
// dd($insertSchedulesQuery);
queryExecute($insertSchedulesQuery, false);
header("location: " . ADMIN_URL . "schedules?msg=Thêm lịch trình thành công");
die;
