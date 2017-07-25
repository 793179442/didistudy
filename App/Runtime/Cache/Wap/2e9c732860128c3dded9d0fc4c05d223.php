<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <title>实名认证</title>
    <link rel="stylesheet" href="__WAP__/css/base.css">
    <link rel="stylesheet" href="__WAP__/css/style.css">
</head>
<body style="background-color: #f4f3f8;">
<div class = "container login-1">
    <!-- header -->
    <header class="header b1">
        <a href="javascript:void(0);" onclick = "history.go(-1);"><span class="top-left-back"></span></a>
        <span class="top-text">实名认证</span>
        <a href="#"><span class="top-more1"></span></a>
    </header>
    <div class="header-height"></div>
    
    <!-- page -->
    <div class = "page">  
        <form action="#" method="post">
        <div class="title">请填写身份证信息</div>
        <div class="bar">
            <div class="item">
                <label>姓名</label>
                <span><input type="text" name="" placeholder="请输入姓名"></span>
            </div>
            <div class="item">
                <label>身份证</label>
                <span><input type="text" name="" placeholder="请输入身份证"></span>
            </div>
        </div>
        <div class="title">提醒：身份验证后不可更改，且后续只能绑定该身份证持卡人名下的银行卡，请慎重操作</div>
        <div class="bar">
            <div class="item">
                <label style="width: 115px;">身份证正面</label>
                <span style="float: right;">
                    <input type="file" name="" id = "file1" style="display: none;">
                    <a href="javascript:void(0);" onclick = "file1()"><img src="__WAP__/images/order/jigou.png" style="width: 110px;"></a>
                </span>
            </div>
             <div class="item">
                <label style="width: 115px;">身份证反面</label>
                <span style="float: right;">
                    <input type="file" name="" id = "file2" style="display: none;">
                    <a href="javascript:void(0);" onclick = "file2()"><img src="__WAP__/images/order/jigou.png" style="width: 110px;"></a>
                </span>
            </div>
        </div>
        <div class="btn">
            <button type="submit" class="button1">提交</button>
        </div>
        </form>
    </div>
</div>
</body>
<script src="__WAP__/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
    function file1()
    {
        $("#file1").click();
    }
    function file2()
    {
        $("#file2").click();
    }
</script>
</html>