<?php
session_start();
include_once "../../config/utils.php";
checkAdminLoggedIn();
$plate_number = trim($_POST['plate_number']);
$type_id = trim($_POST['type_id']);
$image = $_FILES['avatar'];

// validate bằng php
$plate_numbererr = "";
if(strlen($plate_number) == 0){
    $plate_numbererr = "Yêu cầu nhập biển số xe";
}
// check plate_number đã tồn tại hay chưa
$checkPlateQuery = "select * from vehicles where plate_number = '$plate_number'";
$plates = queryExecute($checkPlateQuery, true);
if(count($plates) > 0){
    $plate_numbererr = "Biển số đã tồn tại, vui lòng sử dụng biển số khác";
}

if($plate_numbererr != "" ){
    header('location: ' . ADMIN_URL . "vehicles/add-form.php?plate_numbererr=$plate_numbererr");
    die;
}

// upload file ảnh
$filename = "";
if ($image['size'] > 0) {
    $filename = uniqid() . '-' . $image['name'];
    move_uploaded_file($image['tmp_name'], "../../public/images/" . $filename);
    $filename = "public/images/" . $filename;
}

$insertVehicleQuery = "insert into vehicles
                          (type_id, plate_number, avatar)
                    values
                          ('$type_id ', '$plate_number', '$filename')";
queryExecute($insertVehicleQuery, false);
header("location: " . ADMIN_URL . "vehicles?msg=Thêm phương tiện thành công");
die;
?>