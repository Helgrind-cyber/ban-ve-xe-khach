<?php
session_start();
require_once '../../config/utils.php';
checkAdminLoggedIn();

$id = isset($_GET['id']) ? $_GET['id'] : -1;
$getVehicleTypeEditQuery = "select * from vehicle_types where id = '$id'";
$vehicleTypeEdit = queryExecute($getVehicleTypeEditQuery, false);

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
                        <h1 class="m-0 text-dark">Sửa loại phương tiện</h1>
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->

                    <form id="edit-vehicle-type-form" action="<?= ADMIN_URL . 'vehicle_types/save-edit.php' ?>" method="post"
                          enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $vehicleTypeEdit['id'] ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Loại xe<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name"
                                           value="<?php echo $vehicleTypeEdit['name'] ?>">
                                    <!--                        --><?php //if(isset($_GET['nameerr'])):?>
                                    <!--                            <label class="error">--><? //= $_GET['nameerr']?><!--</label>-->
                                    <!--                        --><?php //endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Trạng thái</label>
                                    <select name="status" class="form-control">
                                        <option value="0"
                                            <?php if ($vehicleTypeEdit['status'] == 0) : ?>
                                                selected
                                            <?php endif ?>
                                        >Có hiệu lực
                                        </option>
                                        <option value="1"
                                            <?php if ($vehicleTypeEdit['status'] == 1) : ?>
                                                selected
                                            <?php endif ?>
                                        >Không có hiệu lực
                                        </option>
                                    </select>
                                    <!--                        --><?php //if(isset($_GET['emailerr'])):?>
                                    <!--                            <label class="error">-->
                                    <? //= $_GET['emailerr']?><!--</label>-->
                                    <!--                        --><?php //endif; ?>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Sửa</button>&nbsp;
                                    <a href="<?= ADMIN_URL . 'vehicle_types' ?>" class="btn btn-danger">Hủy</a>
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
    $('#edit-vehicle-type-form').validate({
        rules: {
            name: {
                required: true,
                maxlength: 191
            },
        },
        messages: {
            name: {
                required: "Hãy nhập loại phương tiện",
                maxlength: "Số lượng ký tự tối đa bằng 191 ký tự"
            },
        }
    });
</script>
</body>
</html>