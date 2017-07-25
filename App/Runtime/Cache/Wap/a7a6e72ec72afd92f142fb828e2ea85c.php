<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <title>用户 - 设置</title>
    <link rel="stylesheet" href="__WAP__/css/base.css">
    <link rel="stylesheet" href="__WAP__/css/swiper.min.css">
    <link rel="stylesheet" href="__WAP__/css/style.css">
</head>
<body style="background-color: #f4f3f8;">
<div class = "container user-9">
    <!-- header -->
    <header class="header ">
        <a href="javascript:void(0);" onclick = "history.go(-1);"><span class="top-left-back"></span></a>
        <span class="top-text">设置</span>
    </header>
    <div class="header-height"></div>

    <!-- page -->
    <div class = "page">
        <div>
            <ul class="item-more-bg">
                <li><a href="#">常用地址管理</a></li>
                <li><a href="<?php echo U('Wap/User/user_10');?>">支付设置</a></li>
            </ul>
        </div>
        <div>
            <ul class="item-more-bg">
                <li><a href="<?php echo U('Wap/User/user_5');?>">邀请好友</a></li>
                <li><a href="#">App Store评分</a></li>
                <li><a href="#">清楚缓存</a></li>
            </ul>
        </div>
        <div>
            <ul class="item-more-bg">
                <li><a href="<?php echo U('Wap/User/about');?>">关于</a></li>
                <li><a href="<?php echo U('Wap/Index/logout');?>">退出当前账号</a></li>
            </ul>
        </div>
    </div>
</div>
</body>
<script src="__WAP__/js/jquery-3.1.1.min.js"></script>
</html>