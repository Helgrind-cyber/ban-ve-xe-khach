<?php
session_start();
include_once "../../config/utils.php";
checkAdminLoggedIn();
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$cfpassword = trim($_POST['cfpassword']);
$phone_number = trim($_POST['phone_number']);
$role_id = trim($_POST['role_id']);
// validate bằng php
$nameerr = "";
$emailerr = "";
$passworderr = "";
$phone_numbererr = "";
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
    $passworderr = "Mật khẩu và nhập lại mật khẩu không khớp nhau";
}

if (strlen($phone_number) !== 10) {
    $phone_numbererr = "Yêu cầu nhập 10 so";
}

if ($nameerr . $emailerr . $passworderr . $phone_numbererr != "") {
    header('location: ' . ADMIN_URL . "users/add-form.php?nameerr=$nameerr&emailerr=$emailerr&passworderr=$passworderr&phone_numbererr=$phone_numbererr");
    die;
}
// mã hóa mật khẩu
$password = password_hash($password, PASSWORD_DEFAULT);
// upload file ảnh
$insertUserQuery = "insert into users
                          (name, email, password, phone_number, role_id)
                    values
                          ('$name', '$email', '$password', '$phone_number', '$role_id')";
queryExecute($insertUserQuery, false);
header("location: " . ADMIN_URL . "users");
die;
