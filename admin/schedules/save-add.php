<?php
session_start();
include_once "../../config/utils.php";
checkAdminLoggedIn();
$route_id = trim($_POST['route_id']);
$vehicle_id = trim($_POST['vehicle_id']);
$price = trim($_POST['price']);
$start_time = trim($_POST['start_time']);
$end_time = trim($_POST['end_time']);

$insertSchedulesQuery = "insert into route_schedules
                          (route_id, vehicle_id, price, start_time, end_time)
                    values
                          ('$route_id', '$vehicle_id', '$price', '$start_time', '$start_time')";
queryExecute($insertSchedulesQuery, false);
header("location: " . ADMIN_URL . "schedules");
die;
