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
        <!-- Start .content-wrapper -->
        <div class="content-wrapper">
            <div class="row">
                <!-- Start .row -->
                <!-- Start .page-header -->
                <div class="col-lg-12 heading">
                    <!-- Start .bredcrumb -->
                    <ul id="crumb" class="breadcrumb"></ul>
                    <!-- End .breadcrumb -->
                </div>
                <!-- End .page-header -->
            </div>
            <!-- End .row -->
            <div class="outlet">
                <!-- Start .outlet -->
                <!-- Page start here ( usual with .row ) -->
                <div class="row">
                    <!-- Start .row -->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="carousel-tile carousel vertical slide">
                            <div class="carousel-inner">
                                <div class="item active">
                                    <div class="tile red">
                                        <div class="tile-icon">
                                            <i class="br-cart s64"></i>
                                        </div>
                                        <div class="tile-content">
                                            <div class="number">107</div>
                                            <h3>需求</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="tile orange">
                                        <!-- tile start here -->
                                        <div class="tile-icon">
                                            <i class="ec-cog s64"></i>
                                        </div>
                                        <div class="tile-content">
                                            <div class="number">5</div>
                                            <h3>课程</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Carousel -->
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="carousel-tile carousel slide">
                            <div class="carousel-inner">
                                <div class="item active">
                                    <div class="tile blue">
                                        <div class="tile-icon">
                                            <i class="st-chat s64"></i>
                                        </div>
                                        <div class="tile-content">
                                            <div class="number">24</div>
                                            <h3>订单</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="tile brown">
                                        <!-- tile start here -->
                                        <div class="tile-icon">
                                            <i class="ec-mail s64"></i>
                                        </div>
                                        <div class="tile-content">
                                            <div class="number">17</div>
                                            <h3>消息</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Carousel -->
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="carousel-tile carousel vertical slide">
                            <div class="carousel-inner">
                                <div class="item active">
                                    <div class="tile green">
                                        <div class="tile-icon">
                                            <i class="ec-users s64"></i>
                                        </div>
                                        <div class="tile-content">
                                            <div class="number">325</div>
                                            <h3>消息</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="tile purple">
                                        <!-- tile start here -->
                                        <div class="tile-icon">
                                            <i class="ec-search s64"></i>
                                        </div>
                                        <div class="tile-content">
                                            <div class="number">2540</div>
                                            <h3>Searches</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Carousel -->
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="carousel-tile carousel slide">
                            <div class="carousel-inner">
                                <div class="item active">
                                    <div class="tile teal">
                                        <!-- tile start here -->
                                        <div class="tile-icon">
                                            <i class="ec-images s64"></i>
                                        </div>
                                        <div class="tile-content">
                                            <div class="number">45</div>
                                            <h3>订单</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="tile magenta">
                                        <!-- tile start here -->
                                        <div class="tile-icon">
                                            <i class="ec-share s64"></i>
                                        </div>
                                        <div class="tile-content">
                                            <div class="number">3548</div>
                                            <h3>Posts shared</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Carousel -->
                    </div>
                </div>
                <!-- End .row -->

                <!-- End .row -->
                <!-- Page End here -->
            </div>
            <!-- End .outlet -->
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
</body>
</html>