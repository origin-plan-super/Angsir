<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0037)http://www.wealink.com/passport/login -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>angsir网</title>
    <meta name="keywords" content="angsir网">
    <meta name="description" content="angsir网">
    <meta name="baidu_ssp_verify" content="012083dea3cb5ea1b27406bc9fe3dc22">



    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <!-- page Common css file -->

    <link href="/Public/dist/css/basic.css" rel="stylesheet" type="text/css">
    <link href="/Public/dist/css/public.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" async="" src="/Public/dist/js/ga.js"></script>
    <script type="text/javascript" async="" src="/Public/dist/js/atrk.js"></script>
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

    <script src="/Public/dist/js/jquery-1.11.3.min.js"></script>
    <script src="/Public/dist/js/user.agent.js"></script>
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

    <script src="/Public/dist/js/jquery.validate.min.js"></script>
    <!-- Start Alexa Certify Javascript -->
    <script type="text/javascript">
        _atrk_opts = { atrk_acct: "qjU9k1a0Sn00MA", domain: "wealink.com", dynamic: true };
        (function () { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js"; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(as, s); })();
    </script>

    <!-- End Alexa Certify Javascript -->
    <!-- page private css file -->

    <link href="/Public/dist/css/verification.css" rel="stylesheet" type="text/css">


</head>

<body>
    <!-- header start-->

    <div class="header" id="header">
        <div class="wrap">
            <div class="login-box fl-right">
                <!-- 已登录 -->
                <div class="login js_navlogin " loginstate="1">
                    <p>
                        <span class="user-name">小王</span>
                        <span class="user-gravatar">
                            <img src="/Public/dist/image/gravatar-default.jpg" class="img-responsive" alt="Responsive image" widht="20" height="20"> </span>
                    </p>
                    <div class="nav-userlist js_navuserlist ">
                        <p>
                            <a href="<?php echo U('Center/Center');?>">个人中心</a>
                        </p>

                        <p>
                            <a href="#/passport/manage">账号管理</a>
                        </p>
                        <p class="btn-logout">
                            <a href="#/passport/logout" class="btn-logout">退出</a>
                        </p>
                    </div>

                </div>
                <!-- 未登录 -->

            </div>

            <a class="bl-logo" href="#/">angsir网</a>

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

                <!--  <li><a href="#/about/mobile/index">手机版</a></li>-->
            </ul>
        </div>
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

                    <form action="http://www.wealink.com/passport/login" id="login_form" name="login" class="form-signin ptb20" method="post">
                        <input type="hidden" id="callback" name="callback" value="/">
                        <ul class="form-list1">
                            <h4 class="v2-tab1">
                                <i class="ico ico-square"></i>发布经历</h4>
                            <li class="label-inline1">
                                <label for="username" class=" fz-14 fbt">行&nbsp;&nbsp;业：</label>
                                <div class="select_pop js_popindustry" maxselectcount="3" style="width:422px" selecttxt="行业">
                                    <i class="ico_select_pop"></i>
                                    <input class="form-control control-sm js_pop_text" placeholder="" name="industry[text]" type="text" value="" readonly=""
                                        style="width:400px">
                                    <input class="form-control control-sm js_pop_val" placeholder="" id="" name="industry[id]" type="hidden" style="width:400px">
                                </div>
                            </li>
                            <li class="label-inline1">
                                <label for="username" class=" fz-14 fbt">职&nbsp;&nbsp;位：</label>
                                <div class="select_pop js_popjobduty" maxselectcount="3" style="width:422px" selecttxt="职能">
                                    <i class="ico_select_pop"></i>
                                    <input class="form-control control-sm js_pop_text" placeholder="" name="duty[text]" type="text" value="" readonly="" style="width:400px">
                                    <input class="form-control control-sm js_pop_val" placeholder="" id="" name="duty[id]" type="hidden" style="width:400px">
                                </div>
                            </li>

                            <li class="label-inline1">
                                <label for="username" class="   fz-14" style="width:300px">该行业或该职位有无相关证书，是否必须持证上岗：</label>

                                <label>
                                    <input type="radio" name="RadioGroup1" value="是" id="RadioGroup1_0" /> 是
                                </label>

                                <label>
                                    <input type="radio" name="RadioGroup1" value="否" id="RadioGroup1_1" /> 否
                                </label>


                            </li>
                            <li class="label-inline1">
                                <label for="username" class=" fz-14 fbt">入职时间：</label>
                                <input type="text" id="username" name="username" value="" class="form-control  w-400 js_validate"> （年/月） &nbsp;&nbsp; </li>
                            <li class="label-inline1">
                                <label for="username" class=" fz-14 fbt">在该岗位时间：</label>
                                <input type="text" id="username" name="username" value="" class="form-control  w-400  js_validate"> </li>
                            <li class="label-inline1">
                                <label for="username" class=" fz-14 fbt">入职薪资：</label>
                                <input type="text" id="username" name="username" value="" class="form-control  w-400 js_validate">
                            </li>
                            <li class="label-inline1">
                                <label for="username" class=" fz-14 fbt">3～5年后薪资：</label>
                                <input type="text" id="username" name="username" value="" class="form-control  w-400  js_validate">

                                <label>
                                    <input type="radio" name="RadioGroup1" value="税前" id="RadioGroup1_0" /> 税前
                                </label>

                                <label>
                                    <input type="radio" name="RadioGroup1" value="税后" id="RadioGroup1_1" /> 税后
                                </label>

                                <label>
                                    <input type="radio" name="RadioGroup2" value="有灰色收入" id="RadioGroup2_2" /> 有灰色收入
                                </label>

                                <label>
                                    <input type="radio" name="RadioGroup2" value="无灰色收入" id="RadioGroup2_3" /> 无灰色收入
                                </label>


                            </li>
                            <li class="label-inline1">
                                <label for="username" class=" fz-14 fbt">地&nbsp;&nbsp;点：</label>
                                <input type="text" id="username" name="username" value="" class="form-control  w-400 js_validate"> </li>

                            <li class="label-inline1">
                                <label for="username" class=" fz-14 fbt">是否经常加班：</label>
                                <label>
                                    <input type="radio" name="RadioGroup1" value="是" id="RadioGroup1_0" /> 是
                                </label>
                                <input type="text" id="username" name="username" value="" class="form-control  w-300 js_validate">（加班频率和加班时间，以及是否有加班工资）&nbsp; &nbsp;
                                <label>
                                    <input type="radio" name="RadioGroup1" value="否" id="RadioGroup1_1" /> 否
                                </label>
                            </li>

                            <li class="label-inline1">
                                <label for="username" class=" fz-14 fbt">工作环境：</label>
                                <input type="text" id="username" name="username" value="" class="form-control  w-400 js_validate"> </li>
                            <li class="label-inline1">
                                <label for="username" class=" fz-14 fbt">人际氛围：</label>
                                <input type="text" id="username" name="username" value="" class="form-control  w-400 js_validate"> </li>

                            <li class="label-inline1">
                                <label for="username" class=" fz-14 fbt">工作中男女比例：</label>
                                <input type="text" id="username" name="username" value="" class="form-control  w-400 js_validate"> </li>
                            <li class="label-inline1">
                                <label for="username" class=" fz-14 fbt">人员流动是否频繁：</label>
                                <input type="text" id="username" name="username" value="" class="form-control  w-400  js_validate"> </li>
                            <li class="label-inline1">
                                <label for="username" class=" fz-14 fbt">上升空间及发展前景：&nbsp;</label>
                                <textarea cols="" rows="5" class=" w-400 ">        </textarea>
                            </li>
                            <li class="label-inline1">
                                <label for="username" class=" fz-14 fbt">需要接触哪些方面的人：</label>
                                <textarea cols="" rows="5" class=" w-400 ">        </textarea> （老板/主管/客户/供应商/下属/同事）
                            </li>
                            <li class="label-inline1">
                                <label for="username" class=" fz-14 fbt">典型的一天工作：&nbsp;&nbsp;&nbsp;</label>
                                <textarea cols="" rows="5" class=" w-400 ">        </textarea>
                            </li>
                            <li class="label-inline1">
                                <label for="username" class=" fz-14 fbt">什么时候压力最大：&nbsp;&nbsp;</label>
                                <textarea cols="" rows="5" class=" w-400 ">        </textarea>
                            </li>
                            <li class="label-inline1">
                                <label for="username" class=" fz-14 fbt">想对后来人说点什么：&nbsp;</label>
                                <textarea cols="" rows="5" class=" w-400 ">        </textarea>
                            </li>
                            <li class="label-inline1">
                                <label for="username" class=" fz-14 fbt">一则自己亲身经历的职场故事：</label>
                                <textarea cols="" rows="10" class=" w-400 ">        </textarea>
                            </li>

                            <li class="mt20 fb">
                                <input type="submit" id="login_submit" value="发布经历" class="btn btn-primary btn-lg btn-block mlr0 fb " style="width:300px;"> </li>

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
    <div class="clear"></div>
    <div class="footer" id="js_footer">
        <div class="wrap">
            <div class="footer-link-list" style="padding-right: 0px; text-align: center;">
                <p class="footer-li1" style="float:none;">
                    <a href="#/about/about/index">关于angsir网</a>|
                    <a href="#/about/about/contactUs">联系我们</a>|
                    <a href="#/about/about/joinUs">加入我们</a>|
                    <a href="#/about/about/help">帮助中心</a>

                </p>
                <p class="footer-li2" style="line-height: 25px; float:none;">Copyright©2005-2015 angsir网 沪ICP备05050523号</p>
                <div style="text-align: center; padding:5px 0;">
                    <a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=31010102002503" style="display:inline-block;text-decoration:none;height:20px;line-height:20px;">
                        <p style="float:left;height:20px;line-height:20px;margin: 0px 0px 0px 5px; color:#939393;">
                            <img src="/Public/dist/image/picp_bg_new.png" alt="沪公网备" border="0" style="margin-right: 5px; margin-top:-3px;">沪公网安备 31010102002503号</p>
                    </a>
                </div>

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
                            <form action="http://www.wealink.com/passport/login" id="login_form" name="login" class="form-signin ptb20" method="post">
                                <input type="hidden" id="callback" name="callback" value="/passport/login">
                                <ul class="form-list1">
                                    <li class="label-inline1">
                                        <label for="username" class="label-1 fz-14">账 号</label>
                                        <input type="text" id="username" name="username" value="" class="form-control w-248 js_validate" placeholder="邮箱或手机号"> </li>

                                    <li class="label-inline1">
                                        <label for="password" class="label-1 fz-14">密 码</label>
                                        <input type="password" id="password" name="password" value="" class="form-control w-248 js_validate" placeholder="6-16个字符，不能有空格，区分大小写"
                                            autocomplete="off"> </li>
                                    <li>
                                        <a href="http://www.wealink.com/passport/password/findPassword" class="fl-right">找回密码</a>
                                        <label>
                                            <input type="checkbox" name="remember" checked=""> 下次自动登录
                                        </label>
                                    </li>
                                    <li class="mt20">
                                        <input type="submit" id="login_submit" value="登 录" class="btn btn-primary btn-lg btn-block mlr0" onclick="javascript:_gaq.push([&#39;_trackEvent&#39;, &#39;login_window&#39;, &#39;login&#39;])"> </li>
                                    <li class="tx-right">
                                        没有账号，
                                        <a target="_blank" href="http://www.wealink.com/passport/register" class="fc-orange1" onclick="javascript:_gaq.push([&#39;_trackEvent&#39;, &#39;login_window&#39;, &#39;switch_register&#39;])">立即注册</a>
                                    </li>
                                </ul>
                            </form>
                        </div>
                        <div class="signin-bottom">

                        </div>
                        <div class="clear"></div>

                    </div>
                </div>
            </div>
        </div>
        <!-- 登录弹出层 end -->

        <!--  Common js file -->
        <script src="/Public/dist/js/jquery.ba-resize.js"></script>
        <script src="/Public/dist/js/basic.js"></script>
        <script src="/Public/dist/js/bl_jsvalidate.js"></script>
        <script src="/Public/dist/js/uuid.js"></script>

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

        <script src="/Public/dist/js/new_city.js"></script>
        <script src="/Public/dist/js/new_job_duty.js"></script>
        <script src="/Public/dist/js/new_industry.js"></script>
        <script src="/Public/dist/js/data_type.js"></script>
        <script src="/Public/dist/js/play.js"></script>

        <!-- footer end-->

</body>

</html>