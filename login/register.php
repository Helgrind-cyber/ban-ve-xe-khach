<?php
// bắt đầu sử dụng session
session_start();
require_once "../config/utils.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="./public/img/favicon.ico" type="image/x-icon">
    <title>Resigter</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo PUBLIC_URL . 'css/main.css' ?>">
    <style>
        label.error {
            display: inline;
            color: #ff0000;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="col-8 offset-2">
            <div class="col-5 offset-4 login-logo">
                <a href="<?php echo BASE_URL ?>">
                    <img src="<?php echo BASE_URL . 'public/images/logo1.ico' ?>" alt="" class="img-thumbnail">
                </a>
            </div>
            <form id="validation" role="form" action="<?php echo BASE_URL . 'login/save-register.php'; ?>" method="post" enctype="multipart/form-data" autocomplete="on">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="email">Địa chỉ email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Nhập Email" autofocus>
                        <?php if (isset($_GET['emailerr'])) : ?>
                            <label class="error"><?= $_GET['emailerr'] ?></label>
                        <?php endif; ?>
                    </div>
                    <div class="form-group col-6">
                        <label for="name">Họ và tên</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ và tên">
                        <?php if (isset($_GET['nameerr'])) : ?>
                            <label class="error"><?= $_GET['nameerr'] ?></label>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="password">Mật khẩu</label>
                        <input type="password" class="form-control" id="main-password" name="password" autocomplete="off" placeholder="Nhập mật khẩu">
                        <?php if (isset($_GET['passworderr'])) : ?>
                            <label class="error"><?= $_GET['passworderr'] ?></label>
                        <?php endif; ?>
                    </div>
                    <div class="form-group col-6">
                        <label for="cfpassword">Nhập lại mật khẩu</label>
                        <input type="password" class="form-control" name="cfpassword" autocomplete="off" placeholder="Nhập lại mật khẩu">
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-warning">Xác nhận đăng ký</button>&nbsp;
                    <a href="<?php echo BASE_URL ?>" class="btn btn-danger">Hủy</a>
                </div>
            </form>
        </div>
    </div>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <!-- Jquery Validation -->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#validation").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6,
                        maxlength: 16
                    },
                    name: {
                        required: true,
                        minlength: 2,
                        maxlength: 191
                    },
                    cfpassword: {
                        required: true,
                        equalTo: "#main-password"
                    }
                },

                messages: {
                    email: "Vui lòng nhập email",
                    password: {
                        required: "Hãy nhập mật khẩu",
                        minlength: "Số lượng ký tự tối 6 ký tự",
                        maxlength: "Số lượng ký tự tối đa bằng 191 ký tự"
                    },
                    cfpassword: {
                        required: "Nhập lại mật khẩu",
                        equalTo: "Cần khớp với mật khẩu"
                    },
                    name : {
                        maxlength: "Số lượng ký tự tối đa là 191 ký tự",
                        minlength: "Số lượng ký tự tối thiểu bằng 2 ký tự",
                        required: "Hãy nhập tên bạn vào đây"
                    }
                },

                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
</body>

</html>