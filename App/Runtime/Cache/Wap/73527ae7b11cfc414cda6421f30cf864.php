<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <title>教师</title>
    <link rel="stylesheet" href="__WAP__/css/base.css">
    <link rel="stylesheet" href="__WAP__/css/style.css">
</head>
<body style="background-color: #faf9fe;">
<div class = "container teacher-1">
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
        <div class="menu">
            <div id="i1" class="active">订单</div>
            <div id="i2" >接单</div>
        </div>

        <div class="content i1">
            <div class="notice white-style">
                <span>李同学提交的艺术书法初级已获接单</span>
            </div>
            <div  class="bar1 white-style more">
                <?php if(is_array($demanddata)): $i = 0; $__LIST__ = $demanddata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="item ">
                    <a href="#">
                        <div class="img"><img src="__WAP__/images/order/didian.png"></div>
                        <div class="c">
                            <div class="t1"><?php echo ($vo["course_name"]); ?></div>
                            <div class="t2"> 需求已发布，等待老师回复。</div>
                        </div>
                    </a>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
  <!--               <div class="item ">
                    <a href="#">
                        <div class="img"><img src="__WAP__/images/order/didian.png"></div>
                        <div class="c">
                            <div class="t1">辅导小学语文</div>
                            <div class="t2"> 需求已发布，等待老师回复。</div>
                        </div>
                    </a>
                </div>
                <div class="item ">
                    <a href="#">
                        <div class="img"><img src="__WAP__/images/order/didian.png"></div>
                        <div class="c">
                            <div class="t1">辅导小学语文</div>
                            <div class="t2"> 需求已发布，等待老师回复。</div>
                        </div>
                    </a>
                </div>
                <div class="item ">
                    <a href="#">
                        <div class="img"><img src="__WAP__/images/order/didian.png"></div>
                        <div class="c">
                            <div class="t1">辅导小学语文</div>
                            <div class="t2"> 需求已发布，等待老师回复。</div>
                        </div>
                    </a>
                </div> -->
            </div>
            <div class="btn">
                <a href="javascript:void(0)" onclick = "add1();">加载更多<span class="icon-fot-more"></span></a>
            </div>

            <div class="fot">
                <div class="t1"></div>
                <div class="t2">
                    <a href="teacher_3.html">核销课程</a>
                    <a href="<?php echo U('Wap/Teacher/teacher_4');?>">管理设置</a>
                </div>
            </div>
        </div>

        <div class="content i2">

            <div class="bar2 white-style">
                <div class="t1">李同学提交的需求 <span>2017-1-18 16:42:17</span></div>
                <div class="t2"><i></i>辅导初二物理</div>
                <div class="t3">补充要求：一对一；优选珠江楼附近；环境好</div>
            </div>

            <div class="bar3 white-style">
                <div class="item">
                    <div class="img"><img src="__WAP__/images/order/didian.png"></div>
                    <div class="c">初二物理 16课时 一对一辅导<span><input type="checkbox" name=""></span></div>
                </div>
                <div class="item">
                    <div class="img"><img src="__WAP__/images/order/didian.png"></div>
                    <div class="c">初二物理 16课时 一对一辅导<span><input type="checkbox" name=""></span></div>
                </div>
                <div class="item">
                    <div class="img"><img src="__WAP__/images/order/didian.png"></div>
                    <div class="c">初二物理 16课时 一对一辅导<span><input type="checkbox" name=""></span></div>
                </div>
            </div>

            <div class="btn">
                <a href="javascript:void(0)" onclick = "add2();">加载更多<span class="icon-fot-more"></span></a>
            </div>

            <div class="bar4 white-style">
                <textarea placeholder="备注："></textarea>
            </div>

            <div class="fot">
                <div class="t1">
                    <a href="#">
                    <img src="__WAP__/images/tian.png">
                    <div>确认接单</div>
                    </a>
                </div>
                <div class="t2">
                    <a href="<?php echo U('Wap/Teacher/teacher_3');?>">课程管理</a>
                    <a href="<?php echo U('Wap/Teacher/teacher_4');?>">主页设置</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="__WAP__/js/jquery-3.1.1.min.js"></script>
<script src="__WAP__/js/base.js"></script>
<script type="text/javascript">
    $(".menu div").on('click', function() {
        $(".menu div").removeClass("active");
        $(this).addClass("active");
        $(".content").hide();
        var id = $(this).attr("id");
        $("."+id).show();
    });
    function add1()
    {
        var div = '<div class="item "><a href="#"><div class="img"><img src="__WAP__/images/order/didian.png"></div><div class="content"><div class="t1">辅导小学语文</div><div class="t2"> 需求已发布，等待老师回复。</div></div></a></div>';
        for(var i = 0;i<=3;i++)
        {
            $(".content.i1 .bar1").append(div);
        }
    }
    function add2()
    {
        var div = '<div class="item"><div class="img"><img src="__WAP__/images/order/didian.png"></div><div class="c">初二物理 16课时 一对一辅导<span><input type="checkbox" name=""></span></div></div>';
        for(var i = 0;i<=3;i++)
        {
            $(".content.i2 .bar3").append(div);
        }
    }
</script>
</html>