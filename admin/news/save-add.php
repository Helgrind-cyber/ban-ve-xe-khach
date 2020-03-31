<?php
session_start();
include_once "../../config/utils.php";
checkAdminLoggedIn();

$content = trim($_POST['content']);
$title = trim($_POST['title']);
$image = $_FILES['image'];
// validate bằng php
$nameerr = "";
$emailerr = "";
$passworderr = "";
// check name


// check email


// check email đã tồn tại hay chưa

// check password

// mã hóa mật khẩu
$password = password_hash($password, PASSWORD_DEFAULT);
// upload file ảnh
$filename = "";
if($image['size'] > 0){
    $filename = uniqid() . '-' . $image['name'];
    move_uploaded_file($image['tmp_name'], "../../public/images/" . $filename);
    $filename = "public/images/" . $filename;
}
$insertNewsQuery = "insert into news
                          (image, title, content)
                    values
                          ('$filename', '$title', '$content')";
queryExecute($insertNewsQuery, false);
header("location: " . ADMIN_URL . "news");
die;
