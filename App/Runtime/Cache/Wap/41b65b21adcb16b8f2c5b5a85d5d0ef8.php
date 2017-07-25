<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <title>我的课程列表</title>
    <link rel="stylesheet" href="__WAP__/css/base.css">
    <link rel="stylesheet" href="__WAP__/css/style.css">
</head>
<body style="background-color: #faf9fe;">
<div class = "container teacher-2">
    <!-- header -->
    <header class="header b1">
        <a href="javascript:void(0);" onclick = "history.go(-1);"><span class="top-left-back"></span></a>
        <span class="top-text">我的课程</span>
    </header>
    <div class="header-height"></div>
    <!-- 隐藏栏 -->
    <div class="left-hide-column-bg"></div>
    <div class="left-hide-column ">
        <div class="bar1">
            <a href="user_1.html">
                <img src="__WAP__/images/student/user.png">
                <span>花花@</span>
                <span class="icon-right-more"></span>
            </a>
        </div>
        <div class="bar2">
            <a href="user_2.html"><span>订单 | 任务</span></a>
            <a href="user_3.html"><span>钱包</span></a>
            <a href="user_4.html"><span>入驻</span></a>
            <a href="user_5.html"><span>推荐</span></a>
        </div>
        <div class="bar3">
            <a href="user_6.html"><span>收藏</span></a>
            <a href="user_7.html"><span>消息</span></a>
            <a href="user_9.html"><span>设置</span></a>
        </div>
    </div>


    

    <!-- page -->
    <div class = "page">
        <div class="title">已发布的课程</div>
        <div class="content">
        <?php if(is_array($CourseData)): $i = 0; $__LIST__ = $CourseData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$so): $mod = ($i % 2 );++$i;?><div class="item">
                <div class="bar1">
                    <div class="img">
                        <img src="__WAP__/images/maple.png">
                    </div>
                    <div class="c">
                        <div class="t1"><?php echo ($so["course_name"]); ?>16课</div>
                        <div class="t2">¥<?php echo ($so["course_price"]); ?>/<?php echo ($so["unit"]); ?></div>
                        <div class="t3">
                            <span>销量 0</span>
                            <span>咨询 0</span>
                            <span>浏览 4</span>
                        </div>
                    </div>
                </div>
                <div class="bar2">
                    <a href="order_4.html"><i class="icon-yulan"></i>预览</a>
                    <a href="#"><i class="icon-fenxian"></i>分享</a>
                </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
 <!--            <div class="item">
                <div class="bar1">
                    <div class="img">
                        <img src="__WAP__/images/maple.png">
                    </div>
                    <div class="c">
                        <div class="t1">初中数学辅导补习16课</div>
                        <div class="t2">¥188.00/次</div>
                        <div class="t3">
                            <span>销量 0</span>
                            <span>咨询 0</span>
                            <span>浏览 4</span>
                        </div>
                    </div>
                </div>
                <div class="bar2">
                    <a href="order_4.html"><i class="icon-yulan"></i>预览</a>
                    <a href="#"><i class="icon-fenxian"></i>分享</a>
                </div>
            </div>
            <div class="item">
                <div class="bar1">
                    <div class="img">
                        <img src="__WAP__/images/maple.png">
                    </div>
                    <div class="c">
                        <div class="t1">初中数学辅导补习16课</div>
                        <div class="t2">¥188.00/次</div>
                        <div class="t3">
                            <span>销量 0</span>
                            <span>咨询 0</span>
                            <span>浏览 4</span>
                        </div>
                    </div>
                </div>
                <div class="bar2">
                    <a href="order_4.html"><i class="icon-yulan"></i>预览</a>
                    <a href="#"><i class="icon-fenxian"></i>分享</a>
                </div>
            </div>
            <div class="item">
                <div class="bar1">
                    <div class="img">
                        <img src="__WAP__/images/maple.png">
                    </div>
                    <div class="c">
                        <div class="t1">初中数学辅导补习16课</div>
                        <div class="t2">¥188.00/次</div>
                        <div class="t3">
                            <span>销量 0</span>
                            <span>咨询 0</span>
                            <span>浏览 4</span>
                        </div>
                    </div>
                </div>
                <div class="bar2">
                    <a href="order_4.html"><i class="icon-yulan"></i>预览</a>
                    <a href="#"><i class="icon-fenxian"></i>分享</a>
                </div>
            </div>
            <div class="item">
                <div class="bar1">
                    <div class="img">
                        <img src="__WAP__/images/maple.png">
                    </div>
                    <div class="c">
                        <div class="t1">初中数学辅导补习16课</div>
                        <div class="t2">¥188.00/次</div>
                        <div class="t3">
                            <span>销量 0</span>
                            <span>咨询 0</span>
                            <span>浏览 4</span>
                        </div>
                    </div>
                </div>
                <div class="bar2">
                    <a href="order_4.html"><i class="icon-yulan"></i>预览</a>
                    <a href="#"><i class="icon-fenxian"></i>分享</a>
                </div>
            </div>
            <div class="item">
                <div class="bar1">
                    <div class="img">
                        <img src="__WAP__/images/maple.png">
                    </div>
                    <div class="c">
                        <div class="t1">初中数学辅导补习16课</div>
                        <div class="t2">¥188.00/次</div>
                        <div class="t3">
                            <span>销量 0</span>
                            <span>咨询 0</span>
                            <span>浏览 4</span>
                        </div>
                    </div>
                </div>
                <div class="bar2">
                    <a href="order_4.html"><i class="icon-yulan"></i>预览</a>
                    <a href="#"><i class="icon-fenxian"></i>分享</a>
                </div>
            </div> -->
            <div class="fot">
                <div><a href="<?php echo U('Wap/Teacher/teacher_5');?>" class="button1">发布新课程</a></div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="__WAP__/js/jquery-3.1.1.min.js"></script>
<script src="__WAP__/js/base.js"></script>
</html>