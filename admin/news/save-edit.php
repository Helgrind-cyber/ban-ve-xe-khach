<?php
session_start();
include_once "../../config/utils.php";
checkAdminLoggedIn();
// lấy thông tin từ form gửi lên;
$id = trim($_POST['id']);
$content = trim($_POST['content']);
$title = trim($_POST['title']);
$image = $_FILES['image'];
$id = trim($_POST['id']);
// kiểm tra xem tin tức có tồn tại hay không
$getNewsQuery = "select * from news where id = '$id'";
// upload file
$filename = "";
if($image['size'] > 0){
    $filename = uniqid() . '-' . $image['name'];
    move_uploaded_file($image['tmp_name'], "../../public/images/" . $filename);
    $filename = "public/images/" . $filename;
}

$updateNewsQuery = "update news
                    set   image = '$filename',
                          title = '$title',
                          content = '$content'
                    where id = $id";
queryExecute($updateNewsQuery, false);
header("location: " . ADMIN_URL . "news");
die;