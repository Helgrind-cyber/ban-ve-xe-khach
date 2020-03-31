<?php
/**
 * Created by PhpStorm.
 * User: ginv2
 * Date: 2/17/20
 * Time: 18:41
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

$getRemoveVehiclesQuery = "select * from vehicles where id = $id";
$removeVehicle = queryExecute($getRemoveVehiclesQuery, false);
if(!$removeVehicle){
    header("location: " . ADMIN_URL . "vehicles?msg=Phương tiện không tồn tại");
    die;
}

//if($removeUser['role_id'] >= $_SESSION[AUTH]['role_id']){
//    header("location: " . ADMIN_URL . "users?msg=Không đủ quyền hạn thực hiện hành động này");
//    die;
//}

$removeVehicleQuery = "delete from vehicles where id = $id";
queryExecute($removeVehicleQuery, false);
header("location: " . ADMIN_URL . "vehicles?msg=Xóa phương tiện thành công");
die;