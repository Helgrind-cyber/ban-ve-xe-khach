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

$getRemoveRoutesQuery = "select * from routes where id = '$id'";
$removeRoutes = queryExecute($getRemoveRoutesQuery, false);
if(!$removeRoutes){
    header("location: " . ADMIN_URL . "routes?msg=Quãng đường không tồn tại");
    die;
}

//if($removeUser['role_id'] >= $_SESSION[AUTH]['role_id']){
//    header("location: " . ADMIN_URL . "users?msg=Không đủ quyền hạn thực hiện hành động này");
//    die;
//}

$removeRoutesQuery = "delete from routes where id = $id";
queryExecute($removeRoutesQuery, false);
header("location: " . ADMIN_URL . "routes?msg=Xóa quãng đường thành công");
die;