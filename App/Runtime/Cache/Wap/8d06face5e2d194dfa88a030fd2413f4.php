<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <title>用户 - 收藏</title>
    <link rel="stylesheet" href="__WAP__/css/base.css">
    <link rel="stylesheet" href="__WAP__/css/swiper.min.css">
    <link rel="stylesheet" href="__WAP__/css/style.css">
</head>
<body style="background-color: #f4f3f8;">
<div class = "container user-6">
    <!-- header -->
    <header class="header ">
        <a href="javascript:void(0);" onclick = "history.go(-1);"><span class="top-left-back"></span></a>
        <span class="top-text">收藏</span>
    </header>
    <div class="header-height"></div>

    <!-- page -->
    <div class = "page">
        <div class="menu">
            <div id="i1"><span class="active">订单</span></div>
            <div id="i2"><span>任务</span></div>
        </div>
        <div class="content i1">
            <div class="item">
                <a href="#">
                    <div class="img"><img src="__WAP__/images/user/s.jpg"></div>
                    <div class="t">
                        <span class="t1">数理家庭教师</span>
                        <span class="t2">¥35/小时</span>
                    </div>
                    <div class="t">
                        <span class="t3">上门 00:00 ~ 24:00</span>
                    </div>
                </a>
            </div>
            <div class="item">
                <a href="#">
                    <div class="img"><img src="__WAP__/images/user/s.jpg"></div>
                    <div class="t">
                        <span class="t1">数理家庭教师</span>
                        <span class="t2">¥35/小时</span>
                    </div>
                    <div class="t">
                        <span class="t3">上门 00:00 ~ 24:00</span>
                    </div>
                </a>
            </div>
            <div class="item">
                <a href="#">
                    <div class="img"><img src="__WAP__/images/user/s.jpg"></div>
                    <div class="t">
                        <span class="t1">数理家庭教师</span>
                        <span class="t2">¥35/小时</span>
                    </div>
                    <div class="t">
                        <span class="t3">上门 00:00 ~ 24:00</span>
                    </div>
                </a>
            </div>
        </div>


        <div class="content i2" style="display: none">
            <div class="item">
                <a href="#">
                    <div class="img"><img src="__WAP__/images/user/s.jpg"></div>
                    <div class="t">
                        <span class="t1">数理家庭教师</span>
                        <span class="t2">¥35/小时</span>
                    </div>
                    <div class="t">
                        <span class="t3">上门 00:00 ~ 24:00</span>
                    </div>
                </a>
            </div>
            <div class="item">
                <a href="#">
                    <div class="img"><img src="__WAP__/images/user/s.jpg"></div>
                    <div class="t">
                        <span class="t1">数理家庭教师</span>
                        <span class="t2">¥35/小时</span>
                    </div>
                    <div class="t">
                        <span class="t3">上门 00:00 ~ 24:00</span>
                    </div>
                </a>
            </div>
            <div class="item">
                <a href="#">
                    <div class="img"><img src="__WAP__/images/user/s.jpg"></div>
                    <div class="t">
                        <span class="t1">数理家庭教师</span>
                        <span class="t2">¥35/小时</span>
                    </div>
                    <div class="t">
                        <span class="t3">上门 00:00 ~ 24:00</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
</body>
<script src="__WAP__/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
    $(".menu div").on('click', function() {
        $(".menu div span").removeClass("active");
        $(this).find("span").addClass("active");
        $(".content").hide();
        var id = $(this).attr("id");
        $("."+id).show();
    });
</script>
</html>