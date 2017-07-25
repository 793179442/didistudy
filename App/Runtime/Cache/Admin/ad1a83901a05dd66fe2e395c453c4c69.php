<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <title><?php echo ($by_p_title); ?></title>
    <!-- Mobile specific metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Force IE9 to render in normal mode -->
    <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
    <meta name="author" content="SuggeElson">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="application-name" content="sprFlat admin template" />
    <!-- Import google fonts - Heading first/ text second -->
    <link rel='stylesheet' type='text/css'>
    <!--[if lt IE 9]>

<![endif]-->
    <!-- Css files -->
    <!-- Icons -->
    <link href="__ADMIN__/css/icons.css" rel="stylesheet" />
    <!-- jQueryUI -->
    <link href="__ADMIN__/css/sprflat-theme/jquery.ui.all.css" rel="stylesheet" />
    <!-- Bootstrap stylesheets (included template modifications) -->
    <link href="__ADMIN__/css/bootstrap.css" rel="stylesheet" />
    <!-- Plugins stylesheets (all plugin custom css) -->
    <link href="__ADMIN__/css/plugins.css" rel="stylesheet" />
    <!-- Main stylesheets (template main css file) -->
    <link href="__ADMIN__/css/main.css" rel="stylesheet" />
    <!-- Custom stylesheets ( Put your own changes here ) -->
    <link href="__ADMIN__/css/custom.css" rel="stylesheet" />
    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="__ADMIN__/img/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="__ADMIN__/img/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="__ADMIN__/img/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="__ADMIN__/img/ico/apple-touch-icon-57-precomposed.png">
    <link rel="icon" href="__ADMIN__/img/ico/favicon.ico" type="image/png">
    <!-- Windows8 touch icon ( http://www.buildmypinnedsite.com/ )-->
    <meta name="msapplication-TileColor" content="#3399cc" />
</head>
    <body>
    <!-- Start #header -->
<div id="header">
    <div class="container-fluid">
        <div class="navbar">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo U('Admin/Index/index');?>">
                    <i class="im-windows8 text-logo-element animated bounceIn"></i><span class="text-logo">滴滴后台管理</span><span class="text-slogan">系统</span> 
                </a>
            </div>
            <nav class="top-nav" role="navigation">
                <ul class="nav navbar-nav pull-left">
                    <li id="toggle-sidebar-li">
                        <a href="javascript:void(0);" id="toggle-sidebar"><i class="en-arrow-left2"></i>
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav pull-right">
                    <li class="dropdown">
                        <a href="javascript:void(0);" data-toggle="dropdown">管理员：<?php echo (session('by_p_admin_name')); ?></a>
                        <ul class="dropdown-menu right" role="menu">
                            <li><a href="profile.html"><i class="st-user"></i> 修改密码</a></li>
                            <li><a href="javascript:void(0);"><i class="st-settings"></i> 设置</a></li>  
                            <li><a href="<?php echo U('Admin/Index/logout');?>"><i class="im-exit"></i> 退出</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- Start .header-inner -->
</div>
<!-- End #header -->
    <!-- Start #sidebar -->
<div id="sidebar">
    <!-- Start .sidebar-inner -->
    <div class="sidebar-inner">
        <!-- Start #sideNav -->
        <ul id="sideNav" class="nav nav-pills nav-stacked">
            <?php if(is_array($menu_info_list)): $i = 0; $__LIST__ = $menu_info_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li>
                    <?php if(($menu["sub_menu_num"]) > "0"): ?><a href="javascript:void(0);"> <?php echo ($menu["mi_menu_name"]); ?> <i class="<?php echo ($menu["mi_icon"]); ?>"></i></a>
                    <ul class="nav sub">
                        <?php if(is_array($menu["sub_menu"])): $i = 0; $__LIST__ = $menu["sub_menu"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub_menu): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($sub_menu["url"]); ?>"><i class="<?php echo ($sub_menu["mi_icon"]); ?>"></i> <?php echo ($sub_menu["mi_menu_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                    <?php else: ?>
                    <a href="<?php echo ($menu["url"]); ?>"> <?php echo ($menu["mi_menu_name"]); ?> <i class="<?php echo ($menu["mi_icon"]); ?>"></i></a><?php endif; ?>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <!-- End #sideNav -->
    </div>
    <!-- End .sidebar-inner -->
</div>
<!-- End #sidebar -->
    <!-- Start #content -->
    <div id="content">
        <div class="row">
            <div class="col-xs-12">
                <div class='form-group'></div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="ec-list"></i> <?php if($residential_quarters['rq_id']): ?>编辑轮播图信息<?php else: ?>添加轮播图<?php endif; ?></h3>
                    </div>
                    <div class="panel-body ">
                        <form method="post" id="residential_quarters_form" action="">
                            <table class="table table-bordered">
                                <tbody>
   
                                   
                                    <tr>
                                        <td class=" col-xs-2">图片：</td>
                                        <td>
                                            <div class="input-group col-xs-6">
                                                <span class="input-group-addon rq_img" style="cursor: pointer;">选择图片</span>
                                                <input name="p_rq_picture" type="text" class="form-control" readonly value="<?php echo ($residential_quarters["rq_picture"]); ?>" />
                                                <input name="rq_img" id="rq_img" type="file" class="form-control" style="display: none;" />
                                            </div>
                                        </td>
                                    </tr>
                                 <tr>
                                        <td width="12%">排序：</td>
                                        <td width="88%">
                                            <div class="input-group col-xs-6">
                                                <input type="text" class="form-control" name="img_sort" value="<?php echo ($img_data["img_sort"]); ?>" maxlength="32" />
                                            </div>
                                        </td>
                                    </tr>
                                   
                                    <tr>
                                        <td>跳转路径：</td>
                                        <td>
                                            <div class="input-group col-xs-12">
                                                <input value="<?php echo ($img_data["img_url"]); ?>" type="text"  name="img_url" class="form-control" style="resize: none;"></input>
                                                <input type="hidden" name='img_id' value="<?php echo ($img_data["img_id"]); ?>">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form-inline form-group text-center">
                                <?php if($img_data['img_id']): ?><input type="hidden" name="rq_id" value="<?php echo ($residential_quarters["rq_id"]); ?>" />
                                    <input type="button" class="btn btn-info residential_quarters" value="编辑" data-url="<?php echo U('Admin/ImgShow/ajaxEditImg');?>" />
                                    <?php else: ?>
                                    <input type="button" class="btn btn-info residential_quarters" value="添加" data-url="<?php echo U('Admin/ImgShow/ajaxAddImg');?>" /><?php endif; ?>
                                <input type='reset' class="btn btn-info" value='重置' />
                                <a href="javascript:history.go(-1);" class="btn btn-info">返回</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End .content-wrapper -->
        <div class="clearfix"></div>
    </div>
    <!-- End #content -->
    <!-- Javascripts -->
<!-- Load pace first -->
<script src="__ADMIN__/plugins/core/pace/pace.min.js"></script>
<!-- Important javascript libs(put in all pages) -->
<script src="__ADMIN__/js/jquery-1.8.3.min.js"></script>
<script>
    window.jQuery || document.write('<script src="__ADMIN__/js/libs/jquery-2.1.1.min.js">\x3C/script>')
</script>
<script src="__ADMIN__/js/jquery-ui.js"></script>
<script>
    window.jQuery || document.write('<script src="__ADMIN__/js/libs/jquery-ui-1.10.4.min.js">\x3C/script>')
</script>
<!--[if lt IE 9]>
<script type="text/javascript" src="__ADMIN__/js/libs/excanvas.min.js"></script>
<script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<script type="text/javascript" src="__ADMIN__/js/libs/respond.min.js"></script>
<![endif]-->
<!-- Bootstrap plugins -->
<script src="__ADMIN__/js/bootstrap/bootstrap.js"></script>
<!-- Core plugins ( not remove ever) -->
<!-- Handle responsive view functions -->
<script src="__ADMIN__/js/jRespond.min.js"></script>
<!-- Custom scroll for sidebars,tables and etc. -->
<script src="__ADMIN__/plugins/core/slimscroll/jquery.slimscroll.min.js"></script>
<script src="__ADMIN__/plugins/core/slimscroll/jquery.slimscroll.horizontal.min.js"></script>
<!-- Resize text area in most pages -->
<script src="__ADMIN__/plugins/forms/autosize/jquery.autosize.js"></script>
<!-- Proivde quick search for many widgets -->
<script src="__ADMIN__/plugins/core/quicksearch/jquery.quicksearch.js"></script>
<!-- Bootbox confirm dialog for reset postion on panels -->
<script src="__ADMIN__/plugins/ui/bootbox/bootbox.js"></script>
<!-- Other plugins ( load only nessesary plugins for every page) -->
<!--<script src="__ADMIN__/plugins/charts/flot/jquery.flot.js"></script>
<script src="__ADMIN__/plugins/charts/flot/jquery.flot.pie.js"></script>
<script src="__ADMIN__/plugins/charts/flot/jquery.flot.resize.js"></script>
<script src="__ADMIN__/plugins/charts/flot/jquery.flot.time.js"></script>
<script src="__ADMIN__/plugins/charts/flot/jquery.flot.growraf.js"></script>
<script src="__ADMIN__/plugins/charts/flot/jquery.flot.categories.js"></script>
<script src="__ADMIN__/plugins/charts/flot/jquery.flot.stack.js"></script>
<script src="__ADMIN__/plugins/charts/flot/jquery.flot.tooltip.min.js"></script>
<script src="__ADMIN__/plugins/charts/flot/date.js"></script>
<script src="__ADMIN__/plugins/charts/sparklines/jquery.sparkline.js"></script>
<script src="__ADMIN__/plugins/charts/pie-chart/jquery.easy-pie-chart.js"></script>
<script src="__ADMIN__/plugins/forms/icheck/jquery.icheck.js"></script>
<script src="__ADMIN__/plugins/forms/tags/jquery.tagsinput.min.js"></script>
<script src="__ADMIN__/plugins/forms/tinymce/tinymce.min.js"></script>-->
<script src="__ADMIN__/plugins/misc/highlight/highlight.pack.js"></script>
<script src="__ADMIN__/plugins/misc/countTo/jquery.countTo.js"></script>
<script src="__ADMIN__/plugins/ui/weather/skyicons.js"></script>
<script src="__ADMIN__/plugins/ui/notify/jquery.gritter.js"></script>
<script src="__ADMIN__/plugins/ui/calendar/fullcalendar.js"></script>
<script src="__ADMIN__/js/jquery.sprFlat.js"></script>
<script src="__ADMIN__/js/app.js"></script>
<script src="__ADMIN__/js/pages/dashboard.js"></script>
<script src="__ADMIN__/js/page_js.js"></script>
<script src="__ADMIN__/plugins/layer/layer.js"></script>
    <script src="__ADMIN__/js/ajaxfileupload.js"></script>
    <script>

        $('select[name="p_par_ins"]').change(function () {
            var _this = $(this);

            var ins_id = _this.val();

            var ins_this = $('select[name="p_instituition_id"]');
            ins_this.empty();
            ins_this.attr('disabled', true);
            ins_this.append('<option value="0">--二级机构--</option>');

            $.ajax({
                url: '<?php echo U("Admin/ResidentialQuarters/ajaxGetInstituition");?>',
                async: true,
                type: 'get',
                data: {ins_id: ins_id},
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=utf-8",
                success: function (data, status) {
                    if (data.status == 1) {
                        var ins_list = data.data;
                        for (var i = 0; i < ins_list.length; i++) {
                            ins_this.append('<option value="' + ins_list[i].ins_id + '">' + ins_list[i].instituition_name + '</option>');
                        }
                        ins_this.attr('disabled', false);
                    }
                }
            });
        });

        $('.rq_img').click(function () {
            $('input[name="rq_img"]').click();
        });

        $('input[name="rq_img"]').live('change', function () {
            uploadImg();
        });

        //上传图片
        function uploadImg() {
            $.ajaxFileUpload({
                url: "<?php echo U('Admin/ImgShow/ajaxUploadImg');?>",
                type: 'post',
                fileElementId: 'rq_img',
                secureuri: false,
                dataType: 'json',
                success: function (data, status) {
                    if (data.status == 1) {
                        $('input[name="p_rq_picture"]').val(data.img_src);
                    } else if (data.status == 0) {
                        layer.alert(data.info, {icon: 2});
                    }
                }
            });
        }

        $('.residential_quarters').click(function () {
            var _this = $(this);
            _this.attr('disabled', true);

            //小区名称
            var p_residential_quarters = $('input[name="p_residential_quarters"]');
            var p_residential_quarters_val = $.trim(p_residential_quarters.val());
            // if (p_residential_quarters_val.length == 0) {
            //     layer.alert('请输入小区名称', {icon: 2, time: 2000,
            //         end: function () {
            //             p_residential_quarters.focus();
            //             p_residential_quarters.select();
            //             _this.attr('disabled', false);
            //         }, cancel: function () {
            //             p_residential_quarters.focus();
            //             p_residential_quarters.select();
            //             _this.attr('disabled', false);
            //         }});
            //     return;
            // }

            //所属机构
            var p_instituition_id = $('select[name="p_instituition_id"]');
            var p_instituition_id_val = $.trim(p_instituition_id.val());
            // if (p_instituition_id_val == 0) {
            //     layer.alert('请选择所属机构', {icon: 2, time: 2000,
            //         end: function () {
            //             p_instituition_id.focus();
            //             p_instituition_id.select();
            //             _this.attr('disabled', false);
            //         }, cancel: function () {
            //             p_instituition_id.focus();
            //             p_instituition_id.select();
            //             _this.attr('disabled', false);
            //         }});
            //     return;
            // }

            var re = /^[1-9]\d*$/;
            var rep = /^[0-9]\d*\.\d*[0-9]\d*$/;

            //建筑面积
            var p_floor_area = $('input[name="p_floor_area"]');
            var p_floor_area_val = $.trim(p_floor_area.val());
            // if (p_floor_area_val.length != 0 && !(rep.test(p_floor_area_val) || re.test(p_floor_area_val))) {
            //     layer.alert('建筑面积有误', {icon: 2, time: 2000,
            //         end: function () {
            //             p_floor_area.focus();
            //             p_floor_area.select();
            //             _this.attr('disabled', false);
            //         }, cancel: function () {
            //             p_floor_area.focus();
            //             p_floor_area.select();
            //             _this.attr('disabled', false);
            //         }});
            //     return;
            // }
            
            //占地面积
            var p_covers_area = $('input[name="p_covers_area"]');
            var p_covers_area_val = $.trim(p_covers_area.val());
            // if (p_covers_area_val.length != 0 && !(rep.test(p_covers_area_val) || re.test(p_covers_area_val))) {
            //     layer.alert('占地面积有误', {icon: 2, time: 2000,
            //         end: function () {
            //             p_covers_area.focus();
            //             p_covers_area.select();
            //             _this.attr('disabled', false);
            //         }, cancel: function () {
            //             p_covers_area.focus();
            //             p_covers_area.select();
            //             _this.attr('disabled', false);
            //         }});
            //     return;
            // }
            
            //小区总户数
            var p_total_household = $('input[name="p_total_household"]');
            var p_total_household_val = $.trim(p_total_household.val());
            // if (p_total_household_val.length != 0 && !(re.test(p_total_household_val))) {
            //     layer.alert('小区总户数有误', {icon: 2, time: 2000,
            //         end: function () {
            //             p_total_household.focus();
            //             p_total_household.select();
            //             _this.attr('disabled', false);
            //         }, cancel: function () {
            //             p_total_household.focus();
            //             p_total_household.select();
            //             _this.attr('disabled', false);
            //         }});
            //     return;
            // }
            
            //车位数量
            var p_parking_lot_number = $('input[name="p_parking_lot_number"]');
            var p_parking_lot_number_val = $.trim(p_parking_lot_number.val());
            // if (p_parking_lot_number_val.length != 0 && !(re.test(p_parking_lot_number_val))) {
            //     layer.alert('车位数量有误', {icon: 2, time: 2000,
            //         end: function () {
            //             p_parking_lot_number.focus();
            //             p_parking_lot_number.select();
            //             _this.attr('disabled', false);
            //         }, cancel: function () {
            //             p_parking_lot_number.focus();
            //             p_parking_lot_number.select();
            //             _this.attr('disabled', false);
            //         }});
            //     return;
            // }
            
            //绿化率
            var p_greening_rate = $('input[name="p_greening_rate"]');
            var p_greening_rate_val = $.trim(p_greening_rate.val());
            // if (p_greening_rate_val.length != 0 && !(rep.test(p_greening_rate_val) || re.test(p_greening_rate_val))) {
            //     layer.alert('绿化率有误', {icon: 2, time: 2000,
            //         end: function () {
            //             p_greening_rate.focus();
            //             p_greening_rate.select();
            //             _this.attr('disabled', false);
            //         }, cancel: function () {
            //             p_greening_rate.focus();
            //             p_greening_rate.select();
            //             _this.attr('disabled', false);
            //         }});
            //     return;
            // }
            
            //容积率
            var p_volume_rate = $('input[name="p_volume_rate"]');
            var p_volume_rate_val = $.trim(p_volume_rate.val());
            // if (p_volume_rate_val.length != 0 && !(rep.test(p_volume_rate_val) || re.test(p_volume_rate_val))) {
            //     layer.alert('容积率有误', {icon: 2, time: 2000,
            //         end: function () {
            //             p_volume_rate.focus();
            //             p_volume_rate.select();
            //             _this.attr('disabled', false);
            //         }, cancel: function () {
            //             p_volume_rate.focus();
            //             p_volume_rate.select();
            //             _this.attr('disabled', false);
            //         }});
            //     return;
            // }
            
            //楼栋数量
            var p_parking_lot_number = $('input[name="p_parking_lot_number"]');
            var p_parking_lot_number_val = $.trim(p_parking_lot_number.val());
            // if (p_parking_lot_number_val.length != 0 && !(re.test(p_parking_lot_number_val))) {
            //     layer.alert('楼栋数量有误', {icon: 2, time: 2000,
            //         end: function () {
            //             p_parking_lot_number.focus();
            //             p_parking_lot_number.select();
            //             _this.attr('disabled', false);
            //         }, cancel: function () {
            //             p_parking_lot_number.focus();
            //             p_parking_lot_number.select();
            //             _this.attr('disabled', false);
            //         }});
            //     return;
            // }


            var data = $('#residential_quarters_form').serialize();

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
    </script>

</body>
</html>