<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <title>用户 - 入驻</title>
    <link rel="stylesheet" href="__WAP__/css/base.css">
    <link rel="stylesheet" href="__WAP__/css/swiper.min.css">
    <link rel="stylesheet" href="__WAP__/css/style.css">
</head>
<body style="background-color: #f4f3f8;">
<div class = "container user-4">
    <!-- header -->
    <header class="header ">
        <a href="javascript:void(0);" onclick = "history.go(-1);"><span class="top-left-back"></span></a>
        <span class="top-text">入驻</span>
    </header>
    <div class="header-height"></div>

    <!-- page -->
    <div class = "page">
        <div class="banner">
            <a href="#"><img src="__WAP__/images/user/banner.jpg"></a>
        </div>
        <div class = "bar">
            <a href="<?php echo U('Wap/Recruit/login_1');?>">
                <div class="zq-bg"></div>
                <div >
                    <img src="__WAP__/images/user/r1.jpg">
                    <p>机构入驻</p>
                </div>
            </a>
            <a href="#" style="border-left:1px solid #e2e2e2;border-right:1px solid #e2e2e2;">
                <div class="zq-bg"></div>
                <div >
                    <img src="__WAP__/images/user/r2.jpg">
                    <p>老师入驻</p>
                </div>
            </a>
            <a href="index_login_1.html" >
                <div >
                    <img src="__WAP__/images/user/r3.jpg">
                    <p>合作商家</p>
                </div>
            </a>
        </div>
        <div class = "bar">
            <a href="<?php echo U('Wap/User/user_1');?>" >
                <div >
                    <img src="__WAP__/images/user/r4.jpg">
                    <p>基本信息</p>
                    <span>25%完善度</span>
                </div>
            </a>
            <a href="<?php echo U('Wap/Recruit/login_2');?>" style="border-left:1px solid #e2e2e2;border-right:1px solid #e2e2e2;">
                <div >
                    <img src="__WAP__/images/user/r5.jpg">
                    <p>实名认证</p>
                    <span>未认证</span>
                </div>
            </a>
            <a href="<?php echo U('Wap/Recruit/login_3');?>" >
                <div >
                    <img src="__WAP__/images/user/r6.jpg">
                    <p>资质认证</p>
                    <span>待认证</span>
                </div>
            </a>
        </div>
        <div class="fot">
            <img src="__WAP__/images/logo.png">
            <div>为学生、老师培训机构者提供精准需求对接</div>
        </div>
    </div>
</div>
</body>
<script src="__WAP__/js/jquery-3.1.1.min.js"></script>
</html>