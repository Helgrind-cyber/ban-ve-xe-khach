<?php
session_start();
require_once '../../config/utils.php';
$email = $_POST['email'];
$userId = isset($_POST['id']) ? $_POST['id'] : false;
$checkEmailQuery = "select * from users where email = '$email'";


if($userId !== false){
    $checkEmailQuery .= " and id != $userId";
}

$users = queryExecute($checkEmailQuery, true);
echo count($users) == 0 ? "true" : "false";