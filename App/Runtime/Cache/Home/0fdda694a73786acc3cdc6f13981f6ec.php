<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<!--  main layout -->

<head>

    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>Angsir网 | <?php echo ($live_info["title"]); ?></title>
    <meta name="keywords" content="Angsir网">
    <meta name="description" content="Angsir网">
    <meta name="baidu_ssp_verify" content="012083dea3cb5ea1b27406bc9fe3dc22">
    <link rel="shortcut icon" href="#favicon.ico">


    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <!-- page Common css file -->

    <link href="/Angsir/code/Angsir/Public/dist/css/basic.css" rel="stylesheet" type="text/css">
    <link href="/Angsir/code/Angsir/Public/dist/css/public.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" async="" src="/Angsir/code/Angsir/Public/dist/js/ga.js"></script>
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

    <script src="/Angsir/code/Angsir/Public/dist/js/jquery.validate.min.js"></script>
    <!-- Start Alexa Certify Javascript -->

    <!-- End Alexa Certify Javascript -->
    <!-- page private css file -->

    <link href="/Angsir/code/Angsir/Public/dist/css/manage.css" rel="stylesheet" type="text/css">
    <!-- 请置于所有广告位代码之前 -->
    <script src="/Angsir/code/Angsir/Public/dist/js/ds.js"></script>

    <script src="/Angsir/code/Angsir/Public/dist/js/share.js"></script>
    <link rel="stylesheet" href="/Angsir/code/Angsir/Public/dist/css/share_style0_24.css">
    <link rel="stylesheet" href="/Angsir/code/Angsir/Public/dist/css/share_popup.css">
    <link rel="stylesheet" href="/Angsir/code/Angsir/Public/dist/css/select_share.css">
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

                <?php if(!$loginIsShow): ?><div class="loginout" loginstate="0">
                        <a class="btn-sign" href="javascript:;" role="button" target="_self" id="js-login" pop-data="#js_popuplogin">登录</a>
                        <a class="btn-register" href="javascript:;" role="button" id="js-reg" target="_self">注册</a>
                    </div><?php endif; ?>



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
        <span class="close">x</span>
        <div class="pop-main">
            <div class="pop-con">
                <div class="w340">
                    <form action="<?php echo U('Login/login');?>" id="login_form" name="login" class="form-signin ptb20 layui-form" method="post">
                        <h1>登录</h1>

                        <!-- <input  type="hidden" id="callback" name="callback" value="/zhiwei/view/29546736/"> -->
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
        <span class="close">x</span>
        <div class="pop-main">
            <div class="pop-con">
                <div class="w340">
                    <form id="reg_form" name="login" class="form-signin ptb20 layui-form" method="post">
                        <h1>注册</h1>
                        <!-- <input  type="hidden" id="callback" name="callback" value="/zhiwei/view/29546736/"> -->
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

    $('#js_popupreg').find('.close').on('click', function () {
        $('#js_popupreg').fadeOut(300);
    });

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
    <!-- main start-->

    <div>

    </div>
    <!-- 职位ID和HR ID -->
    <input type="hidden" id="pid" name="pid" value="29546736">
    <input type="hidden" id="hr_uid" name="hr_uid" value="9409970">
    <div class="top-bar3 js_position_bar" style="position: static;">
        <div class="wrap">
            <div class="tbar3-left">
                <div class="tbar3-top">
                    <h1 class="tbar2-title1">
                        <strong><?php echo ($live_info["title"]); ?></strong>
                        <span class="ico-wrap">
                        </span>
                    </h1>
                    <div class="tbar3-li1">

                        <div class="tbar3-duty">
                            <span>行业：</span>
                            <h2><?php echo ($live_info["industry_text"]); ?></h2>
                        </div>
                        <div class="tbar3-duty">
                            <span>该行业或该职位有无相关证书，是否必须持证上岗：</span>
                            <h2><?php echo ($live_info["is_certificate"]); ?></h2>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="tbar3-bottom" style="display: block;">
                    <ul class="ullist-inline1">
                        <li>
                            <span>入职时间：</span>
                            <h2><?php echo ($live_info["entry_time"]); ?></h2>
                        </li>
                        <li>
                            <span>在该岗位时间：</span>
                            <h2><?php echo ($live_info["in_job_time"]); ?></h2>
                        </li>
                        <li>
                            <span>入职薪资：</span>
                            <h2><?php echo ($live_info["salary"]); ?></h2>
                        </li>
                        <li>
                            <span>3～5年后薪资：</span>
                            <h2><?php echo ($live_info["year_3_5_salary"]); ?> <?php echo ($live_info["salary_type_0"]); ?> <?php echo ($live_info["salary_type_1"]); ?></h2>
                        </li>
                        <li>
                            <span>地点：</span>
                            <h2><?php echo ($live_info["location"]); ?></h2>
                        </li>
                        <li>
                            <span>上班/下班时间：</span>
                            <h2>09：00~17：00</h2>
                        </li>
                    </ul>
                    <div class="clear"></div>
                    <div class="clear"></div>
                    <div class="publish-time">更新时间：<?php echo (date('Y-m-d H:i:s',$live_info["edit_time"])); ?>发布</div>
                </div>
            </div>
            <div class="tbar3-right">
                <!-- index/apply -->
                <div id="apply-job-box">
                    <!-- (未登录用户) or (已经的登录用户&&没有急速简历&&没有手机号) - 单个按钮 -->
                    <div class="tbar3-top position-do-box" id="operate_urgent_create">

                    </div>
                    <!-- pop up 框3: 投递成功 -->
                    <div style="display: none;" class="apply-pop-up-box" id="apply-success">
                        <div class="tips_info">
                            <div class="apply_msg">
                                <div class="apply_success_con pop_normal_msg">
                                    <h5>职位已申请成功！投递反馈请到求职管理中查看。</h5>
                                    <div class="pop_action">
                                        <a actioncolse="false" id="confirm_close" class="confirm-apply-btn btn btn-primary w-100 ">确定</a>
                                    </div>
                                    <div class="txt-boxv1" id="complete_resume_box">
                                        <a href="#resume/my" class="fc-blue2">进一步完善简历提升面试机会 &gt;&gt;</a>
                                    </div>
                                </div>
                                <div class="qr_horizon">
                                    <div class="bl-qr-box">
                                        <div class="bl-qr-cell qr-1">
                                            <div class="bl-qr-img">
                                                <img src="/Angsir/code/Angsir/Public/dist/image/app.jpg" alt="app下载" data-bd-imgshare-binded="1"> </div>
                                            <div class="bl-qr-txt">
                                                <div class="qr-title">若邻APP全新改版</div>
                                                <div class="qr-txt">躺着也能搜职位，
                                                    <br>跟踪投递反馈！</div>
                                                <div class="qr-btn">扫一扫，立即下载</div>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="bl-qr-cell qr-2">
                                            <div class="bl-qr-img">
                                                <img src="/Angsir/code/Angsir/Public/dist/image/getWxImg" alt="该图片动态生成" data-bd-imgshare-binded="1"> </div>
                                            <div class="bl-qr-txt">
                                                <div class="qr-title">若邻微信服务号</div>
                                                <div class="qr-txt">边玩微信边找工作，
                                                    <br>投递反馈早知道！</div>
                                                <div class="qr-btn">扫码，绑定并关注</div>
                                            </div>
                                            <div class="clear"></div>
                                            <div class="qr-botton-txt">(扫描后会绑定账号，限本人使用
                                                <br>如提示过期，请刷新页面)</div>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="main">
        <div class="wrap">
            <div class="m-left1">
                <div class="job-preview">

                    <h4 class="v2-tab1">
                        <i class="ico ico-square"></i>经历描述</h4>
                    <div class="job-description" style="font-size:14px; line-height:30px">
                        <ul>
                            <li>
                                <span class="cd">
                                    是否经常加班</span>
                            </li>

                            <?php if($live_info["is_overtime"] > 0 ): ?><li>不经常加班</li>
                                <?php else: ?>
                                <li>
                                    <?php echo ($live_info["overtime_info"]); ?>
                                </li><?php endif; ?>

                            <li>
                                <strong>
                                    <span class="cd">工作环境</span>
                                </strong>
                            </li>
                            <li><?php echo ($live_info["work_environment"]); ?></li>

                            <li>
                                <span class="cd">人际氛围</span>
                            </li>
                            <li><?php echo ($live_info["interpersonal_atmosphere"]); ?></li>

                            <li>
                                <span class="cd">工作中男女比例</span>
                            </li>
                            <li><?php echo ($live_info["male_to_female_ratio"]); ?></li>

                            <li>
                                <span class="cd">人员流动是否频繁</span>
                            </li>
                            <li><?php echo ($live_info["is_the_turnover_of_personnel_frequent"]); ?></li>

                            <li>
                                <span class="cd">上升空间及发展前景</span>
                            </li>
                            <li><?php echo ($live_info["rising_space_and_development_prospect"]); ?></li>

                            <li>
                                <span class="cd">需要接触哪些方面的人</span>
                            </li>
                            <li><?php echo ($live_info["who_do_you_need_to_contact"]); ?></li>

                            <li>
                                <span class="cd">典型的一天工作</span>
                            </li>
                            <li><?php echo ($live_info["a_typical_day_work"]); ?></li>

                            <li>
                                <span class="cd">什么时候压力最大</span>
                            </li>
                            <li><?php echo ($live_info["when_is_the_maximum_pressure"]); ?></li>
                            <li>
                                <span class="cd">想对后来人说点什么</span>
                            </li>
                            <li><?php echo ($live_info["what_do_you_want_to_say_to_later_people"]); ?></li>
                            <li>
                                <span class="cd">一则自己亲身经历的职场故事</span>
                            </li>
                            <li><?php echo ($live_info["story"]); ?></li>
                            <li>
                                <span class="cd">其他想说的：</span>
                            </li>
                            <li><?php echo ($live_info["live_info"]); ?></li>

                            <!--  -->

                            <li style="float:right; font-size:14px">留言：<?php echo (count($comment_info)); ?> 阅读量：<?php echo ($readCount); ?> 点赞：
                                <div style='display: inline' id="liveGoodCount"><?php echo ($liveGoodCount); ?></div>
                                <a id="liveGood">
                                    <img src="/Angsir/code/Angsir/Public/dist/image/z.png" width="26" height="24" />
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div>

                        <style>
                            #commentBox img {
                                width: 50px;
                                height: 50px;
                                border-radius: 50%;
                            }

                            .comment-item {
                                padding: 10px 0;
                            }

                            .reply {
                                position: relative;
                                opacity: 0
                            }

                            .comment-item:hover .reply {
                                opacity: 1
                            }

                            .reply-box {
                                background-color: #eeeeee;
                                padding: 5px 15px;
                                border-radius: 5px;
                                margin-top: 10px;
                                margin-bottom: 10px;
                            }

                            .reply-item {
                                padding: 10px 0;
                                line-height: 1.8;
                                border-left: solid #ddd 3px;
                                padding-left: 10px;
                                margin: 20px 0;
                            }

                            .reply-item span a {
                                color: #777;
                            }

                            .del-r {
                                color: #f00;
                            }
                        </style>
                        <hr>
                        <div class="layui-field-box">
                            <ul id="commentBox">
                                <!-- comment_info -->

                                <?php if(is_array($comment_info)): $i = 0; $__LIST__ = $comment_info;if( count($__LIST__)==0 ) : echo "没有留言" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><li class="comment-item">
                                        <div class="layui-row">
                                            <div class="layui-col-md2" style='text-align: center'>


                                                <a href="<?php echo U('User/show','user_id='.$vol['user_id']);?>" target="_blank">
                                                    <img class="user_img" src="<?php echo ($vol["user_img"]); ?>" onerror='this.src="/Angsir/code/Angsir/Public/dist/image/default_headpic.png"' />
                                                </a>
                                                <div>
                                                    <?php echo ($vol["user_name"]); ?>
                                                </div>
                                                <?php if(!empty($is_admin)): ?><div>
                                                        <a data-href="<?php echo U('Admin/Comment/del','comment_id='.$vol['comment_id']);?>" class="del-r">删除评论</a>
                                                    </div><?php endif; ?>
                                            </div>
                                            <div class="layui-col-md10">
                                                <p>
                                                    <span class="layui-badge-rim"><?php echo (date('Y-m-d H:i:s',$vol["live_add_time"])); ?></span>
                                                </p>
                                                <p>&nbsp</p>
                                                <span>
                                                    <?php echo ($vol["content"]); ?>
                                                </span>
                                            </div>

                                        </div>


                                        <?php if(empty($vol["list"])): ?><ul class="reply-box" style='display:none'>
                                            </ul><?php endif; ?>
                                        <?php if(!empty($vol["list"])): ?><ul class="reply-box">
                                                <!-- <p class="text-center">
                                                    <span style='border-bottom:solid 1px #ddd;color:#777;padding:5px 20px'>回复列表</span>
                                                </p> -->


                                                <?php if(is_array($vol["list"])): $i = 0; $__LIST__ = $vol["list"];if( count($__LIST__)==0 ) : echo "没有留言" ;else: foreach($__LIST__ as $key=>$vol2): $mod = ($i % 2 );++$i;?><li class="reply-item">
                                                        <span>
                                                            <a href="<?php echo U('User/show','user_id='.$vol['user_id']);?>" target="_blank">
                                                                [<?php echo ($vol2["user_name"]); ?> | <?php echo (date('Y-m-d H:i:s',$vol["live_add_time"])); ?>]
                                                            </a>
                                                        </span>：<?php echo ($vol2["content"]); ?>
                                                        <?php if(!empty($is_admin)): ?><div>
                                                                <a data-href="<?php echo U('Admin/Comment/delR','comment_id='.$vol2['comment_id']);?>" class="del-r" data-type='replay'>删除评论</a>
                                                            </div><?php endif; ?>
                                                    </li><?php endforeach; endif; else: echo "没有留言" ;endif; ?>
                                            </ul><?php endif; ?>

                                        <div class="row reply">
                                            <div class="col-lg-12">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="回复">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default post-reply" type="button" data-id='<?php echo ($vol["comment_id"]); ?>'>回复</button>
                                                    </span>
                                                </div>
                                                <!-- /input-group -->
                                            </div>
                                            <!-- /.col-lg-6 -->
                                        </div>
                                        <hr class="layui-bg-gray">

                                    </li><?php endforeach; endif; else: echo "没有留言" ;endif; ?>
                            </ul>
                        </div>

                    </div>
                    <form class="layui-form" action="<?php echo U('Comment/add');?>" method="post">
                        <textarea cols="" rows="12" class="w-682 " name="content"></textarea>
                        <input type="hidden" name="live_id" value="<?php echo ($live_info["live_id"]); ?>">
                        <li class="mt20 fb " style="margin-left:180px">
                            <input type="submit" id="comment" value="留  言" class="btn btn-primary btn-lg btn-block mlr0 fb " style="width:300px; margin:20px"
                                align="middle">
                        </li>
                    </form>

                </div>

            </div>
            <div class="m-right1">
                <div class="company-info">
                    <h4 class="v2-tab1">
                        <i class="ico ico-square"></i>
                        发布者介绍
                    </h4>
                    <div class="ebox5">
                        <div class="company-logo">
                            <img src="<?php echo ($user_info["user_img"]); ?>" onerror='this.src="/Angsir/code/Angsir/Public/dist/image/company_logo666601_169.jpg"' data-bd-imgshare-binded="1">

                        </div>
                        <h2><?php echo ($user_info["user_name"]); ?></h2>

                        <ul class="text-list3 mt20">
                            <li>
                                <span>年龄：</span><?php echo ($user_info["user_age"]); ?></li>
                            <li>
                                <span>行业：</span><?php echo ($user_info["industry_text"]); ?></li>
                            <li>
                                <span>职位：</span><?php echo ($user_info["duty_text"]); ?></li>
                            <li>
                                <span>地址：</span><?php echo ($user_info["user_address"]); ?></li>
                            <li>
                                <span>邮箱：</span><?php echo ($user_info["user_id"]); ?></li>
                        </ul>
                    </div>
                </div>
                <div class="company-map mt5">


                </div>


                <div class="mt10">
                    <div id="_cgymg42ebbf"></div>
                </div>
                <div class="mt10">
                    <div id="_cai5zfxrjjm"></div>
                </div>
                <div class="mt10">
                    <div id="_jvio15hgv0g"></div>
                </div>
                <div id="_34kem404v5g"></div>

                <div id="_xddt6gazwwj"></div>

            </div>
            <div class="clear"></div>

        </div>
    </div>

    <!-- main end-->

    <!-- 统计数据 js file -->
    <script>
        var apply_data = {
            pid: $("#pid").val(),
            hr_uid: $("#hr_uid").val()
        };
        $.ajax({
            url: '/position/index/stats',
            data: apply_data,
            type: 'post',
            dataType: 'json',
            success: function (data) {
                if (data['status'] == 1) {
                    $(".process_rate").html(data['process_rate']);
                    $(".process_time").html(data['process_time']);
                }
            }
        })
    </script>
    <!-- 更新浏览数AJAX -->

    <!-- footer start-->
    <div class="clear"></div>
    <div class="footer" id="js_footer">
        <div class="wrap">
            <div class="footer-link-list" style="padding-right: 0px; text-align: center;">
                <p class="footer-li1" style="float:none;">
                    <a href="#/about/about/index">关于Angsir网</a>|
                    <a href="#/about/about/contactUs">联系我们</a>|
                    <a href="#/about/about/joinUs">加入我们</a>|
                    <a href="#/about/about/help">帮助中心</a>
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


    <!--  Common js file -->

    <script src="/Angsir/code/Angsir/Public/dist/js/jquery.ba-resize.js"></script>
    <script src="/Angsir/code/Angsir/Public/dist/js/basic.js"></script>
    <script src="/Angsir/code/Angsir/Public/dist/js/bl_jsvalidate.js"></script>
    <script src="/Angsir/code/Angsir/Public/dist/js/uuid.js"></script>

    <!-- footer end-->
    <script src="/Angsir/code/Angsir/Public/dist/js/handlebars-v3.0.3.js"></script>
    <!-- page private  js  -->


    <!--右侧悬浮导航 我要反馈 -->
    <div class="clear"></div>
    <!-- side-bar1 右测边栏 start -->
    <div class="side-bar1">
        <a href="javascript:;" gotodata="body" class="js_goto">
            <p class="sb-img">
                <img src="/Angsir/code/Angsir/Public/dist/image/ico_arrowup.png" alt="" data-bd-imgshare-binded="1">
                <span class="img-hover">
                    <img src="/Angsir/code/Angsir/Public/dist/image/ico_arrowup_color.png" alt="" data-bd-imgshare-binded="1">
                </span>
            </p>
            <p class="sb-txt1">回到顶部</p>
        </a>

        <a href="javascript:;">
            <p class="sb-img">
                <img src="/Angsir/code/Angsir/Public/dist/image/ico_sb_qr.png" alt="" data-bd-imgshare-binded="1">
                <span class="img-hover">
                    <img src="/Angsir/code/Angsir/Public/dist/image/ico_sb_qr_color.png" alt="" data-bd-imgshare-binded="1">
                </span>
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
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->

    <style>
        .my-input {
            display: block;
            width: 100%;
            height: 34px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;

        }

        .my-input:focus {
            border-color: #66afe9;
            outline: 0;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(102, 175, 233, .6);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(102, 175, 233, .6);
        }
    </style>


    <script>
        /**
    点赞功能
        */
        $(document).on('click', '#liveGood', function () {


            var live_id;

            $.get('<?php echo U("ArticleTool/good");?>', { live_id: '<?php echo ($live_info["live_id"]); ?>' }, function (res) {


                res = JSON.parse(res);
                console.log(res);

                if (res.res > 0) {
                    //点赞成功
                    var count = parseInt($('#liveGoodCount').text());
                    $('#liveGoodCount').text(++count);
                }
                if (res.res == 0) {
                    //点赞失败
                    layer.msg('点赞失败，可能网络有问题~');
                }
                if (res.res == -1) {
                    //点赞失败
                    layer.msg('你已经点过赞了~');
                }
                if (res.res == -999) {
                    //点赞失败
                    layer.msg('请登录后再操作~');
                }

            });


        });

        /**
        删除评论
        */
        $(document).on('click', '.del-r', function () {


            var herf = $(this).attr('data-href');
            var $this = $(this);
            console.log(herf);

            $.get(herf, {}, function (res) {
                console.log(res);


                if (res == 1) {
                    //成功
                    // $this.parents('.comment-item').remove();


                    if ($this.attr('data-type') == 'replay') {

                        $this.parents('.reply-item').slideUp(function () {
                            $this.parents('.reply-item').remove();
                        });
                        console.log('删除回复');
                    } else {
                        $this.parents('.comment-item').slideUp(function () {
                            $this.parents('.comment-item').remove();
                        });

                    }




                    layer.msg('删除成功~');

                }
                if (res == -1) {
                    layer.msg('删除失败~');
                }

            });


        });
        // 
        //回复功能
        $(document).on('click', '.post-reply', function () {

            // <div class="row reply">
            //                                 <div class="col-lg-12">
            //                                     <div class="input-group">
            //                                         <input type="text" class="form-control" placeholder="回复">
            //                                         <span class="input-group-btn">
            //                                             <button class="btn btn-default" type="button" class="post-reply">发送!</button>
            //                                         </span>
            //                                     </div>
            //                                     <!-- /input-group -->
            //                                 </div>
            //                                 <!-- /.col-lg-6 -->
            //                             </div>
            //                             <!-- /.row -->

            var $this = $(this);
            var id = $(this).attr('data-id');
            var $input = $(this).parents('.input-group').find('.form-control');

            var $replyBox = $this.parents('.row.reply').prev('.reply-box');

            console.log($input.val());

            if ($input.val() != null && $input.val() != '') {

                $.post('<?php echo U("Comment/reply");?>', {
                    "super_id": id,
                    "content": $input.val(),
                    "live_id": "<?php echo ($live_info["live_id"]); ?>"
                }, function (res) {
                    $replyBox.show();

                    console.log(res);

                    res = JSON.parse(res);
                    console.log(res);

                    if (res.res == 0) {
                        //成功
                        layer.msg('回复成功~');



                        var dom = $('\
                            <li class= "reply-item" >\
                                <span>\
                                    <a href="" target="_blank">\
                                        [asdasd | 2017年11月21日]\
                                    </a>\
                                </span>：<span class="content"></span>\
                             </li >\
                            ');

                        dom.find('a').text('[' + res.msg.user_name + ' | ' + res.msg.add_time + ']');
                        dom.find('a').attr('href', res.msg.url);
                        dom.find('.content').html($input.val());
                        $input.val('');
                        $replyBox.prepend(dom);

                    }

                    if (res.res == -1) {
                        layer.msg('回复失败~');
                    }
                    if (res.res == -999) {
                        layer.msg('请登录后再回复~');
                    }

                });

            } else {
                layer.msg('没有输入内容~');

            }




        });





    </script>
</body>

</html>