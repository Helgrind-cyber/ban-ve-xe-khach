<?php
require_once ".config/utils.php";

function loginUser($email, $password){
	$sql = "select * from users where email = '$email'";
	$conn = getdbConn();
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$user = $stmt->fetch();
	if(!$user){
		return false;
	}

	if(password_verify($password, $user['password'])){
		return $user;
	}
}


 ?>