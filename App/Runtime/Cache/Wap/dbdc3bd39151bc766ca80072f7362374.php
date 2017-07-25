<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <title>用户 - 支付设置</title>
    <link rel="stylesheet" href="__WAP__/css/base.css">
    <link rel="stylesheet" href="__WAP__/css/swiper.min.css">
    <link rel="stylesheet" href="__WAP__/css/style.css">
</head>
<body style="background-color: #f4f3f8;">
<div class = "container user-9">
    <!-- header -->
    <header class="header ">
        <a href="javascript:void(0);" onclick = "history.go(-1);"><span class="top-left-back"></span></a>
        <span class="top-text">支付设置</span>
    </header>
    <div class="header-height"></div>

    <!-- page -->
    <div class = "page">
        <div class="switch-btn"> 
            <ul class="item-more-bg">
                <li>
                    <a href="#">更改支付密码</a>
                </li>
                 <li  class="btn">
                    <span>指纹支付</span>
                    <div> 
                        <div class="toggle active">
                            <div class="toggle-handle"></div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
</body>
<script src="__WAP__/js/jquery-3.1.1.min.js"></script>
<script src="__WAP__/js/ratchet.min.js"></script>
</html>