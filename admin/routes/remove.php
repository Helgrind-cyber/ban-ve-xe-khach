<?php
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

$removeRoutesQuery = "delete from routes where id = $id";
queryExecute($removeRoutesQuery, false);
header("location: " . ADMIN_URL . "routes?msg=Xóa quãng đường thành công");
die;