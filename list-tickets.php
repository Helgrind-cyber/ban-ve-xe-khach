<?php
// bắt đầu sử dụng session
session_start();
require_once "./config/utils.php";
$loggedInUser = isset($_SESSION[AUTH]) ? $_SESSION[AUTH] : null;
$keyword = isset($_GET['keyword']) == true ? $_GET['keyword'] : "";
// lấy dữ liệu từ Routes
$getRoutesQuery = "select * from routes";
$routes = queryExecute($getRoutesQuery, true);
// lấy dữ liệu từ bảng routes: begin_point, end_point; route_schedules: begin/end_time, price; vehicles: seat, plate_number
$getAllDataQuery = "select rs.*,
                            vt.name as type_name,
                            v.seat as seat, v.plate_number as plate_number,
                            r.begin_point as begin, r.end_point as end
                from    vehicle_types vt join vehicles v
                        on vt.id=v.type_id
                        join route_schedules rs
                        on v.id=rs.vehicle_id
                        join routes r on rs.route_id = r.id";
$getAllDataQuery = "select rs.*, vt.name as type_name, vt.seat as seat,
                            v.plate_number as plate_number,
                            r.begin_point as begin, r.end_point as end
                from    vehicle_types vt
                        join vehicles v on vt.id=v.type_id
                        join route_schedules rs on v.id=rs.vehicle_id
                        join routes r on rs.route_id=r.id";
if ($keyword !== "") {
    $getAllDataQuery .= " where vt.name like '%$keyword%'
                            or vt.seat like '%$keyword%'
                            or v.plate_number like '%$keyword%'
                            or r.begin_point like '%$keyword%'
                            or r.end_point like '%$keyword%'
                            or rs.price like '%$keyword%'";
}
$allData = queryExecute($getAllDataQuery, true);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include_once './public/_share/style.php' ?>
    <title>Bán vé xe khách - Danh sách vé</title>
</head>

<body>
    <?php include_once './public/_share/header.php' ?>
    <!--END HEADER - START LIST-->
    <div class="container">
        <div class="row">
            <div class="col-2 side-bar bg-light border">
                <h3 class="h4 text-center text-capitalize border-bottom pt-2 pb-2">Lọc vé</h3>
            </div>
            <div class="col-10 listSearch border">
                <h3 class="h4 text-center text-capitalize border-bottom pt-2 pb-2">Danh sách vé xe</h3>

                <?php foreach ($allData as $data) : ?>
                    <div class="row p-2 border-bottom">
                        <div class="col-3 d-flex align-items-center border-right">
                            <img src="<?php echo PUBLIC_URL . 'images/default-image.jpg' ?>" alt="">
                        </div>
                        <div class="col-7">
                            <h4 class="h5">Xe khách Nam Định - Hà Nội</h4>
                            <ul>
                                <li>Tuyến đường: <span class="font-weight-bold text-primary"><?php echo $data['begin'] . " - " . $data['end'] ?></span></li>
                                <li>Xe: <span class="font-weight-bold text-primary"><?php echo $data['plate_number'] ?></span></li>
                                <li>Loại xe: <span class="font-weight-bold text-primary"><?php echo $data['type_name'] ?></span></li>
                                <li>Số ghế: <span class="font-weight-bold text-primary"><?php echo $data['seat'] ?> ghế</span></li>
                                <li>Thời gian bắt đầu: <span class="font-weight-bold text-primary"><?php echo $data['start_time'] ?></span></li>
                                <li>Thời gian kết thúc: <span class="font-weight-bold text-primary"><?php echo $data['end_time'] ?></span></li>
                                <li>Giá vé: <span class="font-weight-bold text-danger"><?php echo $data['price'] ?> VND</span></li>
                            </ul>
                        </div>
                        <div class="col-2 position-relative">
                            <button type="submit" class="btn btn-outline-primary position-absolute" style="bottom: 20px">Book</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!--END CONTACT - START FOOTER-->
    <?php include_once './public/_share/footer.php' ?>
    <?php include_once './public/_share/script.php' ?>
</body>

</html>