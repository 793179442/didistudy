<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <title>添学</title>
    <link rel="stylesheet" href="__WAP__/css/base.css">
</head>
<style type="text/css">
.page
{
    text-align: center;
}
.bg
{
}
.bg > div
{

}
.a img,.b img
{
      width: 70px;
}
.a p,.b p
{
    font-size: 20px;
    color: #fff;
        padding-top: 10px;
}
.bot-text
{
    position: absolute;
    bottom: 10px;
    color: #4e4e50;
    right: 15px;
}
.line
{
	background-color: #fff;
    height: 2px;
    width: 60%;

    margin: 40px auto;
    border-radius: 5px;
}
.top
{
    padding: 50px 0;
}
.top img
{
	width: 60%;
}
</style>
<body style="    background-color: #65a5fd;background: url(__WAP__/images/index/bg.png);background-size: 150%;">
<div class = "container">
    <!-- page -->
    <div class = "page">
        <div class="bg">
        	<div class="top">
        		<img src="__WAP__/images/index/a1.png">
        	</div>
            <div class="a">
                <a href="<?php echo U('Wap/Index/login');?>">
                    <img src="__WAP__/images/index/a2.png">
                    <p>我是学生</p>
                </a>
            </div>
            <div class="line"></div>
            <div class="b">
                <a href="<?php echo U('Wap/Index/login',array('teacher'=>1));?>">
                    <img src="__WAP__/images/index/a3.png">
                    <p>我是老师</p>
                </a>
            </div>
        </div>
    </div>
</div>
</body>
<script src="__WAP__/js/jquery-3.1.1.min.js"></script>
</html>