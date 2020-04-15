<?php
session_start();
require_once '../../config/utils.php';
checkAdminLoggedIn();
$getRoleQuery = "select * from roles";
$roles = queryExecute($getRoleQuery, true);

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
                            <h1 class="m-0 text-dark">Tạo tài khoản</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <form id="add-user-form" action="<?= ADMIN_URL . 'users/save-add.php' ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Tên người dùng<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name">
                                    <?php if (isset($_GET['nameerr'])) : ?>
                                        <label class="error"><?= $_GET['nameerr'] ?></label>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Email<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="email" id="email">
                                    <?php if (isset($_GET['emailerr'])) : ?>
                                        <label class="error"><?= $_GET['emailerr'] ?></label>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Quyền</label>
                                    <select name="role_id" class="form-control" id="role_id">
                                        <?php foreach ($roles as $ro) : ?>
                                            <option value="<?= $ro['id'] ?>"><?= $ro['name'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Mật khẩu<span class="text-danger">*</span></label>
                                    <input type="password" id="main-password" class="form-control" name="password">
                                    <?php if (isset($_GET['passworderr'])) : ?>
                                        <label class="error"><?= $_GET['passworderr'] ?></label>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Nhập lại mật khẩu<span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="cfpassword">
                                </div>
                                <div class="form-group">
                                    <label for="">Số điện thoại</label>
                                    <input type="text" class="form-control" name="phone_number" id="phone_number">
                                    <?php if (isset($_GET['phone_numbererr'])) : ?>
                                        <label class="error"><?= $_GET['phone_numbererr'] ?></label>
                                    <?php endif; ?>
                                </div>
                                <div class="col d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Tạo</button>&nbsp;
                                    <a href="<?= ADMIN_URL . 'users' ?>" class="btn btn-danger" id="btnRemove">Hủy</a>
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
    <script type="text/javascript">
        $(document).ready(function() {
            // session storage
            // get data
            var name = document.getElementById('name');
            name.value = sessionStorage.getItem('name');

            var email = document.getElementById('email');
            email.value = sessionStorage.getItem('email');

            var phone_number = document.getElementById('phone_number');
            phone_number.value = sessionStorage.getItem('phone_number');

            name.addEventListener('change', function() {
                sessionStorage.setItem('name', name.value);
            });
            email.addEventListener('change', function() {
                sessionStorage.setItem('email', email.value);
            });
            phone_number.addEventListener('change', function() {
                sessionStorage.setItem('phone_number', phone_number.value);
            });

            var btnRemove = document.getElementById('btnRemove');
            btnRemove.addEventListener('click', function() {
                sessionStorage.clear();
            });

            $('#add-user-form').validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 191,
                        minlength: 2
                    },
                    email: {
                        required: true,
                        maxlength: 191,
                        email: true,
                        remote: {
                            url: "<?= ADMIN_URL . 'users/verify-email-existed.php' ?>",
                            type: "post",
                            data: {
                                email: function() {
                                    return $("input[name='email']").val();
                                }
                            }
                        }
                    },
                    password: {
                        required: true,
                        maxlength: 191
                    },
                    cfpassword: {
                        required: true,
                        equalTo: "#main-password"
                    },
                    phone_number: {
                        required: true,
                        number: true,
                        minlength: 10,
                        maxlength: 10
                    }
                },
                messages: {
                    name: {
                        required: "Hãy nhập tên người dùng",
                        maxlength: "Số lượng ký tự tối đa bằng 191 ký tự",
                        minlength: "Nhập tối thiểu 2 kí tự"
                    },
                    email: {
                        required: "Hãy nhập email",
                        maxlength: "Số lượng ký tự tối đa bằng 191 ký tự",
                        email: "Không đúng định dạng email",
                        remote: "Email đã tồn tại, vui lòng sử dụng email khác"
                    },
                    password: {
                        required: "Hãy nhập mật khẩu",
                        maxlength: "Số lượng ký tự tối đa bằng 191 ký tự"
                    },
                    cfpassword: {
                        required: "Nhập lại mật khẩu",
                        equalTo: "Cần khớp với mật khẩu"
                    },
                    phone_number: {
                        required: "Nhập vào số điện thoại",
                        number: "Nhập định dạng số",
                        minlength: "Số điện thoại gồm 10 chữ số",
                        maxlength: "Số điện thoại gồm 10 chữ số"
                    }
                }
            });
        });
    </script>
</body>

</html>