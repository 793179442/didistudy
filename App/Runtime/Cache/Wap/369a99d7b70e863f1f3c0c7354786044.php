<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <title>添学</title>
    <link rel="stylesheet" href="__WAP__/css/base.css">
    <link rel="stylesheet" href="__WAP__/css/swiper.min.css">
</head>
<style type="text/css">
    .jump
    {
        position: absolute;
        z-index: 999;
        right: 20px;
        top: 30px;
    }
     .jump a
     {
        background-color: rgba(0, 0, 0, 0.2);
        color: #fff;
        padding: 4px 10px;
        font-size: 14px;
     }.page
     {
        position: relative;
     }
</style>
<body>
<div class = "container">
    <!-- page -->
    <div class = "page">
        <div class="jump">
            <a href="<?php echo U('Wap/Student/index');?>">跳过</a>
        </div>
            <!-- 轮播  Swiper -->
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="__WAP__/images/open1.jpg">
                    </div>

                    <div class="swiper-slide">
                        <img src="__WAP__/images/open2.jpg">
                    </div>

                    <div class="swiper-slide">
                        <a href="<?php echo U('Wap/Student/index');?>"><img src="__WAP__/images/open3.jpg"></a>
                    </div>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
                <!-- Add Pagination -->
            </div>
    </div>
</div>
</body>
<script src="__WAP__/js/jquery-3.1.1.min.js"></script>
<script src="__WAP__/js/swiper.min.js"></script>
<script type="text/javascript">
	    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        autoHeight: true, //enable auto height
        loop : false
        // autoplay: 3000,
        // autoplayDisableOnInteraction: false
    	});
</script>
</html>