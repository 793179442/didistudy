<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <title>添学 - 老师</title>
    <link rel="stylesheet" href="__WAP__/css/base.css">
    <link rel="stylesheet" href="__WAP__/css/swiper.min.css">
    <link rel="stylesheet" href="__WAP__/css/style.css">
</head>
<body style="background-color: #faf9fe;">
<div class = "container student-1">
    <!-- header -->
    <header class="header c1">
        <a href="javascript:void(0);" onclick="leftcolumn();"><span class="top-icon-menu"></span></a>
        <a href="<?php echo U('Wap/Teacher/teacher_2');?>"><span class="top-teacher">接单管理</span></a>
    </header>
    <div class="header-height"></div>
    <!-- 隐藏栏 -->
        <!-- 隐藏栏 -->
    <div class="left-hide-column-bg"></div>
    <div class="left-hide-column ">
        <div class="bar1">
            <a href="<?php echo U('Wap/User/user_1');?>">
                <img src="<?php echo (($userdata["img_head"])?($userdata["img_head"]):'__WAP__/images/student/user.png'); ?>">
                <span><?php echo (($userdata["name"])?($userdata["name"]):"名称为空"); ?></span>
                <span class="icon-right-more"></span>
            </a>
        </div>
        <div class="bar2">
            <a href="<?php echo U('Wap/User/user_2');?>"><span>订单 | 任务</span></a>
            <a href="<?php echo U('Wap/User/user_3');?>"><span>钱包</span></a>
            <a href="<?php echo U('Wap/User/user_4');?>"><span>入驻</span></a>
            <a href="<?php echo U('Wap/User/user_5');?>"><span>推荐</span></a>
        </div>
        <div class="bar3">
            <a href="<?php echo U('Wap/User/user_6');?>"><span>收藏</span></a>
            <a href="<?php echo U('Wap/User/user_7');?>"><span>消息</span></a>
            <a href="<?php echo U('Wap/User/user_9');?>"><span>设置</span></a>
        </div>
    </div>





    <!-- page -->
    <div class = "page">
        <div class="logo">
            <img src="__WAP__/images/student/logo.png">
        </div>
        <div class="bar1">
            <input type="text" name=""  class="white-style input-class1" placeholder="输入你要学什么">
        </div>

        <div class="bar2">
            <!-- 轮播  Swiper -->
            <div class="swiper-container1" style="    overflow: hidden;">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a href="#"><img src="__WAP__/images/img/banner1.jpg"></a>
                    </div>

                    <div class="swiper-slide">
                        <a href="#"><img src="__WAP__/images/img/banner2.jpg"></a>
                    </div>

                    <div class="swiper-slide">
                        <a href="#"><img src="__WAP__/images/img/banner3.jpg"></a>
                    </div>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination1"></div>
                <!-- Add Pagination -->
            </div>
        </div>
        <div class="bar3">
            <div class="title">
                <img src="__WAP__/images/student/title.png">
            </div>
            <div>
                <!-- 轮播  Swiper -->
                <div class="swiper-container2">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <a href="#"><img src="__WAP__/images/img/i1.jpg"></a>
                        </div>

                        <div class="swiper-slide">
                            <a href="#"><img src="__WAP__/images/img/i2.jpg"></a>
                        </div>

                        <div class="swiper-slide">
                            <a href="#"><img src="__WAP__/images/img/i3.jpg"></a>
                        </div>

                        <div class="swiper-slide">
                            <a href="#"><img src="__WAP__/images/img/i4.jpg"></a>
                        </div>
                        <div class="swiper-slide">
                            <a href="#"><img src="__WAP__/images/img/i5.jpg"></a>
                        </div>
                        <div class="swiper-slide">
                            <a href="#"><img src="__WAP__/images/img/i6.jpg"></a>
                        </div>
                        <div class="swiper-slide">
                            <a href="#"><img src="__WAP__/images/img/i7.jpg"></a>
                        </div>
                        <div class="swiper-slide">
                            <a href="#"><img src="__WAP__/images/img/i8.jpg"></a>
                        </div>
                        <div class="swiper-slide">
                            <a href="#"><img src="__WAP__/images/img/i9.jpg"></a>
                        </div>
                        <div class="swiper-slide">
                            <a href="#"><img src="__WAP__/images/img/i10.jpg"></a>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="__WAP__/js/jquery-3.1.1.min.js"></script>
<script src="__WAP__/js/base.js"></script>
<script src="__WAP__/js/swiper.min.js"></script>
<script type="text/javascript">
        var swiper = new Swiper('.swiper-container1', {
        pagination: '.swiper-pagination1',
        paginationClickable: true,
        autoHeight: true, //enable auto height
        loop : false,
        // autoplay: 3000,
        // autoplayDisableOnInteraction: false
        });

        var swiper = new Swiper('.swiper-container2', {
        pagination: '.swiper-pagination2',
        slidesPerView: 2.3,
        centeredSlides: true,
        paginationClickable: true,
        spaceBetween: 20,
        grabCursor: true
        // autoplay: 3000,
        // autoplayDisableOnInteraction: false
        });
</script>
</html>