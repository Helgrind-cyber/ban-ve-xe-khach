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
                    <form id="edit-vehicle-form" action="<?= ADMIN_URL . 'routes/save-edit.php' ?>" method="post" enctype="multipart/form-data">
                        <input name="id" value="<?php echo $routesEdit['id'] ?>" hidden>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Khoảng cách<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="distance" value="<?= $routesEdit['distance'] . ' KM' ?>">
                                    <?php if (isset($_GET['distanceerr'])) : ?>
                                        <label class="error"><?= $_GET['distanceerr'] ?></label>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Thời gian dự kiến<span class="text-danger">*</span></label>
                                    <input type="datetime" class="form-control" name="estimate_time" id="estimate_time" value="<?= $routesEdit['estimate_time'] . ' giờ' ?>">
                                    <?php if (isset($_GET['estimate_timeerr'])) : ?>
                                        <label class="error"><?= $_GET['estimate_timeerr'] ?></label>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Điểm đầu<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="begin_point" value="<?= $routesEdit['begin_point'] ?>">
                                    <?php if (isset($_GET['begin_pointerr'])) : ?>
                                        <label class="error"><?= $_GET['begin_pointerr'] ?></label>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Điểm cuối<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="end_point" value="<?= $routesEdit['end_point'] ?>">
                                    <?php if (isset($_GET['end_pointerr'])) : ?>
                                        <label class="error"><?= $_GET['end_pointerr'] ?></label>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Thêm</button>&nbsp;
                            <a href="<?= ADMIN_URL . 'routes' ?>" class="btn btn-danger">Hủy</a>
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
        $(document).ready(function() {
            $('#add-route-form').validate({
                rules: {
                    distance: {
                        required: true,
                        min: 100,
                        max: 200
                    },
                    begin_point: {
                        required: true,
                        maxlength: 191,
                        remote: {
                            url: "<?= ADMIN_URL . 'routes/verify-begin-point-existed.php' ?>",
                            type: "post",
                            data: {
                                name: function() {
                                    return $("input[name='begin_point']").val();
                                }
                            }
                        }
                    },
                    end_point: {
                        required: true,
                        maxlength: 191,
                        remote: {
                            url: "<?= ADMIN_URL . 'routes/verify-end-point-existed.php' ?>",
                            type: "post",
                            data: {
                                name: function() {
                                    return $("input[name='end_point']").val();
                                }
                            }
                        }
                    },
                    estimate_time: "required time"
                },
                messages: {
                    begin_point: {
                        required: "Hãy nhập địa điểm",
                        maxlength: "Số lượng ký tự tối đa bằng 191 ký tự",
                        remote: "Điểm đầu đã tồn tại."
                    },
                    end_point: {
                        required: "Hãy nhập địa điểm",
                        maxlength: "Số lượng ký tự tối đa bằng 191 ký tự",
                        remote: "Điểm cuối đã tồn tại."
                    },
                    distance: {
                        require: "Hãy nhập khoảng cách quãng đường",
                        min: "Khoảng cách tối thiểu là 100km",
                        max: "Khoảng cách tối đa là 200km"
                    },
                    estimate_time: "Nhập đúng định dạng thời gian example: 01:01"
                }
            });
        });
    </script>
</body>