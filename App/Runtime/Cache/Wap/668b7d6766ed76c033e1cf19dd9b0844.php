<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <title>添学 - 获接单</title>
    <link rel="stylesheet" href="__WAP__/css/base.css">
    <link rel="stylesheet" href="__WAP__/css/swiper.min.css">
    <link rel="stylesheet" href="__WAP__/css/style.css">
</head>
<body style="background-color: #faf9fe;">
<div class = "container order-2">
    <!-- header -->
    <header class="header c1">
        <a href="javascript:void(0);" onclick="leftcolumn();"><span class="top-icon-menu"></span></a>
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
            <input type="text" name=""  class="white-style input-class1 ssss" placeholder="输入你要学什么">
        </div>
        
       <div  class="bar2 white-style">
            <div class="item more">
                <a href="order_3.html">
                    <div class="img"><img src="__WAP__/images/order/didian.png"></div>
                    <div class="content">
                        <div class="t1">请开启消息推送提示</div>
                        <div class="t2"> 帮助您寻找到附近的最优课程</div>
                    </div>
                </a>
            </div>
        </div>


        <div  class="bar2 white-style">
        <?php if(is_array($studentData2)): $i = 0; $__LIST__ = $studentData2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$to): $mod = ($i % 2 );++$i;?><div class="item">
                <a href="order_3.html">
                    <div class="number">
                        2
                    </div>
                    <div class="img"><img src="__WAP__/images/order/img.png"></div>
                    <div class="content">
                        <div class="t1"><?php echo ($to["course_name"]); ?></div>
                        <div class="t2"> 收到老师为你推荐的学习课程...</div>
                    </div>
                    <div class="btn">
                        <div class="ic"></div>
                        <div>查看</div>
                    </div>
                </a>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
            <?php if(is_array($studentData1)): $i = 0; $__LIST__ = $studentData1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="item">
                <a href="order_3.html">
                    <div class="img"><img src="__WAP__/images/order/img.png"></div>
                    <div class="content">
                        <div class="t1"><?php echo ($vo["course_name"]); ?></div>
                        <div class="t2 c1"> 需求已发布，等待老师回复</div>
                    </div>
                    <div class="btn">
                        <div class="ic"><img src="__WAP__/images/order/yuan.png"></div>
                        <div>刷新</div>
                    </div>
                </a>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>

        </div>
        <div class="bar3">
            <!-- 轮播  Swiper -->
            <div class="swiper-container1" style="overflow: hidden;">
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
    </div>
</div>
</body>
<script src="__WAP__/js/jquery-3.1.1.min.js"></script>
<script src="__WAP__/js/base.js"></script>
<script src="__WAP__/js/swiper.min.js"></script>
<script type="text/javascript">
$(function(){
    $('.ssss').click(function(){
        window.location.href="<?php echo U('Wap/Order/order_1');?>";
    });
    
});
        var swiper = new Swiper('.swiper-container1', {
        pagination: '.swiper-pagination1',
        paginationClickable: true,
        autoHeight: true, //enable auto height
        loop : false,
        autoplay: 3000,
        // autoplayDisableOnInteraction: false
        });
</script>
</html>