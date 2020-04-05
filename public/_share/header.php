<header class="border-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-2 dashboard-logo">
                <a href="<?php BASE_URL ?>">
                    <img src="<?php echo PUBLIC_URL . 'images/logo1.ico' ?>" alt="LOGO" class="">
                </a>
            </div>
            <div class="col-md-10">
                <ul class="navbar navbar-expand-md dashboard-nav nav justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo BASE_URL ?>">Trang Chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Thông tin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL . 'list-tickets.php' ?>">Danh sách vé</a>
                    </li>
                    <?php if ($loggedInUser) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Hi, <?= $loggedInUser['name']; ?></a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Thông tin cá nhân</a>
                                <a class="dropdown-item" href="#">Đổi mật khẩu</a>
                                <a class="dropdown-item" href="#">Thông tin vé xe</a>
                                <a class="dropdown-item text-danger" style="<?php if ($loggedInUser !== null && $loggedInUser['role_id'] > 1) {
                                                                                echo 'display:inline-block';
                                                                            } else {
                                                                                echo 'display:none';
                                                                            } ?>" href="<?= ADMIN_URL . 'dashboard' ?>">Quản lý Trang Web</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= BASE_URL . 'login/logout.php' ?>">Đăng xuất</a>
                            </div>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL . 'login/login.php' ?>" title="">Đăng Nhập</a>
                        </li>
                    <?php endif ?>
                    <li class="btn-cart nav-item btn btn-outline-primary">
                        <a class="nav-link" href="#" title="Pay tickets">Thanh toán <i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>