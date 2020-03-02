<?php
session_start();
require_once '../../config/utils.php';
checkAdminLoggedIn();

$id = isset($_GET['id']) ? $_GET['id'] : -1;
$getRoutesEditQuery = "select * from routes where id = '$id'";
$routesEdit = queryExecute($getRoutesEditQuery, false);

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
                        <h1 class="m-0 text-dark">Sửa phương tiện</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->


                <form id="edit-vehicle-form" action="<?= ADMIN_URL . 'routes/save-edit.php' ?>" method="post"
                      enctype="multipart/form-data">
                    <div class="row">
                        <input  name="id" value="<?php echo $routesEdit['id'] ?>" hidden>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Khoảng cách<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="distance" value="<?php echo $routesEdit['distance'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Thời gian dự kiến<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="estimate_time" value="<?php echo $routesEdit['estimate_time'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Điểm xuất phát<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="begin_point" value="<?php echo $routesEdit['begin_point'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Điểm cuối<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="end_point" value="<?php echo $routesEdit['end_point'] ?>">
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Sửa</button>
                                <a href="<?= ADMIN_URL . 'routes' ?>" class="btn btn-danger">Hủy</a>
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
    $('#edit-vehicle-form').validate({
        rules: {
            distance: {
                required: trudistancee,
                maxlength: 191,
                remote: {
                    url: "<?= ADMIN_URL . 'routes/verify-plate-number-vehicle-existed.php'?>",
                    type: "post",
                    data: {
                        name: function () {
                            return $( "input[name='plate_number']" ).val();
                        },
                        id: <?= $routesEdit['id']; ?>
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
