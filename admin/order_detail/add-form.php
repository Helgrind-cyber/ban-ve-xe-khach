<?php
session_start();
require_once '../../config/utils.php';
checkAdminLoggedIn();

$getVehicleTypesQuery = "select * from vehicle_types";
$vehicleTypes = queryExecute($getVehicleTypesQuery, true);

$getUsersQuery = "select * from users";
$users = queryExecute($getUsersQuery, true);

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
                        <h1 class="m-0 text-dark">Thêm phương tiện</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->


                <form id="add-vehicle-form" action="<?= ADMIN_URL . 'vehicles/save-add.php' ?>" method="post"
                      enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Biển số xe<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="plate_number">
                            </div>
                            <div class="form-group">
                                <label for="">Loại xe<span class="text-danger">*</span></label>
                                <select name="vehicletype_id" class="form-control">
                                    <?php foreach ($vehicleTypes as $key => $type): ?>
                                        <option value="<?php echo $type['id'] ?>"><?php echo $type['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Số Ghế Có<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="seat_booked">
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Thêm</button>
                                <a href="<?= ADMIN_URL . 'vehicles' ?>" class="btn btn-danger">Hủy</a>
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
<script>
    $('#add-vehicle-form').validate({
        rules: {
            plate_number: {
                required: true,
                maxlength: 191,
                remote: {
                    url: "<?= ADMIN_URL . 'vehicles/verify-plate-number-vehicle-existed.php'?>",
                    type: "post",
                    data: {
                        name: function () {
                            return $( "input[name='plate_number']" ).val();
                        }
                    }
                }
            },
            manufacture: {
                required: true,
            },
            color: {
                required: true,
            },
            model: {
                required: true,
            },
            owner_id: {
                required: true,
            }
        },
        messages: {
            plate_number: {
                required: "Hãy nhập phương tiện",
                maxlength: "Số lượng ký tự tối đa bằng 191 ký tự",
                remote: "Phương tiện đã tồn tại."
            },
            manufacture: {
                required: "Hãy nhập hãng xe",
            },
            color: {
                required: "Hãy nhập màu sắc",
            },
            model: {
                required: "Hãy nhập model",
            },
            owner_id: {
                required: "Hãy nhập id người dùng",
            },
        }
    });
</script>
</body>
