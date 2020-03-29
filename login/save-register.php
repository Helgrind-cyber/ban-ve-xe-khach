<?php
session_start();
include_once "./config/utils.php";

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$cfpassword = trim($_POST['cfpassword']);

// validate bằng php
$nameerr = "";
$emailerr = "";
$passworderr = "";
// check name
if (strlen($name) < 2 || strlen($name) > 191) {
    $nameerr = "Yêu cầu nhập tên tài khoản nằm trong khoảng 2-191 ký tự";
}

// check email
if (strlen($email) == 0) {
    $emailerr = "Yêu cầu nhập email!";
}
if ($emailerr == "" && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $emailerr = "Không đúng định dạng email";
}
// check email đã tồn tại hay chưa
$checkEmailQuery = "select * from users where email = '$email'";
$users = queryExecute($checkEmailQuery, true);
if ($emailerr == "" && count($users) > 0) {
    $emailerr = "Email đã tồn tại, vui lòng sử dụng email khác";
}
// check password
if (strlen($password) < 6) {
    $passworderr = "Mật khẩu cần >= 6 ký tự";
}

if ($passworderr == "" && $password != $cfpassword) {
    $passworderr = "Mật khẩu và nhập lại mật khẩu";
}

if ($nameerr . $emailerr . $passworderr != "") {
    header('location: ' . BASE_URL . "register.php?nameerr=$nameerr&emailerr=$emailerr&passworderr=$passworderr");
    die;
}
// mã hóa mật khẩu
$password = password_hash($password, PASSWORD_DEFAULT);

$role_id = 1;
$filename = "public/img/default-image.jpg";
$messages = "Từ giờ bạn có thể đăng nhập được rồi";
// insert query
$insertUserQuery = "insert into users
                          (name, password, email, role_id, phone_number, avatar)
                    values
                          ('$name', '$password', '$email', '$role_id', '$phone_number', '$filename')";

// dd($insertUserQuery);
queryExecute($insertUserQuery, false);
header("location: " . BASE_URL . "login.php?messages=$messages&style=none");
die;
