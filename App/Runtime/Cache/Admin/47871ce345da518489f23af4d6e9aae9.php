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
    <body class="login-page">
        <!-- Start #login -->
        <div id="login" class="animated bounceIn">
            <h1 class="text-center">滴滴管理系统</h1>
            <!-- Start .login-wrapper -->
            <div class="login-wrapper">
                <ul id="myTab" class="nav nav-tabs nav-justified bn">
                    <li class="active">
                        <a href="#log-in" data-toggle="tab">登录</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content bn">
                    <div class="tab-pane fade active in" id="register">
                        <form class="form-horizontal mt20" action="" id="login_form" role="form">
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <!-- col-lg-12 start here -->
                                    <input id="email1" name="admin_name" type="text" class="form-control left-icon" placeholder="用户名" />
                                    <i class="ec-user s16 left-input-icon"></i> 
                                </div>
                                <!-- col-lg-12 end here -->
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <!-- col-lg-12 start here -->
                                    <input type="password" class="form-control left-icon" name="admin_pwd" placeholder="密码" />
                                    <i class="ec-locked s16 left-input-icon"></i> 
                                </div>
                                <!-- col-lg-12 end here -->
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <!-- col-lg-12 start here -->
                                    <button class="btn btn-success btn-block" id="by_p_login">登录</button>
                                </div>
                                <!-- col-lg-12 end here -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End #.login-wrapper -->
        </div>
        <!-- End #login -->
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

        $('#by_p_login').click(function () {
            var _this = $(this);
            _this.attr('disabled', true);

            var user_name = $('input[name="admin_name"]');
            var user_name_val = $.trim(user_name.val());
            if (user_name_val.length == 0) {
                layer.alert('用户名不能为空', {icon: 2, time: 2000,
                    end: function () {
                        user_name.focus();
                        user_name.select();
                        _this.attr('disabled', false);
                    }, cancel: function () {
                        user_name.focus();
                        user_name.select();
                        _this.attr('disabled', false);
                    }});
                return;
            }

            var user_pwd = $('input[name="admin_pwd"]');
            var user_pwd_val = $.trim(user_pwd.val());
            if (user_pwd_val.length == 0) {
                layer.alert('密码不能为空', {icon: 2, time: 2000,
                    end: function () {
                        user_pwd.focus();
                        user_pwd.select();
                        _this.attr('disabled', false);
                    }, cancel: function () {
                        user_pwd.focus();
                        user_pwd.select();
                        _this.attr('disabled', false);
                    }});
                return;
            }

            var data = $('#login_form').serialize();

            $.ajax({
                url: '<?php echo U("Admin/Index/ajaxLogin");?>',
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