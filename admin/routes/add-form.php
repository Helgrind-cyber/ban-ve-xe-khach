<?php
session_start();
require_once '../../config/utils.php';
checkAdminLoggedIn();

// danh sách routes
$getRoutesQuery = "select * from routes";
$routes = queryExecute($getRoutesQuery, true);
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


                <form id="add-route-form" action="<?= ADMIN_URL . 'routes/save-add.php' ?>" method="post"
                      enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Khoảng cách<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="distance">
                            </div>
                            <div class="form-group">
                                <label for="">Thời gian dự kiến<span class="text-danger">*</span></label>
                                <input type="datetime" class="form-control" name="estimate_time">
                            </div>
                            <div class="form-group">
                                <label for="">Điểm đầu<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="begin_point">
                            </div>
                            <div class="form-group">
                                <label for="">Điểm cuối<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="end_point">
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Thêm</button>
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
<!-- <script>
    $('#add-route-form').validate({
        rules: {
            distance: {
                required: true,
                maxlength: 191,
                remote: {
                    url: "<?= ADMIN_URL . 'routes/verify-plate-number-vehicle-existed.php'?>",
                    type: "post",
                    data: {
                        name: function () {
                            return $( "input[name='distance']" ).val();
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
</script> -->
</body>
