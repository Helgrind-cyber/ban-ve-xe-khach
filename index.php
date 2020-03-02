<?php
session_start();
require_once './config/utils.php';
$loggedInUser = $_SESSION[AUTH];
// Lấy dữ liệu từ bảng routes
$getRoutesSql = "select * from routes";
$routes = queryExecute($getRoutesSql, true);
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <!-- Favicon ico -->
    <link rel="shortcut icon" type="image/png" href="<?= PUBLIC_URL . 'images/favicon.ico' ?>" />
    <!-- Bootstrap -->
    <link href="<?= THEME_ASSET_URL ?>dist/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="<?= THEME_ASSET_URL ?>assets/css/custom.css" rel="stylesheet" media="screen">
    <!-- Carousel -->
    <link href="<?= THEME_ASSET_URL ?>examples/carousel/carousel.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?= THEME_ASSET_URL ?>assets/js/html5shiv.js"></script>
    <script src="<?= THEME_ASSET_URL ?>assets/js/respond.min.js"></script>
<![endif]-->

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:700,400,300,300italic' rel='stylesheet' type='text/css'>
    <!-- Font-Awesome -->
    <link rel="stylesheet" type="text/css" href="<?= THEME_ASSET_URL ?>assets/css/font-awesome.css" media="screen" />
    <!--[if lt IE 7]><link rel="stylesheet" type="text/css" href="<?= THEME_ASSET_URL ?>assets/css/font-awesome-ie7.css" media="screen" /><![endif]-->

    <!-- REVOLUTION BANNER CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="<?= THEME_ASSET_URL ?>css/fullscreen.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?= THEME_ASSET_URL ?>rs-plugin/css/settings.css" media="screen" />

    <!-- Picker UI-->
    <link rel="stylesheet" href="<?= THEME_ASSET_URL ?>assets/css/jquery-ui.css" />

    <!-- jQuery -->
    <script src="<?= THEME_ASSET_URL ?>assets/js/jquery.v2.0.3.js"></script>


</head>

<body id="top">

    <!-- Top wrapper -->
    <div class="navbar-wrapper2 navbar-fixed-top">
        <div class="container">
            <div class="navbar mtnav">

                <div class="container offset-3">
                    <!-- Navigation-->
                    <div class="navbar-header">
                        <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                            <span class="icon-bar">ghguyuiioopp</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="index.php" class="navbar-brand"><img src="<?= BASE_URL ?>public/images/logo1.ico" alt="Travel Agency Logo" class="logo" /></a>
                    </div>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">

                            <li class="dropdown">
                                <a href="index.php">Trang chủ<span class="badge indent0"></a>

                            </li>
                            <?php if ($loggedInUser) : ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Hi, <?= $loggedInUser['name']; ?></a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Thông tin cá nhân</a>
                                        <a class="dropdown-item" href="#">Đổi mật khẩu</a>
                                        <a class="dropdown-item" href="#">Thông tin vé xe</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="<?php echo BASE_URL . './logout.php' ?>">Đăng xuất</a>
                                    </div>
                                </li>
                            <?php else : ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="login.php" title="">Đăng Nhập</a>
                                </li>
                            <?php endif ?>
                        </ul>
                    </div>
                    <!-- /Navigation-->
                </div>

            </div>
        </div>
    </div>
    <!-- / Top wrapper -->
    <div id="dajy" class="fullscreen-container mtslide sliderbg fixed">
        <div class="fullscreenbanner">
            <ul>

                <!-- SLIDE DOWN -->

                <!-- FADE -->
                <li data-transition="fade" data-slotamount="1" data-masterspeed="300">
                    <img src="<?= THEME_ASSET_URL ?>images/slider/1.png" alt="" />
                    <div class="tp-caption scrolleffect sft" data-x="center" data-y="120" data-speed="1000" data-start="800" data-easing="easeOutExpo">
                        <div class="sboxpurple textcenter">
                        </div>
                    </div>
                </li>

                <!-- FADE -->
                <li data-transition="fade" data-slotamount="1" data-masterspeed="300">
                    <img src="<?= THEME_ASSET_URL ?>images/slider/2.png" alt="" />
                    <div class="tp-caption scrolleffect sft" data-x="center" data-y="120" data-speed="1000" data-start="800" data-easing="easeOutExpo">
                        <div class="sboxpurple textcenter">

                        </div>
                    </div>
                </li>

                <!-- FADE -->
                <li data-transition="fade" data-slotamount="1" data-masterspeed="300">

                    <img src="<?= THEME_ASSET_URL ?>images/slider/3.png" alt="" />
                    <div class="tp-caption scrolleffect sft" data-x="center" data-y="120" data-speed="1000" data-start="800" data-easing="easeOutExpo">
                        <div class="sboxpurple textcenter">

                        </div>
                    </div>
                </li>

            </ul>
            <div class="tp-bannertimer none"></div>
        </div>
    </div>

    <!--
##############################
 - ACTIVATE THE BANNER HERE -
##############################
-->
    <script type="text/javascript">
        var tpj = jQuery;
        tpj.noConflict();

        tpj(document).ready(function() {

            if (tpj.fn.cssOriginal != undefined)
                tpj.fn.css = tpj.fn.cssOriginal;

            tpj('.fullscreenbanner').revolution({
                delay: 9000,
                startwidth: 1170,
                startheight: 600,

                onHoverStop: "on", // Stop Banner Timet at Hover on Slide on/off

                thumbWidth: 100, // Thumb With and Height and Amount (only if navigation Tyope set to thumb !)
                thumbHeight: 50,
                thumbAmount: 3,

                hideThumbs: 0,
                navigationType: "bullet", // bullet, thumb, none
                navigationArrows: "solo", // nexttobullets, solo (old name verticalcentered), none

                navigationStyle: false, // round,square,navbar,round-old,square-old,navbar-old, or any from the list in the docu (choose between 50+ different item), custom


                navigationHAlign: "left", // Vertical Align top,center,bottom
                navigationVAlign: "bottom", // Horizontal Align left,center,right
                navigationHOffset: 30,
                navigationVOffset: 30,

                soloArrowLeftHalign: "left",
                soloArrowLeftValign: "center",
                soloArrowLeftHOffset: 20,
                soloArrowLeftVOffset: 0,

                soloArrowRightHalign: "right",
                soloArrowRightValign: "center",
                soloArrowRightHOffset: 20,
                soloArrowRightVOffset: 0,

                touchenabled: "on", // Enable Swipe Function : on/off


                stopAtSlide: -1, // Stop Timer if Slide "x" has been Reached. If stopAfterLoops set to 0, then it stops already in the first Loop at slide X which defined. -1 means do not stop at any slide. stopAfterLoops has no sinn in this case.
                stopAfterLoops: -1, // Stop Timer if All slides has been played "x" times. IT will stop at THe slide which is defined via stopAtSlide:x, if set to -1 slide never stop automatic

                hideCaptionAtLimit: 0, // It Defines if a caption should be shown under a Screen Resolution ( Basod on The Width of Browser)
                hideAllCaptionAtLilmit: 0, // Hide all The Captions if Width of Browser is less then this value
                hideSliderAtLimit: 0, // Hide the whole slider, and stop also functions if Width of Browser is less than this value


                fullWidth: "on", // Same time only Enable FullScreen of FullWidth !!
                fullScreen: "off", // Same time only Enable FullScreen of FullWidth !!


                shadow: 0 //0 = no Shadow, 1,2,3 = 3 Different Art of Shadows -  (No Shadow in Fullwidth Version !)

            });


        });
    </script>
    <!-- WRAP -->
    <div class="wrap cstyle03">

        <div class="container mt-200 z-index100">
            <div class="row">
                <div class="col-md-2 col-md-push-8"></div>
                <div class="col-md-8">
                    <div class="bs-example bs-example-tabs cstyle04">

                        <ul class="nav nav-tabs" id="myTab">

                            <li onclick="mySelectUpdate()" class=""><a data-toggle="tab" href="#car"><span class="car"></span>Car</a></li>

                        </ul>

                        <div class="tab-content3" id="myTabContent">
                            <div id="air" class="tab-pane fade active in">
                                <form action="<?php echo BASE_URL . 'search.php' ?>" method="get" enctype="multipart/form-data">
                                    <div class="w50percent">
                                        <div class="wh90percent textleft">
                                            <span class="opensans size13"><b>Điểm đi</b></span>
                                            <select class="form-control mySelectBoxClass" name="begin_point">
                                                <option value="" selected>Tất cả</option>
                                                <?php foreach ($routes as $route) : ?>
                                                    <option value="<?php echo $route['id'] ?>">
                                                        <?php echo $route['begin_point'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="w50percentlast">
                                        <div class="wh90percent textleft right">
                                            <span class="opensans size13"><b>Điểm đến</b></span>
                                            <select class="form-control mySelectBoxClass" name="end_point">
                                                <option value="" selected>Tất cả</option>
                                                <?php foreach ($routes as $route) : ?>
                                                    <option value="<?php echo $route['id'] ?>">
                                                        <?php echo $route['end_point'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="w50percentlast">
                                        <div class="wh90percent textleft right">
                                            <span class="opensans size13"><b>Chọn ngày</b></span>
                                            <input type="text" class="form-control mySelectCalendar" id="datepicker4" placeholder="mm/dd/yyyy" name="created_date" />
                                        </div>
                                    </div>

                                    <div class="w50percent">
                                        <div class="wh90percent textleft">
                                            <span class="opensans size13"><b>Số Ghế</b></span>
                                            <input class="form-control" type="number" name="seat_number">
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="text-center pt-5">
                                        <button type="submit" class="btn-search text-center">Đặt vé</button>
                                    </div>
                                </form>
                            </div>
                            <!--End of 1st tab -->
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-md-push-8"></div>

            </div>
        </div>
        <!-- FOOTER -->

        <div class="footerbg">
            <div class="container">

                <div class="col-md-3">
                    <span class="ftitle">Mạng xã hội</span>
                    <div class="scont">
                        <a href="#" class="social1b"><img src="<?= THEME_ASSET_URL ?>images/icon-facebook.png" alt="" /></a>
                        <a href="#" class="social2b"><img src="<?= THEME_ASSET_URL ?>images/icon-twitter.png" alt="" /></a>
                        <a href="#" class="social3b"><img src="<?= THEME_ASSET_URL ?>images/icon-gplus.png" alt="" /></a>
                        <a href="#" class="social4b"><img src="<?= THEME_ASSET_URL ?>images/icon-youtube.png" alt="" /></a>
                        <br /><br /><br />
                        <img src="<?= THEME_ASSET_URL ?>images/logo1.ico" width="100px" alt="" /><br />
                        &copy; 2013 | <a href="#">Privacy Policy</a><br />
                        All Rights Reserved
                        <br /><br />

                    </div>
                </div>
                <!-- End of column 1-->

                <div class="col-md-3">
                    <span class="ftitle">Điểm đi</span>
                    <br /><br />
                    <ul class="footerlist">
                        <li><a href="#">Hà Nội</a></li>
                        <li><a href="#">Hải Phòng</a></li>
                        <li><a href="#">Nam Định</a></li>
                        <li><a href="#">Bắc Ninh</a></li>
                        <li><a href="#">Hà Nam</a></li>
                        <li><a href="#">Ninh Bình</a></li>
                    </ul>
                </div>
                <!-- End of column 2-->

                <div class="col-md-3">
                    <span class="ftitle">Điểm đến</span>
                    <br /><br />
                    <ul class="footerlist">
                        <li><a href="#">Hà Nội</a></li>
                        <li><a href="#">Hải Phòng</a></li>
                        <li><a href="#">Nam Định</a></li>
                        <li><a href="#">Bắc Ninh</a></li>
                        <li><a href="#">Hà Nam</a></li>
                        <li><a href="#">Ninh Bình</a></li>
                    </ul>
                </div>
                <!-- End of column 3-->

                <div class="col-md-3 grey">
                    <span class="ftitle">Liên lạc</span>
                    <div class="relative">
                        <input type="email" class="form-control fccustom2" id="exampleInputEmail1" placeholder="Nhập email">
                        <button type="submit" class="btn btn-default btncustom">Submit<img src="<?= THEME_ASSET_URL ?>images/arrow.png" alt="" /></button>
                    </div>
                    <br /><br />
                    <span class="ftitle">Hỗ trợ</span><br />
                    <span class="pnr">024.5333.344</span><br />
                    office@travel.com
                </div>
                <!-- End of column 4-->

            </div>
        </div>
    </div>
    <div class="footerbg3">
        <div class="container center grey">
            <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.0.2
            </div>
        </div>
    </div>
    <!-- / WRAP -->


    <!-- Javascript -->

    <!-- This page JS -->
    <script src="<?= THEME_ASSET_URL ?>assets/js/js-index3.js"></script>

    <!-- Custom functions -->
    <script src="<?= THEME_ASSET_URL ?>assets/js/functions.js"></script>

    <!-- Picker UI-->
    <script src="<?= THEME_ASSET_URL ?>assets/js/jquery-ui.js"></script>

    <!-- Easing -->
    <script src="<?= THEME_ASSET_URL ?>assets/js/jquery.easing.js"></script>

    <!-- jQuery KenBurn Slider  -->
    <script type="text/javascript" src="<?= THEME_ASSET_URL ?>rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

    <!-- Nicescroll  -->
    <script src="<?= THEME_ASSET_URL ?>assets/js/jquery.nicescroll.min.js"></script>

    <!-- CarouFredSel -->
    <script src="<?= THEME_ASSET_URL ?>assets/js/jquery.carouFredSel-6.2.1-packed.js"></script>
    <script src="<?= THEME_ASSET_URL ?>assets/js/helper-plugins/jquery.touchSwipe.min.js"></script>
    <script type="text/javascript" src="<?= THEME_ASSET_URL ?>assets/js/helper-plugins/jquery.mousewheel.min.js"></script>
    <script type="text/javascript" src="<?= THEME_ASSET_URL ?>assets/js/helper-plugins/jquery.transit.min.js"></script>
    <script type="text/javascript" src="<?= THEME_ASSET_URL ?>assets/js/helper-plugins/jquery.ba-throttle-debounce.min.js"></script>

    <!-- Custom Select -->
    <script type='text/javascript' src="<?= THEME_ASSET_URL ?>assets/js/jquery.customSelect.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?= THEME_ASSET_URL ?>dist/js/bootstrap.min.js"></script>
</body>

<!-- Mirrored from titanicthemes.com/travel/blue/index6.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 23 Feb 2020 09:36:55 GMT -->

</html>