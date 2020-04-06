<?php
session_start();
require_once '../config/utils.php';
$email = $_POST['email'];
$checkEmailQuery = "select * from users where email = '$email'";

$users = queryExecute($checkEmailQuery, true);
echo count($users) == 0 ? "true" : "false";