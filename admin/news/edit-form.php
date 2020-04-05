<?php
session_start();
require_once '../../config/utils.php';

checkAdminLoggedIn();

$id = isset($_GET['id']) ? $_GET['id'] : -1;

$getNewsQuery = "select * from news where id = '$id'";
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
                            <h1 class="m-0 text-dark">Sửa tin tức</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <form id="add-user-form" action="<?= ADMIN_URL . 'news/save-edit.php' ?>" method="post"
                        enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" hidden>
                                    <input type="text" class="form-control" name="id" value="<?= $news['id'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Tên bảng tin<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" value="<?= $news['title'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Nội dung<span class="text-danger">*</span></label>
<<<<<<< HEAD
                                    <input type="text" class="form-control" name="content" value="<?= $news['content'] ?>">
=======
                                    <input type="text" class="form-control" name="content"
                                        value="<?= $news['content'] ?>">
>>>>>>> quannh
                                </div>

                            </div>
                            <div class="col-md-6">
<<<<<<< HEAD
                                <div class="form-group">
                                    <img src="<?= BASE_URL . $news['image'] ?>" width="200" id="preview-img" alt="">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile01" name="image" onchange="encodeImageFileAsURL(this)">
                                        <label class="custom-file-label" for="inputGroupFile01">Ảnh<span class="text-danger">*</span></label>
                                    </div>
=======
                                <div class=" from-group">
                                    <label for="">Ảnh<span class="text-danger">*</span></label><br>
                                    <img src="<?= BASE_URL . $news['image'] ?>" width="200" id="preview-img" alt=""><br>
                                    <input type="file" class="form-control" name="image"
                                        onchange="encodeImageFileAsURL(this)">
>>>>>>> quannh
                                </div>
                                <div class="from-group p-2">
                                    <div class="col d-flex justify-content-start">
                                        <button type="submit" class="btn btn-primary">Tạo</button>&nbsp;
                                        <a href="<?= ADMIN_URL . 'news' ?>" class="btn btn-danger">Hủy</a>
                                    </div>
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
            $('#preview-img').attr('src', "<?= BASE_URL . $news['image'] ?>");
            return false;
        }
<<<<<<< HEAD
        $('#add-user-form').validate({
            rules: {
                title: {
                    required: true,
                    maxlength: 191
                },
                content: {
                    required: true,
                    maxlength: 500
                },

            },
            messages: {
                title: {
                    required: "Hãy nhập tên bản tin",
                    maxlength: "Số lượng ký tự tối đa bằng 191 ký tự"
                },
                content: {
                    required: "hãy nhập thông tin",
                    maxlength: "số lượng ký tự tối đa 500 ký tự"
                },

            }
        });
=======
        var reader = new FileReader();
        reader.onloadend = function() {
            $('#preview-img').attr('src', reader.result)
        }
        reader.readAsDataURL(file);
    }
    $('#add-user-form').validate({
        rules: {
            title: {
                required: true,
                maxlength: 191
            },
            content: {
                required: true,
                maxlength: 500
            },

        },
        messages: {
            title: {
                required: "Hãy nhập tên bản tin",
                maxlength: "Số lượng ký tự tối đa bằng 191 ký tự"
            },
            content: {
                required: "hãy nhập thông tin",
                maxlength: "số lượng ký tự tối đa 500 ký tự"
            },

        }
    });
>>>>>>> quannh
    </script>
</body>

</html>