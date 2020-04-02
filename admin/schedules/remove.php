<?php
/**
 * 1. lấy id xuống
 * 2. kiểm tra xem có quyền để xóa tài khoản với id đc nhận hay không
 * 4. thực hiện câu lệnh xóa với csdl
 * 5. điều hướng về danh sách
 *
 */
session_start();
include_once "../../config/utils.php";
checkAdminLoggedIn();
$id = isset($_GET['id']) ? $_GET['id'] : -1;

$getRemoveSchedulesQuery = "select * from route_schedules where id = $id";
$removeSchedules = queryExecute($getRemoveSchedulesQuery, false);
if(!$removeSchedules){
    header("location: " . ADMIN_URL . "schedules?msg=Lịch trình không tồn tại");
    die;
}

$removeSchedulesQuery = "delete from route_schedules where id = $id";
queryExecute($removeSchedulesQuery, false);
header("location: " . ADMIN_URL . "schedules?msg=Xóa lịch trình thành công");
die;