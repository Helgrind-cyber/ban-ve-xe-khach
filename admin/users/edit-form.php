<?php
session_start();
require_once '../../config/utils.php';
checkAdminLoggedIn();
$getRoleQuery = "select * from roles";
$roles = queryExecute($getRoleQuery, true);

// lấy thông tin của người dùng ra ngoài thông id trên đường dẫn
$id = isset($_GET['id']) ? $_GET['id'] : -1;
// kiểm tra tài khoản có tồn tại hay không
$getUserByIdQuery = "select * from users where id = $id";
$user = queryExecute($getUserByIdQuery, false);
if (!$user) {
    header("location: " . ADMIN_URL . 'users?msg=Tài khoản không tồn tại');
    die;
}

// kiểm tra xem có quyền để thực hiện edit hay không
if ($user['id'] != $_SESSION[AUTH]['id'] && $user['role_id'] >= $_SESSION[AUTH]['role_id']) {
    header("location: " . ADMIN_URL . 'users?msg=Bạn không có quyền sửa thông tin tài khoản này');
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
                            <h1 class="m-0 text-dark">Cập nhật thông tin tài khoản</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <form id="edit-user-form" action="<?= ADMIN_URL . 'users/save-edit.php' ?>" method="post" enctype="multipart/form-data">
                        <input type="text" name="id" value="<?= $user['id'] ?>" hidden>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Tên người dùng<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" value="<?= $user['name'] ?>">
                                    <?php if (isset($_GET['nameerr'])) : ?>
                                        <label class="error"><?= $_GET['nameerr'] ?></label>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Email<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="email" value="<?= $user['email'] ?>">
                                    <?php if (isset($_GET['emailerr'])) : ?>
                                        <label class="error"><?= $_GET['emailerr'] ?></label>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Quyền</label>
                                    <select name="role_id" class="form-control">
                                        <?php foreach ($roles as $ro) : ?>
                                            <option value="<?= $ro['id'] ?>" <?php if ($ro['id'] == $user['role_id']) : ?> selected <?php endif ?>>
                                                <?= $ro['name'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Số điện thoại</label>
                                    <input type="text" class="form-control" name="phone_number" value="<?= $user['phone_number'] ?>">
                                    <?php if (isset($_GET['phone_numbererr'])) : ?>
                                        <label class="error"><?= $_GET['phone_numbererr'] ?></label>
                                    <?php endif; ?>
                                </div>
                                <div class="col d-flex justify-content-center p-4">
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>&nbsp;
                                    <a href="<?= ADMIN_URL . 'users' ?>" class="btn btn-danger">Hủy</a>
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
        $('#edit-user-form').validate({
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
                            },
                            id: <?= $user['id']; ?>
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
                    maxlength: 10,
                    minlength: 10
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
                    required: "Nhập số điện thoại vào đây",
                    minlength: "Bắt buộc là số có 10 chữ số",
                    maxlength: "Bắt buộc là số có 10 chữ số",
                    number: "Nhập định dạng số"
                }
            }
        });
    </script>
</body>

</html>