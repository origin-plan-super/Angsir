<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo ($pageTitle); ?></title>
    <link href="/Public/dist/css/basic.css" rel="stylesheet" type="text/css">
    <link href="/Public/dist/css/public.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" async="" src="/Public/dist/js/atrk.js"></script>

    <script src="/Public/dist/js/jquery.ba-resize.js"></script>
    <script src="/Public/dist/js/basic.js"></script>
    <script src="/Public/dist/js/bl_jsvalidate.js"></script>
    <script src="/Public/dist/js/uuid.js"></script>

    <style>
        .box {
            width: 300px;
            margin: 0 auto;
            height: 80vh;
        }
    </style>
</head>

<body>

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

    <div class="box">
        <h1 class="text-center">
            <?php echo ($title); ?>
        </h1>
        <h2>
            <?php echo ($info); ?>
        </h2>
    </div>
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

    <script>

    </script>


</body>

</html>