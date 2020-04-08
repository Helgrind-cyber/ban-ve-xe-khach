<?php
session_start();
require_once '../../config/utils.php';
checkAdminLoggedIn();
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
                            <h1 class="m-0 text-dark">Thêm quãng đường</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <form id="add-route-form" action="<?= ADMIN_URL . 'routes/save-add.php' ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Khoảng cách<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="distance" id="distance">
                                    <?php if (isset($_GET['distanceerr'])) : ?>
                                        <label class="error"><?= $_GET['distanceerr'] ?></label>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Thời gian dự kiến<span class="text-danger">*</span></label>
                                    <input type="datetime" class="form-control" name="estimate_time" id="estimate_time">
                                    <?php if (isset($_GET['estimate_timeerr'])) : ?>
                                        <label class="error"><?= $_GET['estimate_timeerr'] ?></label>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Điểm đầu<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="begin_point" id="begin_point">
                                    <?php if (isset($_GET['begin_pointerr'])) : ?>
                                        <label class="error"><?= $_GET['begin_pointerr'] ?></label>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Điểm cuối<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="end_point" id="end_point">
                                    <?php if (isset($_GET['end_pointerr'])) : ?>
                                        <label class="error"><?= $_GET['end_pointerr'] ?></label>
                                    <?php endif; ?>
                                    <?php if (isset($_GET['routeerr'])) : ?>
                                        <label class="error"><?= $_GET['routeerr'] ?></label>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Thêm</button>&nbsp;
                            <a href="<?= ADMIN_URL . 'routes' ?>" class="btn btn-danger" id="btnRemove">Hủy</a>
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
        // session storage
        // get data
        var distance = document.getElementById('distance');
        if (sessionStorage.getItem('distance')) {
            distance.value = sessionStorage.getItem('distance');
        } else {
            distance.value = "";
        }

        var estimate_time = document.getElementById('estimate_time');
        estimate_time.value = sessionStorage.getItem('estimate_time');

        var begin_point = document.getElementById('begin_point');
        begin_point.value = sessionStorage.getItem('begin_point');

        var end_point = document.getElementById('end_point');
        end_point.value = sessionStorage.getItem('end_point');

        distance.addEventListener('change', function() {
            sessionStorage.setItem('distance', distance.value);
        });

        estimate_time.addEventListener('change', function() {
            sessionStorage.setItem('estimate_time', estimate_time.value);
        });

        begin_point.addEventListener('change', function() {
            sessionStorage.setItem('begin_point', begin_point.value);
        });

        end_point.addEventListener('change', function() {
            sessionStorage.setItem('end_point', end_point.value);
        });
        var btnRemove = document.getElementById('btnRemove');
        btnRemove.addEventListener('click', function() {
            sessionStorage.clear();
        });

        $('#add-route-form').validate({
            rules: {
                distance: {
                    number: true,
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
                    number: "Hãy nhập khoảng cách quãng đường là số",
                    min: "Khoảng cách tối thiểu là 100km",
                    max: "Khoảng cách tối đa là 200km"
                },
                estimate_time: "Nhập đúng định dạng thời gian example: 01:01"
            }
        });
    </script>
</body>