<?php
session_start();
require_once '../../config/utils.php';
checkAdminLoggedIn();

$keyword = isset($_GET['keyword']) == true ? $_GET['keyword'] : "";
$vtId = isset($_GET['vehicleTypes']) == true ? $_GET['vehicleTypes'] : false;

// danh sách vehicle types
$getVehicleTypesQuery = "select * from vehicle_types";
$vehicleTypes = queryExecute($getVehicleTypesQuery, true);

// danh sách vehicles
$getVehiclesQuery = "select
                    v.*,
                    vt.name as type_name
                    from vehicles v
                    join vehicle_types vt
                    on v.type_id = vt.id";
if ($keyword !== "") {
    $getVehiclesQuery .= " where (v.seat_booked like '%$keyword%'
                                or v.plate_number like '%$keyword%')";
    if ($vtId !== false && $vtId !== "") {
        $getVehiclesQuery .= " and v.vehicletype_id = $vtId";
    }
} else {
    if ($vtId !== false && $vtId !== "") {
        $getVehiclesQuery .= " and v.vehicletype_id = $vtId";
    }
}
$vehicles = queryExecute($getVehiclesQuery, true);
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
                        <h1 class="m-0 text-dark">Quản trị phương tiện</h1>
                    </div><!-- /.col -->
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
                                    <input type="text" value="<?php echo $keyword?>" class="form-control" name="keyword" placeholder="Nhập biển số, số ghế">
                                </div>
                                <div class="form-group col-4">
                                    <select name="vehicleTypes" class="form-control" >
                                        <option selected value="">Tất cả</option>
                                        <?php foreach($vehicleTypes as $vt): ?>
                                            <option
                                                <?php if($vtId === $vt['id'] ) {echo "selected";} ?>
                                                    value="<?php echo $vt['id'] ?>"><?php echo $vt['name'] ?></option>
                                        <?php endforeach;?>
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
                        <th>Biển số xe</th>
                        <th>Loại xe</th>
                        <th>
                            <a href="<?php echo ADMIN_URL . 'vehicles/add-form.php' ?>" class="btn btn-primary btn-sm"><i
                                    class="fa fa-plus"></i> Thêm</a>
                        </th>
                        </thead>
                        <tbody>
                        <?php foreach ($vehicles as $vehicle): ?>
                            <tr>
                                <td><?php echo $vehicle['id'] ?></td>
                                <td><?php echo $vehicle['plate_number'] ?></td>
                                <td><?php echo $vehicle['type_name'] ?></td>
                                <td>
                                    <a href="<?php echo ADMIN_URL . 'vehicles/edit-form.php?id=' . $vehicle['id'] ?>"
                                       class="btn btn-sm btn-info">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a href="<?php echo ADMIN_URL . 'vehicles/remove.php?id=' . $vehicle['id'] ?>"
                                       class="btn-remove btn btn-sm btn-danger">
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
    $(document).ready(function(){
        $('.btn-remove').on('click', function () {
            var redirectUrl = $(this).attr('href');
            Swal.fire({
                title: 'Thông báo!',
                text: "Bạn có chắc chắn muốn xóa phương tiện này?",
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
        <?php if(isset($_GET['msg'])):?>
        Swal.fire({
            position: 'bottom-center',
            icon: 'warning',
            title: "<?= $_GET['msg'];?>",
            showConfirmButton: false,
            timer: 1500
        });
        <?php endif;?>
    });
</script>
</body>
</html>