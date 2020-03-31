<?php
session_start();
include_once "../../config/utils.php";
checkAdminLoggedIn();
$id = trim($_POST['id']);
$distance = trim($_POST['distance']);
$estimate_time = trim($_POST['estimate_time']);
$begin_point = trim($_POST['begin_point']);
$end_point = trim($_POST['end_point']);

// validate bằng php
if(strlen($begin_point) < 2 || strlen($begin_point) > 191){
    $begin_pointrr = "Yêu cầu nhập trong khoảng 2-191 ký tự";
}
if(strlen($end_point) < 2 || strlen($end_point) > 191){
    $end_pointrr = "Yêu cầu nhập trong khoảng 2-191 ký tự";
}
if(strlen($distance) == 0){
    $distancerr = "Yêu cầu nhập khoảng cách quãng đường";
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