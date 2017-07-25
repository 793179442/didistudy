<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <title>添学 - 注册</title>
    <link rel="stylesheet" href="__WAP__/css/base.css">
    <link rel="stylesheet" href="__WAP__/css/style.css">
</head>
<style type="text/css">
    .footer
    {
    background-color: #2fa7fe;
    text-align: center;
    position: fixed;
    width: 100%;
    bottom: 0;
    left:0;
    }
    .footer div 
    {
        padding: 10px;
        color:#fff;
    }
    .footer  div a
    {
        padding: 10px;
        color:#fff;
    }
</style>
<body style="background-color: #faf9fe;">
<div class = "container login">
    <!-- page -->
    <div class = "page">
        <div class="top">
            <img src="__WAP__/images//top.png">
        </div>
        <div>   
            
                <div class="bar1">
                    <img src= "__WAP__/images/logo.png">
                </div>
                <div class="bar2">
                    <div><input type="text" name="" placeholder="登录名/手机号码" class="t1 name"></div>
                    <div><input type="password" name="" placeholder="请输入注册密码" class="t2 pwd"></div>
                </div>
                <div class="bar3">
                    <button type="submit">注册</button>
                </div>
     
        </div>
    </div>
    <footer class = "footer">
        <div>
        <a href="#">培训机构/老师&nbsp;&nbsp;&nbsp;&nbsp;专用入口</a>
        </div>
    </footer>
</div>
</body>
<script src="__WAP__/js/jquery-3.1.1.min.js"></script>
<script src="__WAP__/js/layer.js"></script>
<script>
$(".bar3").click(function(){
            var name=$(".name").val();
            var pwd=$(".pwd").val();
                 $.ajax({
                    url:"<?php echo U('Wap/Index/ajaxregisterd');?>",
                    async: true,
                    type: 'post',
                    data: {name:name,pwd:pwd},
                    dataType: 'json',
                    contentType: "application/x-www-form-urlencoded; charset=utf-8",
                    success: function (data, status) {
                        if (data.status == 1) {
                            layer.open({content: data.info, time: 2,end:function(){
                                window.location.href=data.url;
                            }});                                
                        } else {
                            layer.open({content: data.info, time: 2,end:function(){
                                
                            }});
                           // _this.attr('disabled', false);
                        }
                    }
                });        
});
</script>
</html>