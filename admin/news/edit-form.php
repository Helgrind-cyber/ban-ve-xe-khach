<?php
session_start();
require_once '../../config/utils.php';
checkAdminLoggedIn();
$getRoleQuery = "select * from roles where status = 1";
$roles = queryExecute($getRoleQuery, true);

$id = isset($_GET['id']) ? $_GET['id'] : -1;

$getNewsQuery = "select * from news where id = $id";
$news = queryExecute($getNewsQuery, false);

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
                            <h1 class="m-0 text-dark">Cập nhật bản tin</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <form id="edit-user-form" action="<?= ADMIN_URL . 'news/save-edit.php' ?>" method="post" enctype="multipart/form-data">
                        <input type="text" name="id" value="<?= $news['id'] ?>" hidden>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Tên bản tin<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" value="<?= $news['title'] ?>">

                                </div>
                                <div class="form-group">
                                    <label for="">Thông tin<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="content" value="<?= $news['content'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6 offset-md-3">
                                        <img src="<?= DEFAULT_IMAGE ?>" width="200" id="preview-img" alt=""><br>
                                        <input type="file" class="form-control" name="image" onchange="encodeImageFileAsURL(this)">
                                    </div>
                                </div>
                                <div class="col d-flex justify-content-center p-4">
                                    <button type="submit" class="btn btn-primary">Tạo</button>&nbsp;
                                    <a href="<?= ADMIN_URL . 'news' ?>" class="btn btn-danger">Hủy</a>
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
    <script>
        function encodeImageFileAsURL(element) {
            var file = element.files[0];
            if (file === undefined) {
                $('#preview-img').attr('src', "<?= DEFAULT_IMAGE ?>");
                return false;
            }
            var reader = new FileReader();
            reader.onloadend = function() {
                $('#preview-img').attr('src', reader.result)
            }
            reader.readAsDataURL(file);
        }
        $('#edit-user-form').validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 191
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
                phone_number: {
                    number: true
                },
                house_no: {
                    maxlength: 191
                },
                avatar: {
                    extension: "png|jpg|jpeg|gif"
                }
            },
            messages: {
                name: {
                    required: "Hãy nhập tên người dùng",
                    maxlength: "Số lượng ký tự tối đa bằng 191 ký tự"
                },
                email: {
                    required: "Hãy nhập email",
                    maxlength: "Số lượng ký tự tối đa bằng 191 ký tự",
                    email: "Không đúng định dạng email",
                    remote: "Email đã tồn tại, vui lòng sử dụng email khác"
                },
                phone_number: {
                    min: "Bắt buộc là số có 10 chữ số",
                    max: "Bắt buộc là số có 10 chữ số",
                    number: "Nhập định dạng số"
                },
                house_no: {
                    maxlength: "Số lượng ký tự tối đa bằng 191 ký tự"
                },
                avatar: {
                    extension: "Hãy nhập đúng định dạng ảnh (jpg | jpeg | png | gif)"
                }
            }
        });
    </script>
</body>

</html>