<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--  main layout -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>Angsir网</title>
    <meta name="keywords" content="Angsir网">
    <meta name="description" content="Angsir网">
    <meta name="baidu_ssp_verify" content="012083dea3cb5ea1b27406bc9fe3dc22">

    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <!-- page Common css file -->

    <link href="/Angsir/code/Angsir/Public/dist/css/basic.css" rel="stylesheet" type="text/css">
    <link href="/Angsir/code/Angsir/Public/dist/css/public.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="/Angsir/code/Angsir/Public/dist/css/main.html_aio_0a6f700.css">
    <script type="text/javascript" async="" src="/Angsir/code/Angsir/Public/dist/js/atrk.js"></script>

    <script>
        // console.log
        if (window.console == undefined) {
            window.console = {
                log: function (msg) {
                }
            }
        }

    </script>
    <!-- page Common jquery file -->
    <script type="text/javascript">

        (function () {
            var protocol = window.location.protocol;
            var host = window.location.host;
            var baseUrl = protocol + '//' + host;

            window.GLOBAL_DOMAIN = window.GLOBAL_DOMAIN || {
                ctx: '#',
                rctx: '#',
                crctx: '#',
                pctx: '#',
                actx: '#',
                cpctx: '#',
                paictx: '#',
                sctx: '#',
                zctx: '#',
                ectx: '#',
                proctx: '#',
                lgsctx: protocol + '//static.lagou.com',
                FE_frontLogin: baseUrl + '/frontLogin.do',
                FE_frontLogout: baseUrl + '/frontLogout.do',
                FE_frontRegister: baseUrl + '/frontRegister.do'
            };

            window.GLOBAL_CDN_DOMAIN = '#';
        })();
    </script>

    <script src="/Angsir/code/Angsir/Public/dist/js/jquery-1.11.3.min.js"></script>
    <script src="/Angsir/code/Angsir/Public/dist/js/user.agent.js"></script>
    <script>
        //控制ajax 并发请求数量
        (function (jQuery) {
            var old_ajax = jQuery.ajax;
            var queue = []
            var c = 0;
            var max_c = 4;
            function ajax(arg) {
                var args = []
                for (var i = 0; i < arguments.length; i++) {
                    args.push(arguments[i]);
                }
                queue.push(args);
                setTimeout(run, 1);
            }
            function run() {
                c++;
                if (c > max_c) {
                    return;
                }

                var t = queue.shift();
                if (t) {
                    old_ajax.apply(jQuery, t).always(function () {
                        c--;
                        setTimeout(run, 1);
                    })
                }

            }

            //jQuery.ajax=ajax;


        })(jQuery)

    </script>



    <!-- End Alexa Certify Javascript -->

    <link href="/Angsir/code/Angsir/Public/dist/css/search.css" rel="stylesheet" type="text/css">
    <!-- 请置于所有广告位代码之前 -->


</head>

<body>
    <!-- header start-->

    <script src="/Angsir/code/Angsir/Public/dist/js/js.cookie.js"></script>
    <script>
            //ajax 刷新用户菜单 的现实和隐藏
            //$(".nav-menu").hide();
            (function () {

                var queue = []
                var data;

                function load_cookie() {

                    var userinfo = Cookies.get('userinfo');
                    if (userinfo == undefined) {
                        data = ({
                            'status': 0, 'result': {
                                'username': '',
                                'identity': ''
                            }
                        })
                        flush_view2();
                        return;
                    }
                    var arr = userinfo.split('|');
                    if (arr && arr[0] == '1') {
                        var uid = arr[1];
                        var username = Cookies.get('un-' + uid);
                        var identity = Cookies.get('st-' + uid);
                        if ((identity == '') || (undefined == identity)) {
                            identity = 1;
                        }
                        //console.log('username!=undefined ,',username!=undefined , username!='undefined' );
                        if (username && undefined != username && 'undefined' != username) {
                            data = ({
                                'status': 1, 'result': {
                                    'username': username,
                                    'identity': identity
                                }
                            })

                            flush_view2();
                            return;
                        }
                    }
                }




                function getUserInfo(callback) {
                    //console.log('push ');
                    //console.log('push ',callback.toString);
                    queue.push(callback);
                    flush_view2();
                }


                function flush_view2() {
                    if (!data) {
                        // console.log('no data');
                        return;
                    }
                    while (1) {
                        var callback = queue.shift()
                        if (!callback) {
                            break;
                        }
                        //console.log('call',callback.toString(),data)
                        callback(data)
                    }
                }

                window.getUserInfo = getUserInfo;

                load_cookie();
                //console.log('data',data);
                if (!data) {
                    $.ajax({
                        type: "POST",
                        url: "/passport/user/loginStatusAjax",
                        dataType: "json",
                        success: function (result) {

                            //flush_view(data);
                            data = result;
                            flush_view2();
                        }

                    });
                }


            })()

    </script>
    <link href="/Angsir/code/Angsir/Public/vendor/layui/css/layui.css" rel="stylesheet" type="text/css">
<script src="/Angsir/code/Angsir/Public/vendor/layui/layui.js"></script>
<style>
    .m-right1 .text-list3 span {
        width: auto;
    }

    .img-responsive {
        max-width: 20px;
    }

    .login-box .login {
        padding-top: 0;

    }

    .header .login-box .user-info-box {
        text-align: center;
        padding: 8px 10px;
    }


    .header .user-name {
        display: inline-block;
        padding: 0;
    }

    .header .user-img-box {
        display: inline-block;
        padding: 0;
    }

    .header .user-img {
        width: 20px;
        height: 20px;
        padding: 0;
        display: inline-block;
    }
</style>


<div class="header" id="header">
    <div class="wrap">
        <div class="login-box fl-right">
            <!-- 已登录 -->

            <?php if(empty($_SESSION['user_id'])): ?><!-- 为空 ，未登录-->
                <div class="loginout" loginstate="0">
                    <a class="btn-sign" href="javascript:;" role="button" target="_self" id="js-login" pop-data="#js_popuplogin">登录</a>
                    <a class="btn-register" href="javascript:;" role="button" id="js-reg" target="_self">注册</a>
                </div>

                <?php else: ?>
                <!-- 不为空 ，已登录-->
                <div class="login js_navlogin">
                    <p class="user-info-box">
                        <span class="user-name"><?php echo (session('user_name')); ?></span>
                        <span class="user-img-box">
                            <img src="<?php echo (session('user_img')); ?>" onerror='this.src="/Angsir/code/Angsir/Public/dist/image/gravatar-default.jpg"' class="user-img" alt="Responsive image">
                        </span>
                    </p>
                    <div class="nav-userlist js_navuserlist">
                        <p>
                            <a href="<?php echo U('Center/Center');?>">个人中心</a>
                        </p>

                        <!-- <p>
                            <a href="#/passport/manage">账号管理</a>
                        </p> -->
                        <p class="btn-logout">
                            <a href="<?php echo U('Login/sinOut');?>" class="btn-logout">退出</a>
                        </p>
                    </div>
                </div><?php endif; ?>




        </div>

        <a class="bl-logo" href="#/">Angsir网</a>

        <ul class="nav fl-left" identitystate="0">
            <li>
                <a href="<?php echo U('Index/Index');?>">首页</a>
            </li>
            <li>
                <a href="<?php echo U('Search/Search');?>" rel="nofollow">搜索经历</a>
            </li>
            <li>
                <a href="<?php echo U('Fb/fb');?>" rel="nofollow">发布经历</a>
            </li>
            <li>
                <a href="<?php echo U('Article/article');?>" rel="nofollow">我的经历</a>
            </li>

        </ul>
    </div>
</div>

<!-- 登录弹出层 start-->
<div id="js_popuplogin" class="popUp">
    <div id="gmask"></div>
    <div class="pop mid">
        <span class="close"></span>
        <div class="pop-main">
            <div class="pop-con">
                <div class="w340">
                    <form action="<?php echo U('Login/login');?>" id="login_form" name="login" class="form-signin ptb20 layui-form" method="post">
                        <h1>登录</h1>

                        <!-- <input type="hidden" id="callback" name="callback" value="/zhiwei/view/29546736/"> -->
                        <ul class="form-list1">
                            <li class="label-inline1">
                                <label for="user_id" class="label-1 fz-14">账 号</label>
                                <input lay-verify='required|email' type="text" id="user_id" name="user_id" value="" class="form-control w-248 js_validate"
                                    placeholder="请输入邮箱"> </li>

                            <li class="label-inline1">
                                <label for="user_pwd" class="label-1 fz-14">密 码</label>
                                <input lay-verify='required' type="password" id="user_pwd" name="user_pwd" value="" class="form-control w-248 js_validate"
                                    placeholder="6-16个字符，不能有空格，区分大小写" autocomplete="off"> </li>
                            <li>
                                <a href="<?php echo U('Login/findPassword');?>" target="_black" class="fl-right">忘记密码</a>
                                <label for="remember">
                                    <input type="checkbox" name="remember" checked="" lay-skin='primary'> 下次自动登录
                                </label>
                            </li>
                            <li class="mt20">
                                <input type="button" lay-submit lay-filter="login" value="登 录" class="btn btn-primary btn-lg btn-block mlr0">

                                <li class="tx-right">
                                    没有账号，
                                    <a href="#passport/register" class="fc-orange1 js-reg">立即注册</a>
                                </li>
                        </ul>
                    </form>
                </div>

                <div class="clear"></div>

            </div>
        </div>
    </div>
</div>
<!-- 登录弹出层 end -->
<!-- 注册 start-->
<div id="js_popupreg" class="popUp">
    <div id="gmask"></div>
    <div class="pop mid">
        <span class="close"></span>
        <div class="pop-main">
            <div class="pop-con">
                <div class="w340">
                    <form id="reg_form" name="login" class="form-signin ptb20 layui-form" method="post">
                        <h1>注册</h1>
                        <!-- <input type="hidden" id="callback" name="callback" value="/zhiwei/view/29546736/"> -->
                        <ul class="form-list1">
                            <li class="label-inline1">
                                <label for="user_id_reg" class="label-1 fz-14">账 号</label>
                                <input type="text" id="user_id_reg" name="user_id" value="" autocomplete="off" lay-verify='email' class="form-control w-248 js_validate"
                                    placeholder="请输入邮箱"> </li>

                            <li class="label-inline1">
                                <label for="user_pwd1" class="label-1 fz-14">密 码</label>
                                <input type="password" id="user_pwd1" name="user_pwd1" value="" lay-verify='required' class="form-control w-248 js_validate"
                                    placeholder="6-16个字符，不能有空格，区分大小写" autocomplete="off">
                            </li>

                            <li class="label-inline1">
                                <label for="user_pwd2" class="label-1 fz-14">确认密码</label>
                                <input type="password" id="user_pwd2" name="user_pwd2" value="" lay-verify='required' class="form-control w-248 js_validate"
                                    placeholder="6-16个字符，不能有空格，区分大小写" autocomplete="off">
                            </li>


                            <li class="mt20">
                                <input lay-submit type="button" lay-filter="reg" value="注册" class="btn btn-primary btn-lg btn-block ">
                            </li>

                            <li>
                                <p style="max-height:100px;overflow: auto;"></p>
                            </li>

                        </ul>
                    </form>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>
<!-- 注册 end -->

<script>


    //搜索处理
    layui.use('form', function () {

        var form = layui.form;
        //各种基于事件的操作

        form.on('submit(reg)', function (data) {
            // console.log(data.elem) //被执行事件的元素DOM对象，一般为button对象
            // console.log(data.form) //被执行提交的form对象，一般在存在form标签时才会返回
            field = data.field; //当前容器的全部表单字段，名值对形式：{name: value}
            var user_id = data.field.user_id;

            var index = layer.load(2);
            $.post("<?php echo U('Login/reg');?>", field, function (res) {

                layer.close(index);
                res = JSON.parse(res);
                // console.log(res);

                if (res.res == 0) {
                    // 注册成功
                    layer.msg('注册成功~正在为您跳转~');

                    setTimeout(function () {
                        location.reload(true);
                    }, 300);

                }

                if (res.res == -1) {
                    //1：必填字段为空
                    layer.msg('必填字段为空~');
                }
                if (res.res == -2) {
                    //2：密码不等
                    layer.msg('密码不等~');
                }
                if (res.res == -3) {
                    //3：插入到数据库的时候失败
                    layer.msg('插入到数据库的时候失败~');
                }
                if (res.res == -4) {
                    //4：用户已经存在
                    layer.msg('用户已经存在~');
                }

            });
            return false;
        });
        form.on('submit(login)', function (data) {
            // console.log(data.elem) //被执行事件的元素DOM对象，一般为button对象
            // console.log(data.form) //被执行提交的form对象，一般在存在form标签时才会返回
            field = data.field; //当前容器的全部表单字段，名值对形式：{name: value}
            $.post("<?php echo U('Login/login');?>", field, function (res) {

                res = JSON.parse(res);

                if (res.res == 0) {
                    // 登录成功
                    layer.msg('登录成功~正在为您跳转~');
                    setTimeout(function () {
                        location.reload(true);
                    }, 200);

                }
                if (res.res == -1) {
                    //1：必填字段为空
                    layer.msg('必填字段为空~');
                }
                if (res.res == -2) {
                    //密码不正确
                    layer.msg('密码不正确~');
                }

            });
            return false;
        });
    });




    $(document).on('click', '#js-reg,.js-reg', function () {
        showReg();
    });
    function showReg() {
        console.log('js-reg');

        $('#js_popupreg').find('.pop.mid').attr('style', 'left: 50%; top: 50%; margin: -167.5px 0px 0px -260px;');
        $('#js_popupreg').fadeIn(300);

    }

</script>


<!-- side-bar1 右测边栏 start -->
<div class="side-bar1">
    <a href="javascript:;" gotodata="body" class="js_goto">
        <p class="sb-img">
            <img src="/Angsir/code/Angsir/Public/dist/image/ico_arrowup.png" alt="" data-bd-imgshare-binded="1">

        </p>
        <p class="sb-txt1">回到顶部</p>
    </a>

    <a href="javascript:;">
        <p class="sb-img">
            <img src="/Angsir/code/Angsir/Public/dist/image/ico_sb_qr.png" alt="" data-bd-imgshare-binded="1">

        </p>
        <p class="sb-txt1">关注微信</p>
        <div class="sb-hover">
            <i class="tips1"></i>
            <i class="tips-arrow"></i>
            <p class="qr-box">
                <img src="/Angsir/code/Angsir/Public/dist/image/bl_weixin.jpg" alt="" class="js_bl_qr_weixin" data-bd-imgshare-binded="1"> </p>
            <p class="qr-txt">(仅限本人使用)</p>
        </div>
    </a>

</div>

    <div class="clear"></div>
    <script>
        getUserInfo(function (data) {
            if (data['status'] != 0) {
                //已经登陆
                $('[loginstate="0"]').addClass('hidden');
                $('[loginstate="1"]').removeClass('hidden');
                if (data['result']['username']) {
                    $(".user-name").html(data['result']['username']);
                }

                if (data['result']['identity'] == 1) {
                    $('[identitystate="2"]').addClass('hidden');
                    $('[identitystate="1"]').removeClass('hidden');

                } else if (data['result']['identity'] == 2) {
                    $('[identitystate="1"]').addClass('hidden');
                    $('[identitystate="2"]').removeClass('hidden');
                }
            } else {
                //未登录
                $('[loginstate="1"]').addClass('hidden');
                $('[loginstate="0"]').removeClass('hidden');
                $('[identitystate="1"]').addClass('hidden');
                $('[identitystate="2"]').addClass('hidden');
                $('[identitystate="0"]').removeClass('hidden');
            }
        })

        //消息通知个数小红点ajax
        getUserInfo(function (data) {
            if (data['status'] != 0 && data['result']['identity'] == 1) {
                //求职者 ajax 获取通知个数
                $.ajax({
                    type: "get",
                    url: "/position/apply/getMessageNumAjax",
                    dataType: "json",
                    success: function (data) {
                        if (data['faceNum'] == 0) {
                            $('#face span').removeClass("msg");
                            data['faceNum'] = '';
                        }
                        if (data['notFitNum'] == 0) {
                            $('#notFit span').removeClass("msg");
                            data['notFitNum'] = '';
                        }
                        if (data['messageSum'] == 0) {
                            data['messageSum'] = '';
                        }
                        if (data['status'] == 1) {
                            if (data['faceNum'] != '') {
                                $('#face span').addClass("msg");
                            }
                            if (data['notFitNum'] != '') {
                                $('#notFit span').addClass("msg");
                            }
                            if (data['messageSum'] != '') {
                                $('#messageSum').addClass("msg");
                            }
                            $('#face span').html(data['faceNum']);
                            $('#notFit span').html(data['notFitNum']);
                            $('#messageSum').html(data['messageSum']);
                        }
                    }
                });
            } else if (data['status'] != 0 && data['result']['identity'] == 2) {
                $.ajax({
                    type: "post",
                    url: "/apply/resume-manage/getNumAjax",
                    dataType: "json",
                    success: function (data) {
                        if (data['status'] == 1 && data['num'] != 0) {
                            $("#resume-manage-num").html(data['num']);
                            $("#resume-manage-num").addClass('msg');
                        } else {
                            $("#resume-manage-num").removeClass('msg');
                        }
                    }
                });
            }
        });
    </script>

    <!-- header end-->

    <div class="top-bar">
        <div class="wrap">
            <h3 class="title1">个人中心</h3>
        </div>
    </div>

    <div class="main">
        <div class="wrap">
            <div class="container clearfix" id="container">
                <!--
    @require "common/widgets/account-c-sidebar/main.less"
-->
                <div class="user_bindSidebar">
                    <ul class="user_sideBarmenu">
                        <li>
                            <a href="center.html" class="hover" data-lg-tj-id="18g0" data-lg-tj-no="idnull" data-lg-tj-cid="idnull">个人信息</a>
                        </li>

                        <li>
                            <a href="<?php echo U('Center/my');?>" data-lg-tj-id="18j0" data-lg-tj-no="idnull" data-lg-tj-cid="idnull">我的经历</a>
                        </li>

                        <li>
                            <a href="am.html" data-lg-tj-id="18j0" data-lg-tj-no="idnull" data-lg-tj-cid="idnull">修改密码</a>
                        </li>
                    </ul>
                </div>
                <input type="hidden" value="1" id="hasSidebar">

                <!--
    @require "account-c/modules/common/main.less"
    @require "account-c/modules/userinfo/main.less"
-->
                <div class="user_userinfo_content">
                    <div class="c_section">
                        <div class="userinfo_edit">

                            <form action="" method="post" class="layui-form">
                                <div class="avatar" id="user_img_file">
                                    <img class="avatar_img" id="user_img_box" src="<?php echo ($user_info["user_img"]); ?>" onerror='this.src="/Angsir/code/Angsir/Public/dist/image/default_headpic.png"'
                                        width="100" height="100" alt="未配置头像">
                                    <input type="text" name="user_img" id="user_img" value="images/myresume/default_headpic.png">
                                </div>

                                <div class="username input_box">
                                    <input type="text" value="<?php echo ($user_info["user_name"]); ?>" name="user_name" placeholder="请输入常用昵称">
                                    <input type="text" value="<?php echo ($user_info["user_age"]); ?>" name="user_age" placeholder="请输入年龄">

                                    <div class="select_pop js_popindustry" maxselectcount="3" style="width:400px; margin:10px 0" selecttxt="行业">
                                        <i class="ico_select_pop"></i>
                                        <input class="form-control control-sm js_pop_text" placeholder="请选择行业" name="industry_text" type="text" value="<?php echo ($user_info["industry_text"]); ?>"
                                            readonly="" style="width:400px; border-left:1px #eee solid;border-right:1px #eee solid;">
                                        <input class="form-control control-sm js_pop_val" value="<?php echo ($user_info["industry_id"]); ?>" placeholder="" name="industry_id" type="hidden"
                                            style="width:400px;border-left:1px #3ab679 solid;border-right:1px #3ab679 solid;">
                                    </div>
                                    <div class="select_pop js_popjobduty" maxselectcount="3" style="width:400px" selecttxt="职能">
                                        <i class="ico_select_pop"></i>
                                        <input class="form-control control-sm js_pop_text" placeholder="请选择职位" name="duty_text" type="text" value="<?php echo ($user_info["duty_text"]); ?>"
                                            readonly="" style="width:400px;border-left:1px #eee solid;border-right:1px #eee solid;">
                                        <input class="form-control control-sm js_pop_val" value="<?php echo ($user_info["duty_id"]); ?>" placeholder="" id="" name="duty_id" type="hidden"
                                            style="width:400px;border-left:1px #3ab679 solid;border-right:1px #3ab679 solid;">
                                    </div>
                                    <input type="text" name="user_address" placeholder="请输入地址" value="<?php echo ($user_info["user_address"]); ?>">
                                    <input type="text" name="contact" placeholder="请输入联系方式（选填）" value="<?php echo ($user_info["contact"]); ?>">
                                </div>

                                <div class="toolbar">
                                    <!-- <a class="btn userinfo_save" href="javascript:;" data-lg-tj-id="18k0" data-lg-tj-no="idnull" data-lg-tj-cid="idnull">保存</a> -->
                                    <input class="btn userinfo_save" value="保存" lay-submit type="button" lay-filter="save"></input>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- 页面主体END -->
        </div>
    </div>
    <!-- footer start-->
    <!-- footer start-->
<div class="clear"></div>
<div class="footer" id="js_footer">
    <div class="wrap">
        <div class="footer-link-list" style="padding-right: 0px; text-align: center;">
            <p class="footer-li1" style="float:none;">
                <a href="<?php echo U('Index/about');?>">关于Angsir网</a>|
                <a href="<?php echo U('Index/about');?>">联系我们</a>|
                <a href="<?php echo U('Index/about');?>">加入我们</a>|
                <a href="<?php echo U('Index/about');?>">帮助中心</a>

            </p>
            <p class="footer-li2" style="line-height: 25px; float:none;">Copyright©2005-2015 Angsir网 沪ICP备05050523号</p>
            <div style="text-align: center; padding:5px 0;">
                <a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=31010102002503" style="display:inline-block;text-decoration:none;height:20px;line-height:20px;">
                    <p style="float:left;height:20px;line-height:20px;margin: 0px 0px 0px 5px; color:#939393;">
                        <img src="/Angsir/code/Angsir/Public/dist/image/picp_bg_new.png" alt="沪公网备" border="0" style="margin-right: 5px; margin-top:-3px;">沪公网安备 31010102002503号</p>
                </a>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>

    <script src="/Angsir/code/Angsir/Public/dist/js/jquery.ba-resize.js"></script>
    <script src="/Angsir/code/Angsir/Public/dist/js/basic.js"></script>
    <script src="/Angsir/code/Angsir/Public/dist/js/bl_jsvalidate.js"></script>
    <script src="/Angsir/code/Angsir/Public/dist/js/uuid.js"></script>

    <script type="text/javascript" src="/Angsir/code/Angsir/Public/dist/js/vendor_e3ddeee.js"></script>
    <script type="text/javascript" src="/Angsir/code/Angsir/Public/dist/js/main.html_aio_b1a1945.js"></script>
    <script type="text/javascript" src="/Angsir/code/Angsir/Public/dist/js/widgets_817b964.js"></script>
    <script type="text/javascript" src="/Angsir/code/Angsir/Public/dist/js/userinfo_7f282e9.js"></script>
    <script type="text/javascript" src="/Angsir/code/Angsir/Public/dist/js/layout_6a3a86f.js"></script>
    <script type="text/javascript" src="/Angsir/code/Angsir/Public/dist/js/main.html_aio_2_3543cee.js"></script>
    <script type="text/javascript">
        require(['common/widgets/header_c/modules/emailvalid/main']);


        require(['common/widgets/passport/passport'], function () {


            require(['common/widgets/common/msgPopup']);
            // require('notice');


        });


        require(['common/widgets/header_c/layout/main']);


        require(['account-c/modules/userinfo/main']);


        require(['common/widgets/footer_c/modules/feedback/feedback']);


        require(['common/widgets/footer_c/layout/main']);

        $(document).ready(function () {
            var selector = '#webchat7moor';
            if ($(selector).length) {
                return;
            }

            var jqIframe = $('<iframe>', {
                id: selector.slice(1),
                src: '//static.lagou.com/third-parties/webchat7moor/main_22faef3.html',
                style: 'margin:0;'
                    + 'padding:0;'
                    + 'width:320px;'
                    + 'height:500px;'
                    + 'border-width:0;'
                    + 'border-radius: 3px;'
                    + 'transition: height 0.5s ease-out;'
                    + 'z-index:-99999;'
                    + 'display: none;'
                    + 'bottom:0;'
                    + 'right:0;'
                    + 'position:fixed;'
            });
            $(document.body).append(jqIframe);

            var child = jqIframe[0].contentWindow;
            var target = window.location.protocol + '//' + (window.GLOBAL_CDN_DOMAIN || 'static.lagou.com');

            $('#onlineService, #feedback-icon').on('click', function (e) {
                jqIframe.css('z-index', 99999).show();
                child.postMessage('{"code":1,"message":"open webchat plugin"}', target);
            });

            $(window).on('message', function (e) {
                var origin = e.origin || e.originalEvent.origin;
                if (origin.indexOf(target) !== 0) {
                    return;
                }

                var data = e.data || e.originalEvent.data;
                if (data.code === 2 && typeof data.css !== 'undefined') {
                    jqIframe.css(data.css);
                } else {
                    jqIframe.css('z-index', -99999).hide();
                }
            });
        });
    </script>

    <script src="/Angsir/code/Angsir/Public/dist/js/jquery.ba-resize.js"></script>
    <script src="/Angsir/code/Angsir/Public/dist/js/basic.js"></script>
    <script src="/Angsir/code/Angsir/Public/dist/js/bl_jsvalidate.js"></script>
    <script src="/Angsir/code/Angsir/Public/dist/js/uuid.js"></script>

    <script type="text/javascript">
        $(function () {
            popnormal({
                "popTplId": "#popup_sendemailtpl",//内容模板id
                "eventEle": ".js_pop_send_email",//点击事件元素（不定义：立即弹出）
                "popId": "popSendemail",//弹出层id 默认为popnormal,（可自定义）
                "popCallbackFun": function (args, TfThis) {
                    console.log(args);
                }
            });
            $.ajax({
                url: '/main/index/recommendAjax',
                type: 'POST',
                dataType: 'html',
                success: function (html) {
                    if (html != '') {
                        //兼容  单数据源 对 1个模板1个位置
                        $("#recommended_pos_list").html(html);
                        refreshFamous();
                    }
                }
            });
            $.ajax({
                url: '/main/index/isEmailCheckedAjax',
                type: 'POST',
                dataType: 'html',
                success: function (html) {
                    $("body").prepend(html);
                }
            });

        })

    </script>

    <script type="text/javascript">
        //ajax 搜索提示 调用
        //搜索提示 返回数据结构 data： ["php\u5de5\u7a0b\u5e08","php\u7a0b\u5e8f\u5458","php\u9ad8\u7ea7","php\u4e2d\u7ea7"]
        ajaxSearchFun({
            "eventEle": ".ajaxSearch",
            "promptUrl": "/position/search/autoCompleteAjax",
            "searchCallback": function (args) {
                $('#pos_search_form').submit();
            }
        });
    </script>

    <script src="/Angsir/code/Angsir/Public/dist/js/new_city.js"></script>
    <script src="/Angsir/code/Angsir/Public/dist/js/new_job_duty.js"></script>
    <script src="/Angsir/code/Angsir/Public/dist/js/new_industry.js"></script>
    <script src="/Angsir/code/Angsir/Public/dist/js/data_type.js"></script>
    <script src="/Angsir/code/Angsir/Public/dist/js/play.js"></script>

    <!-- footer end-->
    <script src="/Angsir/code/Angsir/Public/dist/js/handlebars-v3.0.3.js"></script>

    <script>
        //上传头像
        layui.use('upload', function () {
            var upload = layui.upload;

            //执行实例
            var uploadInst = upload.render({
                elem: '#user_img_file' //绑定元素
                , url: '<?php echo U("File/upFile");?>' //上传接口
                , done: function (res) {
                    //上传完毕回调

                    console.log(res);

                    $('#user_img_box').attr('src', res.data.src);
                    $('#user_img').val(res.data.src);

                }
                , error: function () {
                    //请求异常回调
                    //                      console.log(index);
                    //                      console.log(upload);
                    //当上传失败时，你可以生成一个“重新上传”的按钮，点击该按钮时，执行 upload() 方法即可实现重新上传
                }
            });
        });


        //搜索处理
        layui.use('form', function () {

            var form = layui.form;
            //各种基于事件的操作，下面会有进一步介绍

            form.on('submit(save)', function (data) {
                console.log(data.elem) //被执行事件的元素DOM对象，一般为button对象
                console.log(data.form) //被执行提交的form对象，一般在存在form标签时才会返回
                field = data.field; //当前容器的全部表单字段，名值对形式：{name: value}

                console.log(field);

                $.post("", field, function (res) {

                    res = JSON.parse(res);
                    console.log(res);
                    if (res.res == 0) {
                        // 保存成功
                        layer.msg('保存成功~');
                    }

                });


                return false;


            });

        });


    </script>
</body>

</html>