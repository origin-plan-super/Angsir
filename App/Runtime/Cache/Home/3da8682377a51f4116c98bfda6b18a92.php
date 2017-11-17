<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--  main layout -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>angsir网</title>
    <meta name="keywords" content="angsir网">
    <meta name="description" content="angsir网">
    <meta name="baidu_ssp_verify" content="012083dea3cb5ea1b27406bc9fe3dc22">

    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <!-- page Common css file -->
    <script src="/Public/vendor/vue/vue.js"></script>

    <link href="/Public/dist/css/basic.css" rel="stylesheet" type="text/css">
    <link href="/Public/dist/css/public.css" rel="stylesheet" type="text/css">
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



    <!-- End Alexa Certify Javascript -->
    <link href="/Public/dist/css/search.css" rel="stylesheet" type="text/css">
    <!-- 请置于所有广告位代码之前 -->


</head>

<body>
    <!-- header start-->

    <script src="/Public/dist/js/js.cookie.js"></script>
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
    <link href="/Public/vendor/layui/css/layui.css" rel="stylesheet" type="text/css">
<script src="/Public/vendor/layui/layui.js"></script>
<style>
    .m-right1 .text-list3 span {
        width: auto;
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
                    <p>
                        <span class="user-name"><?php echo (session('user_name')); ?></span>
                        <span class="user-gravatar">
                            <img src="<?php echo (session('user_img')); ?>" onerror='this.src="/Public/dist/image/gravatar-default.jpg"' class="img-responsive" alt="Responsive image"
                                widht="20" height="20"> </span>
                    </p>
                    <div class="nav-userlist js_navuserlist ">
                        <p>
                            <a href="<?php echo U('Center/Center');?>">个人中心</a>rw
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
                                <a href="#passport/password/findPassword" class="fl-right">找回密码</a>
                                <label for="remember">
                                    <input type="checkbox" name="remember" checked="" lay-skin='primary'> 下次自动登录
                                </label>
                            </li>
                            <li class="mt20">
                                <input lay-submit type="button" lay-filter="login" value="登 录" class="btn btn-primary btn-lg btn-block mlr0">

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
                            <li class="label-inline1 hidden" id="user_code_box">
                                <label for="user_code" class="label-1 fz-14">验证码</label>
                                <input type="text" id="user_code" name="user_code" value="" class="form-control w-248 js_validate" placeholder="6-16个字符，不能有空格，区分大小写"
                                    autocomplete="off">
                            </li>

                            <li class="mt20">
                                <input lay-submit type="button" lay-filter="reg" value="发送验证码到邮箱" class="btn btn-primary btn-lg btn-block mlr0">
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
        //各种基于事件的操作，下面会有进一步介绍

        form.on('submit(reg)', function (data) {
            // console.log(data.elem) //被执行事件的元素DOM对象，一般为button对象
            // console.log(data.form) //被执行提交的form对象，一般在存在form标签时才会返回
            field = data.field; //当前容器的全部表单字段，名值对形式：{name: value}
            var user_id = data.field.user_id;

            if ($(data.elem).val() == '发送验证码到邮箱') {
                //发送验证码
                $(data.elem).val('注册');
                $('#user_code_box').removeClass('hidden');
                $('#user_code').attr('lay-verify', 'required');
                var index = layer.load(2);
                $.get('<?php echo U("Email/sendCode");?>', {
                    user_id: user_id
                }, function (res) {
                    layer.close(index);

                    res = JSON.parse(res);

                    if (res.res == 0) {
                        // 成功
                        layer.msg('发送成功，快去查看吧~');
                    }
                    if (res.res == -1) {
                        //失败
                        layer.msg('发送失败，请重新发送~');
                    }
                    if (res.res == -2) {
                        //失败
                        layer.msg('邮箱已经注册~');
                    }
                });
                return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。

            }
            if ($(data.elem).val() == '注册') {
                var index = layer.load(2);
                $.post("<?php echo U('Login/reg');?>", field, function (res) {

                    layer.close(index);
                    res = JSON.parse(res);
                    console.log(res);


                    if (res.res == 0) {
                        // 注册成功
                        layer.msg('注册成功~');
                        console.log('location');
                        console.log(location);
                        console.log('location.replace');
                        console.log(location.replace);
                        console.log('location.href');
                        console.log(location.href);
                        setTimeout(function () {
                            window.location.replace(window.location.href);
                        }, 200);

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
                    if (res.res == -5) {
                        //5：验证码错误
                        layer.msg('验证码错误~');
                        $(data.elem).val('发送验证码到邮箱');
                    }
                });
            }
        });
        form.on('submit(login)', function (data) {
            // console.log(data.elem) //被执行事件的元素DOM对象，一般为button对象
            // console.log(data.form) //被执行提交的form对象，一般在存在form标签时才会返回
            field = data.field; //当前容器的全部表单字段，名值对形式：{name: value}
            $.post("<?php echo U('Login/login');?>", field, function (res) {

                res = JSON.parse(res);

                if (res.res == 0) {
                    // 登录成功
                    layer.msg('登录成功~');
                    setTimeout(function () {
                        window.location.replace(window.location.href);
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
            <img src="/Public/dist/image/ico_arrowup.png" alt="" data-bd-imgshare-binded="1">
            <span class="img-hover">
                <img src="/Public/dist/image/ico_arrowup_color.png" alt="" data-bd-imgshare-binded="1">
            </span>
        </p>
        <p class="sb-txt1">回到顶部</p>
    </a>

    <a href="javascript:;">
        <p class="sb-img">
            <img src="/Public/dist/image/ico_sb_qr.png" alt="" data-bd-imgshare-binded="1">
            <span class="img-hover">
                <img src="/Public/dist/image/ico_sb_qr_color.png" alt="" data-bd-imgshare-binded="1">
            </span>
        </p>
        <p class="sb-txt1">关注微信</p>
        <div class="sb-hover">
            <i class="tips1"></i>
            <i class="tips-arrow"></i>
            <p class="qr-box">
                <img src="/Public/dist/image/bl_weixin.jpg" alt="" class="js_bl_qr_weixin" data-bd-imgshare-binded="1"> </p>
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

    <div class="main">
        <div class="wrap">
            <div id="_qs31qxs5p5"></div>
            <!-- <div class="m-left4">
                <div class="s-ebox1 pos-search">
                    <form id="pos_search_form" name="pos_search_form" action="#/zhiwei/search/url" class="layui-form">
                        <div class="ebox-input">
                            <input autocomplete="off" class="form-control bor-c-green ajaxSearch" type="text" placeholder="请输入关键字，关键字之间用空格分割" name="query_key"
                                id="query_key">
                            <div class="clear"></div>
                        </div>
                        <div class="ebox-tag">
                            <span class="pos-search-tag-title">热门搜索：</span>
                            <a href="#/zhaopin/kw-%E5%9F%B9%E8%AE%AD%E8%AE%B2%E5%B8%88/">
                                <strong>培训讲师</strong>
                            </a>
                            <a href="#/zhaopin/kw-%E9%A2%84%E7%BB%93%E7%AE%97%E5%91%98/">
                                <strong>预结算员</strong>
                            </a>
                            <a href="#/zhaopin/kw-%E6%95%99%E5%B8%88/">
                                <strong>教师</strong>
                            </a>
                            <a href="#/zhaopin/kw-%E6%8A%A4%E5%A3%AB/">
                                <strong>护士</strong>
                            </a>
                            <a href="#/zhaopin/kw-%E8%B4%A7%E8%BF%90%E4%BB%A3%E7%90%86/">
                                <strong>货运代理</strong>
                            </a>
                            <a href="#/zhaopin/kw-%E5%8C%BB%E7%96%97%E6%9C%BA%E6%A2%B0/">
                                <strong>医疗机械</strong>
                            </a>
                            <a href="#/zhaopin/kw-%E7%94%9F%E7%89%A9%E5%88%B6%E8%8D%AF/">
                                <strong>生物制药</strong>
                            </a>
                            <a href="#/zhaopin/kw-%E8%90%A5%E8%BF%90%E7%BB%8F%E7%90%86/">
                                <strong>营运经理</strong>
                            </a>
                            <a href="#/zhaopin/kw-%E9%A1%B9%E7%9B%AE%E6%80%BB%E7%9B%91/">
                                <strong>项目总监</strong>
                            </a>
                            <a href="#/zhaopin/kw-%E8%84%9A%E6%9C%AC%E5%BC%80%E5%8F%91/">
                                <strong>脚本开发</strong>
                            </a>

                        </div>

                        <div class="ebox-condition">
                            <div class="select_pop js_popcity" maxselectcount="3" selecttxt="工作地点">
                                <i class="ico_select_pop"></i>
                                <input class="form-control control-sm js_pop_text" placeholder="工作地点" id="" name="city_text" type="text" value="" readonly="">
                                <input class="form-control control-sm js_pop_val" placeholder="" id="" name="city_id" type="hidden">
                            </div>
                            <div class="select_pop js_popjobduty" maxselectcount="3" selecttxt="职能">
                                <i class="ico_select_pop"></i>
                                <input class="form-control control-sm js_pop_text" placeholder="职能" name="duty_text" type="text" value="" readonly="">
                                <input class="form-control control-sm js_pop_val" placeholder="" id="" name="duty_id" type="hidden">
                            </div>
                            <div class="select_pop js_popindustry" maxselectcount="3" selecttxt="行业">
                                <i class="ico_select_pop"></i>
                                <input class="form-control control-sm js_pop_text" placeholder="行业" name="industry_text" type="text" value="" readonly="">
                                <input class="form-control control-sm js_pop_val" placeholder="" id="" name="industry_id" type="hidden">
                            </div>
                        </div>

                        <div class="ebox-btn">

                            <a href="javascript:;" lay-submit class="btn btn-orange w-220" lay-filter="*">搜索</a>
                        </div>
                        <div id="test"></div>
                    </form>
                </div>
                <div class="" id="turnwrap1">
                    <div class="change-tab2">
                        <a href="javascript:;" tabid="0">按阅读量
                            <img src="/Public/dist/image/up.png" width="18" height="15" style="margin-top:-5px" />
                        </a>
                        <a href="javascript:;" tabid="1">按点赞数
                            <img src="/Public/dist/image/up.png" width="18" height="15" style="margin-top:-5px" />
                        </a>

                    </div>
                    <div id="turncon1">
                        <div class="li_page">
                            <ul class="ullist-1 js_agent" agenttag="li" id="infoApp">
                                <li :agenturl="getUrl(item.live_id)" agenttarget="_blank" v-for='(item,index) in items' :key='item.live_id'>
                                    <h2 title="" class="ulli-1-title">
                                        <a target="_blank" href="#" title="销售工程师">{{item.title}}</a>
                                    </h2>
                                    <div class="txt-inline1">
                                        <p>
                                            <span>行业：</span>
                                            {{item.industry_text}} </p>
                                        <p>
                                            <span>入职时间：</span>{{item.entry_time}}</p>
                                        <p>
                                            <span>在该岗位时间：</span>{{item.in_job_time}}</p>
                                        <p>
                                            <span>入职薪资：</span>
                                            {{item.salary}}元 </p>
                                        <p class="p-w100">
                                            <span>3～5年后薪资：</span>
                                            {{item.year_3_5_salary}} {{item.salary_type_0}} {{item.salary_type_1}} </p>
                                        <p>
                                            <span>地点：</span>
                                            {{item.location}} </p>
                                        <p>
                                            <span>上班/下班时间：</span>
                                            09：00~17：00 </p>
                                        <div class="clear"></div>
                                    </div>
                                    <p class="fc-gray">{{getTime(item.edit_time)}}发布
                                        <a class="btn btn-sm  w-110 xx btn-green3" target="_blank" :href="getUrl(item.live_id)">查看详情</a>
                                    </p>
                                    <p class="mt20 xx">
                                        <div class="clear"></div>
                                </li>

                            </ul>
                            <div class="pages_more">
                                <botton href="#" id="getMore" class="more btn btn-info">查看更多经历&gt;&gt;</botton>
                            </div>
                        </div>

                    </div>
                </div>
            </div> -->

            <div class="m-left4 " id="searchBox">
    <div class="s-ebox1 pos-search">
        <form id="pos_search_form" name="pos_search_form" action="#/zhiwei/search/url" class="layui-form">
            <div class="ebox-input">
                <input autocomplete="off" class="form-control bor-c-green ajaxSearch" type="text" placeholder="请输入关键字，关键字之间用空格分割" name="query_key"
                    id="query_key">
                <div class="clear"></div>
            </div>
            <div class="ebox-tag">
                <span class="pos-search-tag-title">热门搜索：</span>
                <a href="#/zhaopin/kw-%E5%9F%B9%E8%AE%AD%E8%AE%B2%E5%B8%88/">
                    <strong>培训讲师</strong>
                </a>
                <a href="#/zhaopin/kw-%E9%A2%84%E7%BB%93%E7%AE%97%E5%91%98/">
                    <strong>预结算员</strong>
                </a>
                <a href="#/zhaopin/kw-%E6%95%99%E5%B8%88/">
                    <strong>教师</strong>
                </a>
                <a href="#/zhaopin/kw-%E6%8A%A4%E5%A3%AB/">
                    <strong>护士</strong>
                </a>
                <a href="#/zhaopin/kw-%E8%B4%A7%E8%BF%90%E4%BB%A3%E7%90%86/">
                    <strong>货运代理</strong>
                </a>
                <a href="#/zhaopin/kw-%E5%8C%BB%E7%96%97%E6%9C%BA%E6%A2%B0/">
                    <strong>医疗机械</strong>
                </a>
                <a href="#/zhaopin/kw-%E7%94%9F%E7%89%A9%E5%88%B6%E8%8D%AF/">
                    <strong>生物制药</strong>
                </a>
                <a href="#/zhaopin/kw-%E8%90%A5%E8%BF%90%E7%BB%8F%E7%90%86/">
                    <strong>营运经理</strong>
                </a>
                <a href="#/zhaopin/kw-%E9%A1%B9%E7%9B%AE%E6%80%BB%E7%9B%91/">
                    <strong>项目总监</strong>
                </a>
                <a href="#/zhaopin/kw-%E8%84%9A%E6%9C%AC%E5%BC%80%E5%8F%91/">
                    <strong>脚本开发</strong>
                </a>

            </div>

            <div class="ebox-condition">
                <div class="select_pop js_popcity" maxselectcount="3" selecttxt="工作地点">
                    <i class="ico_select_pop"></i>
                    <input class="form-control control-sm js_pop_text" placeholder="工作地点" id="" name="city_text" type="text" value="" readonly="">
                    <input class="form-control control-sm js_pop_val" placeholder="" id="" name="city_id" type="hidden">
                </div>
                <div class="select_pop js_popjobduty" maxselectcount="3" selecttxt="职能">
                    <i class="ico_select_pop"></i>
                    <input class="form-control control-sm js_pop_text" placeholder="职能" name="duty_text" type="text" value="" readonly="">
                    <input class="form-control control-sm js_pop_val" placeholder="" id="" name="duty_id" type="hidden">
                </div>
                <div class="select_pop js_popindustry" maxselectcount="3" selecttxt="行业">
                    <i class="ico_select_pop"></i>
                    <input class="form-control control-sm js_pop_text" placeholder="行业" name="industry_text" type="text" value="" readonly="">
                    <input class="form-control control-sm js_pop_val" placeholder="" id="" name="industry_id" type="hidden">
                </div>
            </div>

            <div class="ebox-btn">
                <!-- <div class="fl-right">                  
            <input class="btn_link fc-blue3" type="reset" value="重置">
        </div> -->
                <a href="javascript:;" lay-submit class="btn btn-orange w-220" lay-filter="*">搜索</a>
            </div>
            <div id="test"></div>
        </form>
    </div>
    <div class="" id="infoApp">
        <?php if(index == 'index' ): ?><div class="change-tab2">
                <a href="javascript:;" tabid="0">热门经历</a>
            </div>
            <?php else: ?>
            <div class="change-tab2">
                <a href="javascript:;" tabid="0" @click='setType("read")'>按阅读量
                    <img src="/Public/dist/image/up.png" width="18" height="15" style="margin-top:-5px" />
                </a>
                <a href="javascript:;" tabid="1" @click='setType("good")'>按点赞数
                    <img src="/Public/dist/image/up.png" width="18" height="15" style="margin-top:-5px" />
                </a>
            </div><?php endif; ?>



        <div id="turncon1 hidden">
            <div class="li_page">
                <ul class="ullist-1 js_agent" agenttag="li">
                    <!-- <li agenturl="/zhiwei/view/29546736/" agenttarget="_blank">
                            <h2 title="" class="ulli-1-title">
                                <a target="_blank" href="#" title="销售工程师">销售工程师</a>
                            </h2>
                            <div class="txt-inline1">
                                <p>
                                    <span>行业：</span>
                                    制造业 </p>
                                <p>
                                    <span>入职时间：</span>2009/10</p>
                                <p>
                                    <span>在该岗位时间：</span>6年</p>
                                <p>
                                    <span>入职薪资：</span>
                                    3000元 </p>
                                <p class="p-w100">
                                    <span>3～5年后薪资：</span>
                                    8k~9K 税前 无灰色收入 </p>
                                <p>
                                    <span>地点：</span>
                                    上海 </p>
                                <p>
                                    <span>上班/下班时间：</span>
                                    09：00~17：00 </p>
                                <div class="clear"></div>
                            </div>
                            <p class="fc-gray">2017-09-05发布
                                <a class="btn btn-sm  w-110 xx btn-green3" target="_blank" href="#">查看详情</a>
                            </p>
                            <p class="mt20 xx">
                                <div class="clear"></div>
                        </li> -->
                    <li :agenturl="getUrl(item.live_id)" agenttarget="_blank" v-for='(item,index) in items' :key='item.live_id'>
                        <h2 title="" class="ulli-1-title">
                            <a target="_blank" :href="getUrl(item.live_id)" title="销售工程师">{{item.title}}</a>
                        </h2>
                        <div class="txt-inline1">
                            <p>
                                <span>行业：</span>
                                {{item.industry_text}} </p>
                            <p>
                                <span>入职时间：</span>{{item.entry_time}}</p>
                            <p>
                                <span>在该岗位时间：</span>{{item.in_job_time}}</p>
                            <p>
                                <span>入职薪资：</span>
                                {{item.salary}}元 </p>
                            <p class="p-w100">
                                <span>3～5年后薪资：</span>
                                {{item.year_3_5_salary}} {{item.salary_type_0}} {{item.salary_type_1}} </p>
                            <p>
                                <span>地点：</span>
                                {{item.location}} </p>
                            <p>
                                <span>上班/下班时间：</span>
                                09：00~17：00 </p>
                            <div class="clear"></div>
                        </div>
                        <p class="fc-gray">{{getTime(item.edit_time)}}发布
                            <a class="btn btn-sm  w-110 xx btn-green3" target="_blank" :href="getUrl(item.live_id)">查看详情</a>
                        </p>
                        <p class="mt20 xx">
                            <div class="clear"></div>
                    </li>

                </ul>
                <div class="pages_more">
                    <botton id="getMore" class="more btn btn-info">查看更多经历&gt;&gt;</botton>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    var infoApp = new Vue({
        el: '#infoApp',
        data: {
            items: [],
            queryDate: [],
            type: 'read',
        },
        methods: {
            update: function (f) {
                var _this = this;

                $.get('<?php echo U("Query/getInit");?>', {
                    type: _this.type,
                }, function (res) {
                    res = JSON.parse(res);
                    console.log(res);
                    _this.items = [];
                    if (res.res > 0) {
                        // 有数据
                        _this.items = res.msg;
                    }

                    if (f != null) {
                        f();
                    }

                });

            },
            query: function (queryDate) {
                var load = layer.load(1); //换了种风格
                if (queryDate != null) {
                    this.queryDate = queryDate;
                }

                /**
                 * start：开始的位置
                 * num：一次显示多少,
                 * queryDate：搜索的数据
                 * 
                */
                var _this = this;
                this.queryDate.start = 0;
                this.queryDate.num = 2;
                this.queryDate.type = this.type;
                $.get('<?php echo U("Query/query");?>', this.queryDate, function (res) {
                    _this.items = [];


                    res = JSON.parse(res);
                    layer.close(load);
                    if (res.res > 0) {
                        // 有数据
                        _this.items = res.msg;
                        layer.msg('找到了' + res.res + '条数据~');
                    }
                    if (res.res < 1) {
                        // 没有相关数据
                        layer.msg('没有相关数据~');
                    }
                });
            },
            addQuery: function (queryDate) {

                if (queryDate != null) {
                    this.queryDate = queryDate;
                }


                /**
                 * start：开始的位置
                 * num：一次显示多少,
                 * queryDate：搜索的数据
                 * f
                 */
                var _this = this;
                this.queryDate.start += 2;
                this.queryDate.type = this.type;
                $.get('<?php echo U("Query/query");?>', this.queryDate, function (res) {

                    // $('#test').html(res);
                    res = JSON.parse(res);
                    console.log(res);
                    if (res.res > 0) {
                        // 有数据
                        layer.msg('更新了' + res.res + '条数据~');
                        for (var x in res.msg) {
                            _this.items.push(res.msg[x]);
                        }
                    }
                    if (res.res < 1) {
                        // 已经没有数据了
                        layer.msg('已经没有更多数据了~');
                    }
                });
            },
            getTime: function (time) {
                return time;
            },
            getUrl: function (id) {
                return '<?php echo U("Article/article","","");?>' + '/live_id/' + id;
            },
            setType: function (type) {
                this.type = type;
                this.update();
            }
        }




    });
    infoApp.update(function () {
        $('#turncon1').removeClass('hidden');
    });
    $(document).on('click', '#getMore', function () {
        infoApp.addQuery();
    });


    //搜索处理
    layui.use('form', function () {

        var form = layui.form;
        //各种基于事件的操作，下面会有进一步介绍

        form.on('submit(*)', function (data) {
            // console.log(data.elem) //被执行事件的元素DOM对象，一般为button对象
            // console.log(data.form) //被执行提交的form对象，一般在存在form标签时才会返回
            // console.log(data.field) //当前容器的全部表单字段，名值对形式：{name: value}

            // city_id
            // city_text
            // duty_id
            // duty_text
            // industry_id
            // industry_text
            // query_key

            // duty_id
            // "23001,23004,23007"

            // duty_text
            // "高级软件工程师,仿真应用工程师,需求工程师"

            // industry_id
            // "32026,32028"

            // industry_text
            // "制药/生物工程,医疗设备/器械"

            //搜索关键字
            if (data.field.query_key.length >= 1) {
                var queryKey = data.field.query_key.split(/\s+/);
                for (x in queryKey) {
                    queryKey[x] = '%' + queryKey[x] + '%';
                }
            }



            //地址
            if (data.field.city_text.length >= 1) {

                var city_text = data.field.city_text.split(',');
                for (x in city_text) {
                    city_text[x] = '%' + city_text[x] + '%';
                }

            }


            //职位id
            if (data.field.duty_id.length >= 1) {

                var duty_id = data.field.duty_id.split(',');
                for (x in duty_id) {
                    duty_id[x] = '%' + duty_id[x] + '%';
                }

            }

            //行业id

            if (data.field.industry_id.length >= 1) {
                var industry_id = data.field.industry_id.split(',');
                for (var x in industry_id) {
                    industry_id[x] = '%' + industry_id[x] + '%';
                }
            }


            var queryDate = {
                queryKey: queryKey,
                city_text: city_text,
                duty_id: duty_id,
                industry_id: industry_id,
            };



            infoApp.query(queryDate);

            return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
        });

    });


</script>


            <div class="m-right4">


                <div class="i-ebox1 mt10">
                    <div class="title">
                        <i class="ico ico-square"></i>推荐会员</div>
                    <div class="conbox">
                        <ul class="i-recommend-company evenParent" even_cell="li">

                            <?php if(is_array($up_user_info)): $i = 0; $__LIST__ = $up_user_info;if( count($__LIST__)==0 ) : echo "没有被推荐的会员" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><li>
                                    <a href="#">
                                        <img src="<?php echo ($vol["user_img"]); ?>" onerror='this.src="/Public/dist/image/default_headpic.png"'>
                                    </a>
                                    <a href="#"><?php echo ($vol["user_name"]); ?></a>
                                </li><?php endforeach; endif; else: echo "没有被推荐的会员" ;endif; ?>

                        </ul>
                        <div class="clear"></div>
                    </div>
                </div>

            </div>
        </div>
        <!-- footer start-->
        <!-- footer start-->
<div class="clear"></div>
<div class="footer" id="js_footer">
    <div class="wrap">
        <div class="footer-link-list" style="padding-right: 0px; text-align: center;">
            <p class="footer-li1" style="float:none;">
                <a href="<?php echo U('Index/about');?>">关于angsir网</a>|
                <a href="<?php echo U('Index/about');?>">联系我们</a>|
                <a href="<?php echo U('Index/about');?>">加入我们</a>|
                <a href="<?php echo U('Index/about');?>">帮助中心</a>

            </p>
            <p class="footer-li2" style="line-height: 25px; float:none;">Copyright©2005-2015 angsir网 沪ICP备05050523号</p>
            <div style="text-align: center; padding:5px 0;">
                <a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=31010102002503" style="display:inline-block;text-decoration:none;height:20px;line-height:20px;">
                    <p style="float:left;height:20px;line-height:20px;margin: 0px 0px 0px 5px; color:#939393;">
                        <img src="/Public/dist/image/picp_bg_new.png" alt="沪公网备" border="0" style="margin-right: 5px; margin-top:-3px;">沪公网安备 31010102002503号</p>
                </a>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>


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
        <script src="/Public/dist/js/handlebars-v3.0.3.js"></script>




</body>

</html>