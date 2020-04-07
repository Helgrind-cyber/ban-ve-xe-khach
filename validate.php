<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Học PHP - Regular Expression: Viết biểu thức Reg kiểm tra Số điện thoại hợp lệ</title>
</head>
<body>
<?php
if($_POST){
$string = $_POST['phone'];
$pattern = '#^?[\d]3?-?[\d]2?-[\d]{2}\.[\d]{3}-[\d]{3}$#';
if(preg_match($pattern, $string, $match) == 1){
$report = '<span style=\'color:#298426\'>Bạn vừa nhập vào số điện thoại hợp lệ!</span>';
}
else{
$report = '<span style=\'color:#FF0400\'>Bạn vừa nhập vào số điện thoại không hợp lệ!</span>';
}
}
?>
<fieldset>
<legend><b>Đăng ký tài khoản</b></legend>
<form method="post">
Nhập số điện thoại hợp lệ: <?php if(isset($report)){echo $report;}?><br />
<input type="text" name="phone" />
<input type="submit" name="submit_name" value="Đăng ký" />
</form>
</fieldset>
</body>
</html>