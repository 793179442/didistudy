<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <title>未付款</title>
    <link rel="stylesheet" href="__WAP__/css/base.css">
    <link rel="stylesheet" href="__WAP__/css/swiper.min.css">
    <link rel="stylesheet" href="__WAP__/css/style.css">
</head>
<body style="background-color: #f4f3f8;">
<div class = "container bill">
    <!-- header -->
    <header class="header c3">
        <a href="javascript:void(0);" onclick = "history.go(-1);"><span class="top-left-back1"></span></a>
        <span class="top-text">订单详情</span>
        <a href="#"><span class="top-more1"></span></a>
    </header>
    <div class="header-height"></div>

    <!-- page -->
    <div class = "page">  
        <div class="bar1">
            <p>未付款，24小时内未完成支付自动关闭</p>
            <img src="__WAP__/images/order/o1.png">
        </div>
    </div>
    <div class="bar2">
        <div class="t1">
            <span class="left">
                <img src="__WAP__/images/order/tian.png">
                天山教育广场
            </span>
            <span class="right">
                <a href="#"><img src="__WAP__/images/icon/xinxi.png"></a>
                <a href="#"><img src="__WAP__/images/icon/dianhua2.png"></a>
            </span>
        </div>
        <div class="t2">
            <div>
                <span class="left"><?php echo ($orderdata["course_name"]); ?></span>
                <span class="right">¥288.00</span>
            </div>

            <div class="c1">
                <span class="left">预约于05月25日 18:30</span>
                <span class="right">X1</span>
            </div>
            

        </div>
        <div class="t3">
                <span class="left">合计</span>
                <span class="right c2">¥288.00</span>
        </div>
    </div>
    <div class="bar3">
        <div> 
            <label>订单需求</label> 
            <span><?php echo ($orderdata["course_name"]); ?>；环境好；价格优惠</span>
        </div>
        <div> 
            <label>学生昵称</label> 
            <span><?php echo ($orderdata["student_name"]); ?></span>
        </div>
    </div>
</div>
</body>
<script src="__WAP__/js/jquery-3.1.1.min.js"></script>
</html>