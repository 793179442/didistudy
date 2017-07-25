<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <title>发布需求</title>
    <link rel="stylesheet" href="__WAP__/css/base.css">
    <link rel="stylesheet" href="__WAP__/css/swiper.min.css">
    <link rel="stylesheet" href="__WAP__/css/mui.picker.css">
    <link rel="stylesheet" href="__WAP__/css/style.css">
</head>
<body style="background-color: #f9f8fd;">
<div class = "container order-1">
    <!-- header -->
    <header class="header c1">
        <a href="javascript:void(0);" onclick = "history.go(-1);"><span class="top-left-back"></span></a>
        <span class="top-logo"><img src="__WAP__/images/logo1.png"></span>
    </header>
    <div class="header-height"></div>

    <!-- page -->
    <div class = "page">
        
        <div class="bar1">
            <div class="title">选择你需要的课程</div>
            <div class="mui"></div>
        </div>
        <div class="bar2">
            <div class="item">优选附近</div>
            <div class="item">一对一</div>
            <div class="item">环境好</div>
            <div class="item">体验课</div>
            <div class="item">上门</div>
        </div>
        <div class="bar3">
            <div class="t1">
                <textarea placeholder="备注：" class="white-style remark"></textarea>
            </div>
            <div class="t2">
                <span class="t1 white-style"><i class="blue"></i>新城市广场 <span class="icon-fot-more"></span></span>
                <span class="t2 white-style">今天 13:30 <span class="icon-fot-more"></span></span>
            </div>
            <div class="t3">
                <div><button data-url="<?php echo U('Wap/Student/publicdemand');?>" type="" class = "button">确认发布</button></div>
                <div class="t">成功发布后在首页展示</div>
            </div>
        </div>


        <div class="bar4">
            <div class="item">
                <div class="title">附近热门分类</div>
                <div class="content">
                    <a href="#">书法初级</a>
                    <a href="#">跆拳道</a>
                    <a href="#">雅思留学</a>
                    <a href="#">高三冲刺</a>
                    <a href="#">钢琴辅导</a>
                    <a href="#">烹饪培训</a>
                </div>
            </div>
            <div class="item">
                <div class="title">课内辅导<span class="icon-fot-more"></span></div>
                <div class="content"></div>
            </div>

            <div class="item">
                <div class="title">艺术培训<span class="icon-fot-more"></span></div>
                <div class="content"></div>
            </div>
            <div class="item">
                <div class="title">口语教育<span class="icon-fot-more"></span></div>
                <div class="content"></div>
            </div>

        </div>
       
    </div>
</div>
</body>
<script src="__WAP__/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
    
</script>


<script src="__WAP__/js/mui.min.js"></script>
<script src="__WAP__/js/mui.picker.min.js"></script>
<script src="__WAP__/js/data.city.js"></script>


<script src="__WAP__/js/layer.js"></script>
<script>
$('.item').click(function(){
    var key_con=$(this).html();
    $('.t1 textarea').val(key_con);

});
$('.button').click(function(){
    var url=$(this).data("url");
    var remark=$('.remark').val();
    // var radio=$('input[name="key"]:checked').val();
    // var username=$('.username').val();
    // //预约现在
    // if($("#judge").hasClass("active")){
    //     var status=1;
    // }else{
    //     var status=2;
    // }
    
    var se1=$('.mui-picker').eq(0).find('.highlight').html();
    var se2=$('.mui-picker').eq(1).find('.highlight').html();
    var se3=$('.mui-picker').eq(2).find('.highlight').html();
    // var se0=$('.typecourse').data('id');
    var se=se1+','+se2+','+se3;
  
                $.ajax({
                    url: url,
                    async: true,
                    type: 'post',
                    data: {remark:remark,se:se},
                    dataType: 'json',
                    contentType: "application/x-www-form-urlencoded; charset=utf-8",
                    success: function (data, status) {
                        if (data.status == 1) {
                            layer.open({content: data.info, time: 2,
                                end: function () {
                                    window.location.href = data.url;
                                }});
                        }else if(data.status==3){
                            layer.open({content: data.info, time: 2,
                                end: function () {
                                    window.location.href = data.url;
                                }});
                        }
                         else {
                            layer.open({content: data.info, time: 2});
                            $('.senddata').attr('disabled', false);
                        }
                    }
                });    
    
});
///
///
    var city_picker = new mui.PopPicker({layer:3});
    city_picker.setData(init_city_picker);
</script>



</html>