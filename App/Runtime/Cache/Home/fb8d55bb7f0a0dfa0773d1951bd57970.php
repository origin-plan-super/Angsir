<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0037)http://www.wealink.com/passport/login -->
<html xmlns="http://www.w3.org/1999/xhtml">

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

    <!--  -->
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
    <script type="text/javascript">
        _atrk_opts = { atrk_acct: "qjU9k1a0Sn00MA", domain: "wealink.com", dynamic: true };
        (function () { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js"; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(as, s); })();
    </script>

    <!-- End Alexa Certify Javascript -->
    <!-- page private css file -->

    <link href="/Angsir/code/Angsir/Public/dist/css/verification.css" rel="stylesheet" type="text/css">


</head>

<body>
    <!-- header start-->

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

    <!-- header end-->


    <!-- main start-->
    <div class="main single-login">
        <div class="wrap">
            <!-- single-login start -->
            <div class="">

                <div class="fb2">

                    <form action="" id="login_form" name="login" class="form-signin ptb20 layui-form" method="post">
                        <input type="hidden" id="callback" name="callback" value="/">
                        <ul class="form-list1">
                            <h4 class="v2-tab1">
                                <i class="ico ico-square"></i>发布经历</h4>
                            <li class="label-inline1">
                                <label for="industry" class=" fz-14 fbt">行&nbsp;&nbsp;业：</label>
                                <div class="select_pop js_popindustry" maxselectcount="3" style="width:422px" selecttxt="行业">
                                    <i class="ico_select_pop"></i>
                                    <input lay-verify='required' class="form-control control-sm js_pop_text" placeholder="" name="industry_text" type="text"
                                        value="" readonly="" style="width:400px">
                                    <input class="form-control control-sm js_pop_val" placeholder="" id="" name="industry_id" type="hidden" style="width:400px">
                                </div>
                            </li>
                            <li class="label-inline1">
                                <label for="duty" class=" fz-14 fbt">职&nbsp;&nbsp;位：</label>
                                <div class="select_pop js_popjobduty" maxselectcount="3" style="width:422px" selecttxt="职能">
                                    <i class="ico_select_pop"></i>
                                    <input lay-verify='required' class="form-control control-sm js_pop_text" placeholder="" name="duty_text" type="text" value=""
                                        readonly="" style="width:400px">
                                    <input class="form-control control-sm js_pop_val" placeholder="" id="" name="duty_id" type="hidden" style="width:400px">
                                </div>
                            </li>

                            <li class="label-inline1">
                                <label for="is_certificate" class="fz-14" style="width:300px">该行业或该职位有无相关证书，是否必须持证上岗：</label>

                                <label>
                                    <input type="radio" checked lay-ignore lay-ignore name="is_certificate" value="是" id="is_certificate_0" /> 是
                                </label>

                                <label>
                                    <input type="radio" lay-ignore name="is_certificate" value="否" id="is_certificate_1" /> 否
                                </label>


                            </li>
                            <li class="label-inline1">
                                <label for="entry_time" class=" fz-14 fbt">入职时间：</label>
                                <input lay-verify='required' type="text" id="entry_time" name="entry_time" value="" class="form-control  w-400 js_validate"
                                    placeholder="（年/月）">
                            </li>
                            <li class="label-inline1">
                                <label for="in_job_time" class=" fz-14 fbt">在该岗位时间：</label>
                                <input lay-verify='required' type="text" id="in_job_time" name="in_job_time" value="" class="form-control  w-400  js_validate"> </li>
                            <li class="label-inline1">
                                <label for="salary" class=" fz-14 fbt">入职薪资：</label>
                                <input lay-verify='required' type="text" id="salary" name="salary" value="" class="form-control  w-400 js_validate">
                            </li>
                            <li class="label-inline1">
                                <label for="year_3_5_salary" class=" fz-14 fbt">3～5年后薪资：</label>
                                <input lay-verify='required' type="text" id="year_3_5_salary" name="year_3_5_salary" value="" class="form-control  w-400  js_validate">
                                <p>
                                    <label for="year_3_5_salary" class=" fz-14 fbt">&nbsp;</label>
                                    <label>
                                        <input type="radio" checked lay-ignore name="salary_type_0" value="税前" id="salary_type_1_0" /> 税前
                                    </label>

                                    <label>
                                        <input type="radio" lay-ignore name="salary_type_0" value="税后" id="salary_type_1_1" /> 税后
                                    </label>

                                    <label>
                                        <input type="radio" checked lay-ignore name="salary_type_1" value="有灰色收入" id="salary_type_1_0" /> 有灰色收入
                                    </label>

                                    <label>
                                        <input type="radio" lay-ignore name="salary_type_1" value="无灰色收入" id="salary_type_1_1" /> 无灰色收入
                                    </label>
                                </p>

                            </li>
                            <li class="label-inline1">
                                <label for="location" class="fz-14 fbt">地&nbsp;&nbsp;点：</label>
                                <input lay-verify='required' type="text" id="location" name="location" value="" class="form-control  w-400 js_validate"> </li>
                            <li class="label-inline1">
                                <label for="is_overtime" class="fz-14 fbt">是否经常加班：</label>
                                <label>
                                    <input type="radio" checked lay-ignore name="is_overtime" value="是" id="is_overtime_0" /> 是
                                </label>
                                <input type="text" id="overtime_info" name="overtime_info" value="" class="form-control  w-300 js_validate">（加班频率和加班时间，以及是否有加班工资）&nbsp; &nbsp;
                                <p>
                                    <label for="year_3_5_salary" class=" fz-14 fbt">&nbsp;</label>
                                    <label>
                                        <input type="radio" lay-ignore name="is_overtime" value="否" id="is_overtime_1" /> 否
                                    </label>
                                </p>

                            </li>

                            <li class="label-inline1">
                                <label for="work_environment" class=" fz-14 fbt">工作环境：</label>
                                <input lay-verify='required' type="text" id="work_environment" name="work_environment" value="" class="form-control  w-400 js_validate"> </li>
                            <li class="label-inline1">
                                <label for="interpersonal_atmosphere" class=" fz-14 fbt">人际氛围：</label>
                                <input lay-verify='required' type="text" id="interpersonal_atmosphere" name="interpersonal_atmosphere" value="" class="form-control  w-400 js_validate"> </li>

                            <li class="label-inline1">
                                <label for="male_to_female_ratio" class=" fz-14 fbt">工作中男女比例：</label>
                                <input lay-verify='required' type="text" id="male_to_female_ratio" name="male_to_female_ratio" value="" class="form-control  w-400 js_validate"> </li>
                            <li class="label-inline1">
                                <label for="is_the_turnover_of_personnel_frequent" class=" fz-14 fbt">人员流动是否频繁：</label>
                                <input lay-verify='required' type="text" id="is_the_turnover_of_personnel_frequent" name="is_the_turnover_of_personnel_frequent"
                                    value="" class="form-control  w-400  js_validate">
                            </li>
                            <li class="label-inline1">
                                <label for="rising_space_and_development_prospect" class=" fz-14 fbt">上升空间及发展前景：&nbsp;</label>
                                <textarea lay-verify='required' cols="" rows="5" class=" w-400 " name="rising_space_and_development_prospect"></textarea>
                            </li>
                            <li class="label-inline1">
                                <label for="who_do_you_need_to_contact" class=" fz-14 fbt">需要接触哪些方面的人：</label>
                                <textarea lay-verify='required' cols="" rows="5" class=" w-400 " name="who_do_you_need_to_contact"></textarea>


                                <p>
                                    <label for="year_3_5_salary" class=" fz-14 fbt">&nbsp;</label>
                                    （老板/主管/客户/供应商/下属/同事）
                                </p>

                            </li>
                            <li class="label-inline1">
                                <label for="a_typical_day_work" class=" fz-14 fbt">典型的一天工作：&nbsp;&nbsp;&nbsp;</label>
                                <textarea lay-verify='required' cols="" rows="5" class=" w-400 " name="a_typical_day_work"></textarea>
                            </li>
                            <li class="label-inline1">
                                <label for="when_is_the_maximum_pressure" class=" fz-14 fbt">什么时候压力最大：&nbsp;&nbsp;</label>
                                <textarea lay-verify='required' cols="" rows="5" class=" w-400 " name="when_is_the_maximum_pressure"></textarea>
                            </li>
                            <li class="label-inline1">
                                <label for="what_do_you_want_to_say_to_later_people" class=" fz-14 fbt">想对后来人说点什么：&nbsp;</label>
                                <textarea lay-verify='required' cols="" rows="5" class=" w-400 " name="what_do_you_want_to_say_to_later_people"></textarea>
                            </li>
                            <li class="label-inline1">
                                <label for="story" class=" fz-14 fbt">一个自己亲身经历的职场故事：</label>
                                <textarea lay-verify='required' cols="" rows="10" class=" w-400 " name="story"></textarea>
                            </li>
                            <li class="label-inline1">
                                <label for="story" class=" fz-14 fbt">标 题：</label>
                                <input lay-verify='required' type="text" id="title" name="title" value="" class="form-control  w-400  js_validate">
                            </li>
                            <li class="mt20 fb">
                                <input type="submit" lay-submit value="发布经历" class="btn btn-primary btn-lg btn-block mlr0 fb " style="width:300px;">
                            </li>

                        </ul>
                    </form>
                </div>
                <div class="signin-bottom">

                </div>
                <div class="clear"></div>
            </div>
            <!-- single-login end -->
        </div>
    </div>
    <!-- main end-->

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



    <!--  Common js file -->
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

    <script src="/Angsir/code/Angsir/Public/dist/js/new_city.js"></script>
    <script src="/Angsir/code/Angsir/Public/dist/js/new_job_duty.js"></script>
    <script src="/Angsir/code/Angsir/Public/dist/js/new_industry.js"></script>
    <script src="/Angsir/code/Angsir/Public/dist/js/data_type.js"></script>
    <script src="/Angsir/code/Angsir/Public/dist/js/play.js"></script>

    <!-- footer end-->

    <script>

        layui.use('form', function () {
            var form = layui.form;

            //各种基于事件的操作，下面会有进一步介绍
        });


    </script>

</body>

</html>