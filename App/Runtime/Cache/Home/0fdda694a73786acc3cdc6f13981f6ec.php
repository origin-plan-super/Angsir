<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<!--  main layout -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>angsir网</title>
    <meta name="keywords" content="angsir网">
    <meta name="description" content="angsir网">
    <meta name="baidu_ssp_verify" content="012083dea3cb5ea1b27406bc9fe3dc22">
    <link rel="shortcut icon" href="#favicon.ico">


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

    <!-- End Alexa Certify Javascript -->
    <!-- page private css file -->

    <link href="/Public/dist/css/manage.css" rel="stylesheet" type="text/css">
    <!-- 请置于所有广告位代码之前 -->
    <script src="/Public/dist/js/ds.js"></script>

    <script src="/Public/dist/js/share.js"></script>
    <link rel="stylesheet" href="/Public/dist/css/share_style0_24.css">
    <link rel="stylesheet" href="/Public/dist/css/share_popup.css">
    <link rel="stylesheet" href="/Public/dist/css/select_share.css">
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
    <div class="header" id="header">
        <div class="wrap">
            <div class="login-box fl-right">
                <!-- 已登录 -->
                <div class="login js_navlogin hidden" loginstate="1">
                    <p>
                        <span class="user-name">&nbsp;</span>
                        <span class="user-gravatar">
                            <img src="/Public/dist/image/gravatar-default.jpg" class="img-responsive" alt="Responsive image" widht="20" height="20"> </span>
                    </p>
                    <div class="nav-userlist js_navuserlist hidden" identitystate="1">
                        <p>
                            <a href="#/resume/my">我的经历</a>
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
                <div class="loginout" loginstate="0">
                    <a class="btn-sign" href="#/passport/login" onclick="javascript:_gaq.push([&#39;_trackEvent&#39;, &#39;top_navigation&#39;, &#39;login_entry&#39;])"
                        role="button" target="_self" id="js-login" pop-data="#js_popuplogin">登录</a>
                    <a class="btn-register" href="#/passport/register" onclick="javascript:_gaq.push([&#39;_trackEvent&#39;, &#39;top_navigation&#39;, &#39;register_entry&#39;])"
                        role="button" target="_self">注册</a>
                </div>
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
                <!--    <li><a href="#/about/mobile/index">手机版</a></li>-->
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
                        <strong>销售工程师</strong>
                        <span class="ico-wrap">
                        </span>
                    </h1>
                    <div class="tbar3-li1">

                        <div class="tbar3-duty">
                            <span>行业：</span>
                            <h2>制造业</h2>
                        </div>
                        <div class="tbar3-duty">
                            <span>该行业或该职位有无相关证书，是否必须持证上岗：</span>
                            <h2>无</h2>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="tbar3-bottom" style="display: block;">
                    <ul class="ullist-inline1">
                        <li>
                            <span>入职时间：</span>
                            <h2>2009/10</h2>
                        </li>
                        <li>
                            <span>在该岗位时间：</span>
                            <h2>6年</h2>
                        </li>
                        <li>
                            <span>入职薪资：</span>
                            <h2>3000（税前）</h2>
                        </li>
                        <li>
                            <span>3～5年后薪资：</span>
                            <h2>8k~9K 税前 无灰色收入</h2>
                        </li>
                        <li>
                            <span>地点：</span>
                            <h2>上海市</h2>
                        </li>
                        <li>
                            <span>上班/下班时间：</span>
                            <h2>09：00~17：00</h2>
                        </li>
                    </ul>
                    <div class="clear"></div>
                    <div class="clear"></div>
                    <div class="publish-time">更新时间：2017-09-05发布</div>
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
                                                <img src="/Public/dist/image/app.jpg" alt="app下载" data-bd-imgshare-binded="1"> </div>
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
                                                <img src="/Public/dist/image/getWxImg" alt="该图片动态生成" data-bd-imgshare-binded="1"> </div>
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
                            <li>若客户处有事，则经常周末也在客户处，直至处理好问题，无加班工资。 </li>
                            <li>
                                <strong>
                                    <span class="cd">工作环境</span>
                                </strong>
                            </li>
                            <li>在办公楼上班，有时也要到客户工厂车间去短暂工作，车间环境较差，粉尘较多。 </li>

                            <li>
                                <span class="cd">人际氛围</span>
                            </li>
                            <li>人际氛围还可以，同事们比较和善，但也有隐隐的竞争关系，因为是民营企业，主要要看老板脸色。</li>

                            <li>
                                <span class="cd">工作中男女比例</span>
                            </li>
                            <li>销售部几个男的一个女的，财务部女生倒有好几个。</li>

                            <li>
                                <span class="cd">人员流动是否频繁</span>
                            </li>
                            <li>比较频繁，业务上做不出业绩很难留下。</li>

                            <li>
                                <span class="cd">上升空间及发展前景</span>
                            </li>
                            <li>业务员——资深业务员——部门主管/经理——销售副总</li>

                            <li>
                                <span class="cd">需要接触哪些方面的人</span>
                            </li>
                            <li>老板（听老板战略方针，最终工作成绩要老板认可）、主管领导（听主管领导安排具体工作，向主管领导汇报具体工作）、客户（客户随叫随到，需要解决客户要求的各类问题）、供应商 （和产品供应商沟通，对供货品质进行控制，和物流供应商进行沟通，确保准时准确送货到客户那）
                                （老板/主管/客户/供应商/下属/同事） </li>
                            <li>
                                <span class="cd">典型的一天工作</span>
                            </li>
                            <li>早上打开电脑，处理客户邮件，包括新的订单，处理客户的疑问和配合解决客户的问题。 上午再对潜在客户进行电话拜访，若客户给机会给时间，再进一步的进行实地面对面交流，推广我们的产品，由于我们的产品市场上有很多同类产品，因此推广时要花不少力气。
                                下午赶到老客户现场车间，和工人及班组长交流我们产品的使用情况，若有使用不顺利，顺便要解决他们的问题，这就要求我们熟悉我们的产品，甚至有些技术问题也要熟悉。 在进行这些工作的同时，打电话给有逾期款未付的客户进行催款，以及解决工作上的一些日常事物。
                            </li>
                            <li>

                                <span class="cd">什么时候压力最大</span>
                            </li>
                            <li>新客户开发遇阻，老客户被竞争对手抢走，或者老客户要求降价。催款时压力也大，既不能很强硬地催，这样会得罪客户，但是催不回来，自己公司内部又会扣自己绩效工资。客户处出现质量问题，发生客户抱怨或者客诉，因为索赔很厉害，所以也要求我们销售在客户这，将大事化小，小事化了。</li>
                            <li>
                                <span class="cd">想对后来人说点什么</span>
                            </li>
                            <li>学好一门能养家糊口的专业，学好外语及口语（特别重要，学好外语你的选择机会更多上升空间更大）</li>
                            <li>
                                <span class="cd">一则自己亲身经历的职场故事</span>
                            </li>
                            <li>有一次客户（客户中我的线人）下午打电话给我，说我们的产品在各生产线上都反映不好用，我紧急赶赴客户现场，现场查看后，发现产品确实有问题，二话不说，立即在不惊动客户领导的情况下，安排自己公司物流发货，给客户各相关部门的具体操办人打招呼，给客户车间里换另一批产品。很不巧，换来的另一批产品质量也不好，车间工人普遍反映不好用，此时我急了，因为我知道我们仓库里主要就是这两个批次的产品，如果这两个批次都不好用，客户车间就无法正常生产，就得停线，由于我们客户是给汽车整机厂供货的，每天必须做出这么多数量的，如果因为我们产品质量原因造成客户停线，我们公司每小时就得赔偿客户几十万，想到这里，我不敢再想下去。
                                冷静下来后，我找各个生产线的领导，请他们帮忙把下午撑过去，同时不要把这事捅到他们领导那去（这时就看出平时和他们关系的好坏了，平时要多烧香，关键时别人才能帮你）。之后我和晚班的车间领导沟通，晚班需要多少我们的产品，我马上开车去我们的仓库再去拿这么多产品给他们用，得确保他们晚班能生产！福无双至，祸不单行，那天正好是过节，路上很堵，等我心急火燎地将仓库里除了确定有问题的那两批货，其他零星批次的货再次送到客户现场时，离客户晚班开始只有十五分钟了，也就是说，我晚十五分钟，客户就会停线，我们公司得赔死，直到现在，写下这些文字时，我还有些后怕。
                                后面的几天我都在客户现场跟踪，确认后续产品无质量问题时才回到公司交差。
                            </li>

                            <li style="float:right; font-size:14px">阅读量：23 点赞：6
                                <a href="#">
                                    <img src="/Public/dist/image/z.png" width="26" height="24" />
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <textarea cols="" rows="12" class="w-682"></textarea>
                        <li class="mt20 fb" style="margin-left:180px">
                            <input type="submit" id="login_submit" value="留  言" class="btn btn-primary btn-lg btn-block mlr0 fb " style="width:300px; margin:20px  "
                                align="middle">
                        </li>
                    </div>

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
                            <img src="/Public/dist/image/company_logo666601_169.jpg" data-bd-imgshare-binded="1">

                        </div>
                        <h2>老张</h2>

                        <ul class="text-list3 mt20">
                            <li>
                                <span>年龄：</span>34</li>
                            <li>
                                <span>行业：</span>制造业</li>
                            <li>
                                <span>职位：</span>销售</li>
                            <li>
                                <span>地址：</span>北京市海淀</li>
                            <li>
                                <span>邮箱：</span>997945@qq.com</li>
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
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
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
                        <form action="#passport/login" id="login_form" name="login" class="form-signin ptb20" method="post">
                            <input type="hidden" id="callback" name="callback" value="/zhiwei/view/29546736/">
                            <ul class="form-list1">
                                <li class="label-inline1">
                                    <label for="username" class="label-1 fz-14">账 号</label>
                                    <input type="text" id="username" name="username" value="" class="form-control w-248 js_validate" placeholder="邮箱或手机号"> </li>

                                <li class="label-inline1">
                                    <label for="password" class="label-1 fz-14">密 码</label>
                                    <input type="password" id="password" name="password" value="" class="form-control w-248 js_validate" placeholder="6-16个字符，不能有空格，区分大小写"
                                        autocomplete="off"> </li>
                                <li>
                                    <a href="#passport/password/findPassword" class="fl-right">找回密码</a>
                                    <label>
                                        <input type="checkbox" name="remember" checked=""> 下次自动登录
                                    </label>
                                </li>
                                <li class="mt20">
                                    <input type="submit" id="login_submit" value="登 录" class="btn btn-primary btn-lg btn-block mlr0" onclick="javascript:_gaq.push([&#39;_trackEvent&#39;, &#39;login_window&#39;, &#39;login&#39;])"> </li>
                                <li class="tx-right">
                                    没有账号，
                                    <a target="_blank" href="#passport/register" class="fc-orange1" onclick="javascript:_gaq.push([&#39;_trackEvent&#39;, &#39;login_window&#39;, &#39;switch_register&#39;])">立即注册</a>
                                </li>
                            </ul>
                        </form>
                    </div>
                    <div class="signin-bottom">
                        <h5 class="title2">
                            <del>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</del>还可以使用以下方式登录
                            <del>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</del>
                        </h5>
                        <div class="login-option">
                            <a href="#passport/third-party-login/weibo" class="ico-weibo" onclick="javascript:_gaq.push([&#39;_trackEvent&#39;, &#39;login_page&#39;, &#39;sina_login&#39;])">微博</a>
                            <a href="#passport/third-party-login/qq" class="ico-qq" onclick="javascript:_gaq.push([&#39;_trackEvent&#39;, &#39;login_page&#39;, &#39;qq_login&#39;])">QQ</a>
                            <a href="#passport/third-party-login/wechat" class="ico-weixin" onclick="javascript:_gaq.push([&#39;_trackEvent&#39;, &#39;login_page&#39;, &#39;wexin_login&#39;])">微信</a>
                        </div>
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

    <!-- footer end-->
    <script src="/Public/dist/js/handlebars-v3.0.3.js"></script>
    <!-- page private  js  -->


    <!--右侧悬浮导航 我要反馈 -->
    <div class="clear"></div>
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

</body>

</html>