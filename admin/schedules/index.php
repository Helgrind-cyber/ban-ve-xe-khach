<?php
session_start();
require_once '../../config/utils.php';
checkAdminLoggedIn();

$keyword = isset($_GET['keyword']) == true ? $_GET['keyword'] : "";
$routeId = isset($_GET['route']) == true ? $_GET['route'] : false;

// get query from schedules
$getSchedulesQuery = "select rs.*, r.begin_point as begin, r.end_point as end, v.plate_number as plate_number
                                from vehicles v join route_schedules rs on v.id=rs.vehicle_id
                                join routes r
                                on rs.route_id = r.id";

// get query from vehicles
$getVehiclesQuery = "select * from vehicles";
$vehicles = queryExecute($getVehiclesQuery, true);

// get query from routes
$getRoutesQuery = "select * from routes";
$routes = queryExecute($getRoutesQuery, true);

// tìm kiếm
if ($keyword !== "") {
    $getSchedulesQuery .= " where (rs.route_id like '%$keyword%'
                            or rs.vehicle_id like '%$keyword%'
                            or rs.price like '%$keyword%'
                            or rs.start_time like '%$keyword%'
                            or rs.end_time like '%$keyword%')
                      ";
    if ($routeId !== false && $routeId !== "") {
        $getRoutesQuery .= " and rs.route_id = $routeId";
    }
}else{
    if ($routeId !== false && $routeId !== "") {
        $getRoutesQuery .= " and rs.route_id = $routeId";
    }
}
$schedules = queryExecute($getSchedulesQuery, true);

?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once '../_share/style.php'; ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include_once '../_share/header.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include_once '../_share/sidebar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Quản trị lịch trình</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= ADMIN_URL . 'dashboard' ?>">Dashboard</a></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-md-10 col-offset-1">
                            <!-- Filter  -->
                            <form action="" method="get">
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <input type="text" value="<?php echo $keyword ?>" class="form-control" name="keyword" placeholder="Nhập lịch trình, thời gian, giá vé...">
                                    </div>
                                    <div class="form-group col-4">
                                        <select name="route" class="form-control">
                                            <option selected value="">Tuyến đường</option>
                                            <?php foreach ($routes as $route) : ?>
                                                <option <?php if ($routeId === $route['id']) {
                                                            echo "selected";
                                                        } ?> value="<?php echo $route['id'] ?>"><?php echo $route['begin_point'] . "  -  " . $route['end_point'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-2">
                                        <button type="submit" class="btn btn-success">Tìm kiếm</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Danh sách users  -->
                        <table class="table table-stripped">
                            <thead>
                                <th>ID</th>
                                <th>Tuyến đường</th>
                                <th>Xe</th>
                                <th>Giá tiền</th>
                                <th>Thời gian bắt đầu</th>
                                <th>Thời gian kết thúc</th>
                                <th>
                                    <a href="<?php echo ADMIN_URL . 'schedules/add-form.php' ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Thêm</a>
                                </th>
                            </thead>
                            <tbody>
                                <?php foreach ($schedules as $schedule) : ?>
                                    <tr>
                                        <td><?php echo $schedule['id'] ?></td>
                                        <td><?php echo $schedule['begin']."  -  ".$schedule['end'] ?></td>
                                        <td><?php echo $schedule['plate_number'] ?></td>
                                        <td>
                                            <?php echo $schedule['price'] ?><span class="font-weight-bold"> VND</span>
                                        </td>
                                        <td><?php echo $schedule['start_time'] ?></td>
                                        <td><?php echo $schedule['end_time'] ?></td>
                                        <td>
                                            <a href="<?php echo ADMIN_URL . 'schedules/edit-form.php?id=' . $schedule['id'] ?>" class="btn btn-sm btn-info">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a href="<?php echo ADMIN_URL . 'schedules/remove.php?id=' . $schedule['id'] ?>" class="btn-remove btn btn-sm btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.row -->

                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include_once '../_share/footer.php'; ?>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <?php include_once '../_share/script.php'; ?>
    <script>
        $(document).ready(function() {
            $('.btn-remove').on('click', function() {
                var redirectUrl = $(this).attr('href');
                Swal.fire({
                    title: 'Thông báo!',
                    text: "Bạn có chắc chắn muốn xóa lịch trình này?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đồng ý'
                }).then((result) => { // arrow function es6 (es2015)
                    if (result.value) {
                        window.location.href = redirectUrl;
                    }
                });
                return false;
            });
            <?php if (isset($_GET['msg'])) : ?>
                Swal.fire({
                    position: 'bottom-end',
                    icon: 'warning',
                    title: "<?= $_GET['msg']; ?>",
                    showConfirmButton: false,
                    timer: 1500
                });
            <?php endif; ?>
        });
    </script>
</body>

</html>