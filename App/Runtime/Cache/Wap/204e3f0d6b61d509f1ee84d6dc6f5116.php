<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <title>用户 - 订单和任务</title>
    <link rel="stylesheet" href="__WAP__/css/base.css">
    <link rel="stylesheet" href="__WAP__/css/swiper.min.css">
    <link rel="stylesheet" href="__WAP__/css/style.css">
</head>
<body >
<div class = "container user-2">
    <!-- header -->
    <header class="header b2">
        <a href="javascript:void(0);" onclick = "history.go(-1);"><span class="top-left-back"></span></a>
        <span class="top-text">订单和任务</span>
    </header>
    <div class="header-height"></div>

    <!-- page -->
    <div class = "page">
        <div class="menu">
            <div id="i1"><span class="active">订单</span></div>
            <div id="i2"><span>任务</span></div>
        </div>
        <div class="title"><span>历史提交</span></div>
        <div class="content i1" >
            <?php if(is_array($order)): $i = 0; $__LIST__ = $order;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$k): $mod = ($i % 2 );++$i;?><div class="item">
            <?php switch($k['status']): case "未付款": ?><a href="<?php echo U('Wap/Bill/bill_1',array('order_id'=>$k['order_id']));?>"><?php break;?>
                <?php case "已付款": ?><a href="<?php echo U('Wap/Bill/bill_2',array('order_id'=>$k['order_id']));?>"><?php break;?>
                <?php default: ?><a href="<?php echo U('Wap/Bill/bill_1',array('order_id'=>$k['order_id']));?>"><?php endswitch;?>
                
                    <div>
                        <span class="t1"><?php echo ($k["course_name"]); ?></span>
                        <span class="t2 c1"><?php echo ($k["status"]); ?></span>
                    </div>
                    <div>
                        <span class="t3"><?php echo (date("m月d日 H:i",$k["date"])); ?></span>
                        <span class="t4"><span class="icon-more"></span></span>
                    </div>
                </a>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
 <!--            <div class="item">
                <a href="bill_1.html">
                    <div>
                        <span class="t1">获得可推荐课程</span>
                        <span class="t2 c2">已付款</span>
                    </div>
                    <div>
                        <span class="t3">5月1号 20:26</span>
                        <span class="t4"><span class="icon-more"></span></span>
                    </div>
                </a>
            </div>
            <div class="item">
                <a href="bill_1.html">
                    <div>
                        <span class="t1">完成了学习订单</span>
                        <span class="t2 c3">已完成</span>
                    </div>
                    <div>
                        <span class="t3">5月1号 20:26</span>
                        <span class="t4"><span class="icon-more"></span></span>
                    </div>
                </a>
            </div>
            <div class="item">
                <a href="bill_1.html">
                    <div>
                        <span class="t1">取消了学习订单</span>
                        <span class="t2">已取消</span>
                    </div>
                    <div>
                        <span class="t3">5月1号 20:26</span>
                        <span class="t4"><span class="icon-more"></span></span>
                    </div>
                </a>
            </div> -->
            <div class="fot">
                <div> <img  src="__WAP__/images/tian.png"></div>
                <span>发布新的学习订单</span>
            </div>
        </div>
        <div class="content i2" >
            <div class="item">
                <a href="#">
                    <div>
                        <span class="t1">推荐了学习课程</span>
                        <span class="t2 c1">未付款</span>
                    </div>
                    <div>
                        <span class="t3">5月1号 20:26</span>
                        <span class="t4"><span class="icon-more"></span></span>
                    </div>
                </a>
            </div>
            <div class="item">
                <a href="#">
                    <div>
                        <span class="t1">获得了学习任务</span>
                        <span class="t2 c2">已付款</span>
                    </div>
                    <div>
                        <span class="t3">5月1号 20:26</span>
                        <span class="t4"><span class="icon-more"></span></span>
                    </div>
                </a>
            </div>
            <div class="item">
                <a href="#">
                    <div>
                        <span class="t1">完成了学习任务</span>
                        <span class="t2 c3">已完成</span>
                    </div>
                    <div>
                        <span class="t3">5月1号 20:26</span>
                        <span class="t4"><span class="icon-more"></span></span>
                    </div>
                </a>
            </div>
            <div class="item">
                <a href="#">
                    <div>
                        <span class="t1">取消了学习任务</span>
                        <span class="t2">已取消</span>
                    </div>
                    <div>
                        <span class="t3">5月1号 20:26</span>
                        <span class="t4"><span class="icon-more"></span></span>
                    </div>
                </a>
            </div>

            <div class="fot">
                <div> <img  src="__WAP__/images/tian.png"></div>
                <span>承接新的学习任务</span>
            </div>
        </div>


    </div>
</div>
</body>
<script src="__WAP__/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
$('.fot img').click(function(){

    window.location.href="<?php echo U('Wap/Teacher/teacher_2');?>";
});
    $(".menu div").on('click', function() {
        $(".menu div span").removeClass("active");
        $(this).find("span").addClass("active");
        $(".content").hide();
        var id = $(this).attr("id");
        $("."+id).show();
    });
</script>
</html>