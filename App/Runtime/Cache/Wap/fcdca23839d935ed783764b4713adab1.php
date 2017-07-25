<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <title>管理设置</title>
    <link rel="stylesheet" href="__WAP__/css/base.css">
    <link rel="stylesheet" href="__WAP__/css/style.css">
</head>
<body style="background-color: #faf9fe;">
<div class = "container teacher-4">
    <!-- header -->
    <header class="header c1">
        <a href="javascript:void(0);" onclick="leftcolumn();"><span class="top-icon-menu"></span></a>
        <span class="top-logo1"><img src="__WAP__/images/teacher/teacher-logo.png"></span>
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
        <div class="bar1 white-style">
            <div class="t1">
                <span class="l"><i class="blue"></i>自动接单</span>
                <span class="r">
                    <div class="toggle active">
                            <div class="toggle-handle"></div>
                    </div>
                </span>
            </div>
            <div class="t2">
                <span class="l">在发布的课程勾选后自动接单选项</span>
                <span class="r">每日自动接 <input type="text" name="" style="width: 35px;text-align: center;    height: 13px;" > 单</span>
            </div>
        </div>
        <div class="bar2 white-style">
            <span class="l"><i class="blue"></i>自动接单</span>
                <span class="r">
                    <div class="toggle active">
                            <div class="toggle-handle"></div>
                    </div>
            </span>
        </div>
        <div class="bar3 white-style">
            <div><span class="l"><i class="blue"></i>订阅关注</span></div>
            <div style="font-size: 12px;">订阅相关类别才能收到该类别需求推送消息</div>
            <div class="content">
                <a href="#">物理</a>
                <a href="#">英语</a>
                <a href="#">作文</a>
                <a href="#">物理</a>
                <a href="#">英语</a>
                <a href="#">作文</a>
                <a href="#">作文</a>
            </div>
            <div class="btn">
                <a href="#"><img src="__WAP__/images/icon/add.png"></a>
            </div>
        </div>
    </div>
</div>
</body>
<script src="__WAP__/js/jquery-3.1.1.min.js"></script>
<script src="__WAP__/js/base.js"></script>
<script src="__WAP__/js/ratchet.min.js"></script>
<script type="text/javascript">
</script>
</html>