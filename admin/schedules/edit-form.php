<?php
session_start();
require_once '../../config/utils.php';
checkAdminLoggedIn();
// lấy dữ liệu từ routes
$getRoutesQuery = "select * from routes";
$routes = queryExecute($getRoutesQuery, true);
// lấy dữ liệu từ vehicles
$getVehiclesQuery = "select * from vehicles";
$vehicles = queryExecute($getVehiclesQuery, true);
// lấy id ra ngoài thông url
$id = isset($_GET['id']) ? $_GET['id'] : -1;
// kiem tra su ton tai cua lich trinh
$getSchedulesByIdQuery = "select * from route_schedules where id = '$id'";
$schedules = queryExecute($getSchedulesByIdQuery, false);
if (!$schedules) {
    header("location: " . ADMIN_URL . 'schedules?msg=Lịch trình không tồn tại');
    die;
}
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
                            <h1 class="m-0 text-dark">Cập nhật thông tin lịch trình</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <form id="edit-schedules-form" action="<?= ADMIN_URL . 'schedules/save-edit.php' ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $schedules['id'] ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Tuyến đường<span class="text-danger">*</span></label>
                                    <select name="route_id" class="form-control">
                                        <option value="">Select ...</option>
                                        <?php foreach ($routes as $route) : ?>
                                            <option value="<?php echo $route['id'] ?>">
                                                <?php echo $route['begin_point'] . "  -  " . $route['end_point'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Biển số xe<span class="text-danger">*</span></label>
                                    <select name="vehicle_id" class="form-control">
                                        <option value="">Select ...</option>
                                        <?php foreach ($vehicles as $vehicle) : ?>
                                            <option value="<?php echo $vehicle['id'] ?>">
                                                <?php echo $vehicle['plate_number'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Giá tiền<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="price" value="<?php echo $schedules['price'] ?>">
                                    <?php if (isset($_GET['priceerr'])) : ?>
                                        <label class="error"><?= $_GET['priceerr'] ?></label>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- ------------ date picker ------------ -->
                                <div class="form-group">
                                    <label for="" class="text-capitalize font-weight-bold">Thời gian bắt đầu<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1" name="start_time" value=" <?php echo $schedules['start_time'] ?>" />
                                            <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        $(function() {
                                            $('#datetimepicker1').datetimepicker();
                                        });
                                    </script>
                                </div>
                                <div class="form-group">
                                    <label for="" class="text-capitalize font-weight-bold">Thời gian kết thúc<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker2" name="end_time" value=" <?php echo $schedules['end_time'] ?>" />
                                            <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        $(function() {
                                            $('#datetimepicker2').datetimepicker();
                                        });
                                    </script>
                                </div>
                                <div class="col d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>&nbsp;
                                    <a href="<?= ADMIN_URL . 'schedules' ?>" class="btn btn-danger">Hủy</a>
                                </div>
                            </div>
                        </div>
                    </form>

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
    <!-- moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <!-- bootstrap datepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#edit-schedules-form').validate({
                rules: {
                    route_id: {
                        required: true
                    },
                    vehicle_id: {
                        required: true
                    },
                    price: {
                        required: true,
                        number: true,
                        min: 0,
                        max: 500000
                    },
                    start_time: {
                        required: true,
                    },
                    end_time: {
                        required: true,
                    }
                },
                messages: {
                    route_id: {
                        required: "Hãy chọn quãng đường cho lịch trình này"
                    },
                    vehicle_id: {
                        required: "Hãy chọn xe cho lịch trình này"
                    },
                    price: {
                        required: "Nhập giá tiền",
                        number: "Chỉ nhập giá tiền bằng số",
                        min: "Giá tiền tối thiểu là 0 VND",
                        max: "Giá tiền tối đa là 500,000 VND"
                    },
                    start_time: {
                        required: "hãy nhập thời gian bắt đầu"
                    },
                    end_time: {
                        required: "hãy nhập thời gian kết thúc"
                    }
                }
            });
        })
    </script>
</body>

</html>