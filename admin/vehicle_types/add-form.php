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
                        <h1 class="m-0 text-dark">Thêm loại phương tiện</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->


                    <form id="add-vehicle-type-form" action="<?= ADMIN_URL . 'vehicle_types/save-add.php'?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Loại xe<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="">Trạng thái<span class="text-danger">*</span></label>
                                    <select name="status" class="form-control">
                                        <option value="<?= ACTIVE?>">Có hiệu lực</option>
                                        <option value="<?= INACTIVE?>">Không có hiệu lực</option>
                                    </select>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Tạo</button>&nbsp;
                                    <a href="<?= ADMIN_URL . 'vehicle_types'?>" class="btn btn-danger">Hủy</a>
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
    $('#add-vehicle-type-form').validate({
        rules:{
            name: {
                required: true,
                maxlength: 191,
                remote: {
                    url: "<?= ADMIN_URL . 'vehicle_types/verify-name-type-existed.php'?>",
                    type: "post",
                    data: {
                        name: function() {
                            return $( "input[name='name']" ).val();
                        }
                    }
                }
            },

        },
        messages: {
            name: {
                required: "Hãy nhập loại phương tiện",
                maxlength: "Số lượng ký tự tối đa bằng 191 ký tự",
                remote: "Loại phương tiện đã tồn tại."
            },
        }
    });
</script>
</body>
