<?php
session_start();
include_once "../../config/utils.php";
checkAdminLoggedIn();
$distance = trim($_POST['distance']);
$estimate_time = trim($_POST['estimate_time']);
$begin_point = trim($_POST['begin_point']);
$end_point = trim($_POST['end_point']);
// validate bằng php
$distanceerr = "";
$estimate_timeerr = "";
$begin_pointerr = "";
$end_pointerr = "";

// kiểm tra distance có phải kiểu số không
if (!is_numeric($distance)) {
    $distanceerr = "Yêu cầu nhập vào khoảng cách quãng đường bằng số";
}
if ($distance < 100 || $distance > 200) {
    $distanceerr = "Yêu cầu nhập khoảng cách trong khoảng 100-200 KM";
}
# ===================== không format được định dạng thời gian =====================
# ===================== không format được thời gian tối thiểu =====================
# ===================== không format được thời gian tối đa =====================
// kiểm tra begin point
if (strlen($begin_point) < 2 || strlen($begin_point) > 191) {
    $begin_pointerr = "Yêu cầu nhập trong khoảng 2-191 ký tự";
}
$checkBeginPointQuery = "select * from routes begin_point = '$begin_point'";
$beginPoint = queryExecute($checkBeginPointQuery, true);
if ($begin_pointerr == "" && count($begin_point) > 0) {
    $begin_pointerr = "Điểm đầu đã tồn tại";
}
// kiểm tra end point
if (strlen($end_point) < 2 || strlen($end_point) > 191) {
    $end_pointerr = "Yêu cầu nhập trong khoảng 2-191 ký tự";
}
$checkBeginPointQuery = "select * from routes end_point = '$end_point'";
$beginPoint = queryExecute($checkBeginPointQuery, true);
if ($end_pointerr == "" && count($end_point) > 0) {
    $end_pointerr = "Điểm đầu đã tồn tại";
}

if ($distanceerr . $begin_pointerr . $end_pointerr != "") {
    header('location: ' . ADMIN_URL . "routes/add-form.php?distanceerr=$distanceerr&begin_pointerr=$begin_pointerr&end_pointerr=$end_pointerr");
    die;
}

$updateRoutesQuery = "update routes
                    set
                        distance = '$distance',
                        estimate_time = '$estimate_time',
                        begin_point = '$begin_point',
                        end_point = '$end_point'
                        where id = '$id'";
queryExecute($updateRoutesQuery, false);
header("location: " . ADMIN_URL . "routes?msg=Sửa thông tin quãng đường thành công");
die;