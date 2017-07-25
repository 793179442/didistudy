<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <title>发布新课程</title>
    <link rel="stylesheet" href="__WAP__/css/base.css">
    <link rel="stylesheet" href="__WAP__/css/style.css">
</head>
<body style="background-color: #faf9fe;">
<div class = "container teacher-3">
    <!-- header -->
    <header class="header b1">
        <a href="javascript:void(0);" onclick = "history.go(-1);"><span class="top-left-back"></span></a>
        <span class="top-text">发布新课程</span>

         <input  name="rq_img" id="rq_img" type="file" class="form-control" style="display: none;" />
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
        <form id="ssssssss" action="#" method="post">
        <div class="title">课程名称</div>
        <div class="bar1">
            <div class="t1">
                <span class="l">
                    <input type="text" name="course_name" placeholder="输入课程名称">
                </span>
                <span class="r">0/10</span>
            </div>
            <div class="t2">
                <span class="l">
                    <input type="text" name="feature" placeholder="一句话简介，写下课程特色或概要">
                </span>
                <span class="r">0/20</span>
            </div>
             <div class="t3">
                <textarea name="course_remark" placeholder="输入课程介绍，获取更多的曝光和精准顾客"></textarea>
            </div>
        </div>






        <div class="bar2">
            <input type="file" name="" id  = "file" style="display: none;"> 
                    <input type="hidden" name="course_img" class="fefef">
            <a href="javascript:void(0)" onclick="file()">
                <img class="sfef" src="__WAP__/images/teacher/tian.png">
            </a>
        </div>
    
        <div class="title">设置课程价格</div>
        <div class="bar3">
            <div class="item">
                <label>类别</label>
                <span><input type="text" name="course_type" placeholder="选择课程所属类别"></span>
            </div>
             <div class="item">
                <label>价格</label>
                <span><input type="text" name="course_price" placeholder="输入价格"></span>
            </div>
             <div class="item">
                <label>单位</label>
                <span><input type="text" name="unit" placeholder="输入计费单位，如小时，次"></span>
            </div>
        </div>

        <div class="bar4">
            <a href="#"><span>+</span>添加服务类型</a>
        </div>

        <div class="title">设置服务条件</div>
        <div class="bar5">
            <div class="item">
                <label>服务方式</label>
                <span class="r">请选择服务方式 ></span>
            </div>
            <div class="item">
                <label>服务时间</label>
                <span class="r">请选择服务起止时间 ></span>
            </div>
        </div>
    </form>
        <div class="fot">
            <div><button data-url="<?php echo U('Wap/Teacher/ajaxaddteachercourse');?>" type="submit" class="button1">发布</button></div>
        </div>

       
    </div>
</div>
</body>
<script src="Public/Admin/js/jquery-1.8.3.min.js"></script>
<script src="Public/Admin/js/ajaxfileupload.js"></script>
<script src="__WAP__/js/base.js"></script>
<script src="Public/Admin/plugins/layer/layer.js"></script>
<script type="text/javascript">
$(function(){

    $('input[name="rq_img"]').live('change', function () {
            uploadImg();
    });
        //上传图片
        function uploadImg() {

            $.ajaxFileUpload({
                url: "<?php echo U('Wap/Teacher/ajaxUploadcousrseImg');?>",
                type: 'post',
                fileElementId: 'rq_img',
                secureuri: false,
                dataType: 'json',
                success: function (data, status) {
                    if (data.status == 1) {
                        $('.fefef').val(data.img_src);
                        $('.sfef').attr('src',data.tmp_dir);
                        // layer.alert(data.img_src);
                        // alert(1);
                    } else if (data.status == 0) {
                        layer.alert(data.info, {icon: 2});
                    }
                }
            });
           // alert(1);
        }
        $('.button1').click(function () {
            var _this = $(this);
            _this.attr('disabled', true);
            var data = $('#ssssssss').serialize();

            var url = _this.data('url');

            $.ajax({
                url: url,
                async: true,
                type: 'post',
                data: data,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=utf-8",
                success: function (data, status) {
                    if (data.status == 1) {
                        layer.alert(data.info, {icon: 1, time: 2000,
                            end: function () {
                                window.location.href = data.url;
                            }, cancel: function () {
                                window.location.href = data.url;
                            }});
                    } else {
                        layer.alert(data.info, {icon: 2, time: 2000});
                        _this.attr('disabled', false);
                    }
                }
            });
        });
});
    function file(){
        $("#rq_img").click();
    };
</script>
</html>