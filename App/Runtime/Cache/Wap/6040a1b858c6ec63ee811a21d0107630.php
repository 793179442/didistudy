<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <title>机构认证</title>
    <link rel="stylesheet" href="__WAP__/css/base.css">
    <link rel="stylesheet" href="__WAP__/css/style.css">
</head>
<body style="background-color: #f4f3f8;">
<div class = "container login-1">
    <!-- header -->
    <header class="header b1">
        <a href="javascript:void(0);" onclick = "history.go(-1);"><span class="top-left-back"></span></a>
        <span class="top-text">完善认证信息</span>
        <a href="#"><span class="top-more1"></span></a>
    </header>
    <div class="header-height"></div>
    
    <div class="hide">
        <header class="header b1">
        <a href="javascript:void(0);" onclick = "hide()"><span class="top-left-back"></span></a>
        <span class="top-text">选择资质认证</span>
        <a href="#"><span class="top-more1"></span></a>
        </header>
        <div class="header-height"></div>
        <div class="page">
            <div class="search">
                <div class="">
                    <span class="icon-search"></span>
                    <input type="text" name="" placeholder="搜索证书类型" >
                </div>
            </div>
            <div class="content" id = "zizhi">
                <div><a href="#">营业执照</a></div>
                <div><a href="#">组织机构代码证</a></div>
                <div><a href="#">税务登记证</a></div>
                <div><a href="#">教师证</a></div>
                <div><a href="#">技能资质证</a></div>
                <div><a href="#">育婴师职业资质证书</a></div>
            </div>
        </div>
    </div>



    <!-- page -->
    <div class = "page">  
        <form action="#" method="post">
        <div class="title">证件类型</div>
        <div class="bar">
            <div class="item">
                <label>类型</label>
                <span id = "select">营业执照</span>
            </div>
        </div>
        <div class="title">证件类型</div>
        <div class="bar">
            <div class="item">
                <label>证件号</label>
                <span><input type="text" name="" placeholder="输入证书编号，无则留空"></span>
            </div>
            <div class="item">
                <label style="width: 115px;">证件扫描件/照片</label>
                <span style="float: right;">
                    <input type="file" name="" id = "file" style="display: none;">
                    <a href="javascript:void(0);" onclick = "file()"><img src="__WAP__/images/order/jigou.png" style="width: 110px;"></a>
                </span>
            </div>
        </div>
        <div class="title">备注(选填)</div>
        <div class="bar">
            <div class="item">
                <textarea placeholder="输入具体描述帮助客服快速处理"></textarea>
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
    function file()
    {
        $("#file").click();
    }
    function hide()
    {
        $(".hide").toggle();
    }
    $("#select").on("click",function(){
        $(".hide").toggle();
    });



    $("#zizhi a").on("click",function(){
        var t = $(this).html();
        $("#select").html(t);
        $(".hide").toggle();
    });
</script>
</html>