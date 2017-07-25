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
                        <h3 class="panel-title">
                            <i class="ec-list"></i>轮播图设置
                        </h3>
                    </div>
                    <div class="panel-body">
                        <nav class="navbar navbar-default">
                            <div class="collapse navbar-collapse">
                                <form class="navbar-form form-inline" action="" method="get">
                                    <input type="hidden" name="g" value="Admin" />
                                    <input type="hidden" name="m" value="ResidentialQuarters" />
                                    <input type="hidden" name="a" value="index" />


                                    <div class="form-group pull-right">
                                     
                                        <a href="<?php echo U('Admin/ImgShow/addImg');?>" class="btn btn-primary">添加图片</a>
<!--                                         <a href="javascript:void(0)" class="btn btn-danger pull-right del_rq del_all" style="margin-left: 2px;" data-url="<?php echo U('Admin/ResidentialQuarters/ajaxDelResidentialQuarters');?>"><i class="fa fa-trash-o"></i> 删除</a> -->
                                    </div>
                                </form>
                            </div>
                        </nav>
                        <div class="table-responsive">
                            <table  class="table table-bordered table-striped">
                                <thead>
                                    <tr role="row">
                                        <!-- <td width="5%" class="text-center"><input type="checkbox" id="checkAll" /></td> -->
                                        
                                        <td width="15%">图片</td>
                                        <td width="15%">排序</td>
                                        <td width="15%">操作</td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(empty($img_data)): ?><tr role="row" align="center"><td colspan="8">暂无数据</td></tr>
                                    <?php else: ?>
                                    <?php if(is_array($img_data)): $i = 0; $__LIST__ = $img_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$rq): $mod = ($i % 2 );++$i;?><tr role="row">
                                           <!--  <td class="text-center"><input type="checkbox" class='fck' value="<?php echo ($rq["rq_id"]); ?>" name="rq_id[]" /></td> -->
                                            <td><img width='70' height="60" src="Uploads/imgshow/<?php echo ($rq["img_src"]); ?>" alt=""></td>
                                            <td><?php echo ($rq["img_sort"]); ?></td>

                                            <td>
<!--                                                 <a class="btn btn-primary btn-sm" href="<?php echo U('Admin/ResidentialQuarters/detailInfo',array('rq_id'=>$rq['rq_id']));?>">查看</a> -->
                                                <a class="btn btn-primary btn-sm" href="<?php echo U('Admin/ImgShow/editImg',array('img_id'=>$rq['img_id']));?>">编辑</a>
                                                <a class="btn btn-danger btn-sm del_rq" href="javascript:void(0)" data-url="<?php echo U('Admin/ImgShow/ajaxDelImg');?>" data-id="<?php echo ($rq["img_id"]); ?>">删除</a>
                                            </td>
                                        </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 text-left"></div>
                            <div class="col-sm-6 text-right">
                                <ul class="pagination" id="page_ul"></ul>
                            </div>
                        </div>
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
    <script>
        $('#checkAll').click(function () {
            $('.fck').prop('checked', $(this).prop('checked'));
        });

        $('.fck').each(function () {
            $(this).click(function () {
                var flag = true;
                $('.fck').each(function () {
                    if (!$(this).prop('checked')) {
                        flag = false;
                        return false;
                    }
                });
                $('#checkAll').prop('checked', flag);
            });
        });
        
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

        $('.del_rq').click(function () {
            var _this = $(this);
            var url = _this.data('url');
            var id = "";
                id = _this.data('id');
            
            layer.confirm('是否删除', {
                title: '提示',
                btn: ['是', '否']
            }, function (index) {
                $.ajax({
                    url: url,
                    async: true,
                    type: 'get',
                    data: {id: id},
                    dataType: 'json',
                    contentType: "application/x-www-form-urlencoded; charset=utf-8",
                    success: function (data, status) {
                        if (data.status == 1) {
                            layer.alert(data.info, {icon: 1, time: 2000,
                                end: function () {
                                    window.history.go(0);
                                }, cancel: function () {
                                    window.history.go(0);
                                }});
                        } else {
                            layer.alert(data.info, {icon: 2, time: 2000});
                        }
                    }
                });
                layer.close(index);
            }, function () {
            });
        });

        
    </script>
</body>
</html>