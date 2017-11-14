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

    <div class="main">
        <div class="wrap">
            <div id="_qs31qxs5p5"></div>
            <div class="m-left4">
                <div class="s-ebox1 pos-search">
                    <form id="pos_search_form" name="pos_search_form" action="#/zhiwei/search/url">
                        <div class="ebox-input">
                            <input autocomplete="off" class="form-control bor-c-green ajaxSearch" type="text" placeholder="请输入关键字" name="kw" id="" value=""
                                onfocus="javascript:_gaq.push([&#39;_trackEvent&#39;, &#39;index&#39;, &#39;click_searchBox&#39;])">

                            <div class="clear"></div>
                        </div>
                        <div class="ebox-tag">
                            <span class="pos-search-tag-title">热门搜索：</span>
                            <a href="#/zhaopin/kw-%E5%9F%B9%E8%AE%AD%E8%AE%B2%E5%B8%88/" onclick="javascript:_gaq.push([&#39;_trackEvent&#39;, &#39;index&#39;, &#39;click_hotTopics&#39;])">
                                <strong>培训讲师</strong>
                            </a>
                            <a href="#/zhaopin/kw-%E9%A2%84%E7%BB%93%E7%AE%97%E5%91%98/" onclick="javascript:_gaq.push([&#39;_trackEvent&#39;, &#39;index&#39;, &#39;click_hotTopics&#39;])">
                                <strong>预结算员</strong>
                            </a>
                            <a href="#/zhaopin/kw-%E6%95%99%E5%B8%88/" onclick="javascript:_gaq.push([&#39;_trackEvent&#39;, &#39;index&#39;, &#39;click_hotTopics&#39;])">
                                <strong>教师</strong>
                            </a>
                            <a href="#/zhaopin/kw-%E6%8A%A4%E5%A3%AB/" onclick="javascript:_gaq.push([&#39;_trackEvent&#39;, &#39;index&#39;, &#39;click_hotTopics&#39;])">
                                <strong>护士</strong>
                            </a>
                            <a href="#/zhaopin/kw-%E8%B4%A7%E8%BF%90%E4%BB%A3%E7%90%86/" onclick="javascript:_gaq.push([&#39;_trackEvent&#39;, &#39;index&#39;, &#39;click_hotTopics&#39;])">
                                <strong>货运代理</strong>
                            </a>
                            <a href="#/zhaopin/kw-%E5%8C%BB%E7%96%97%E6%9C%BA%E6%A2%B0/" onclick="javascript:_gaq.push([&#39;_trackEvent&#39;, &#39;index&#39;, &#39;click_hotTopics&#39;])">
                                <strong>医疗机械</strong>
                            </a>
                            <a href="#/zhaopin/kw-%E7%94%9F%E7%89%A9%E5%88%B6%E8%8D%AF/" onclick="javascript:_gaq.push([&#39;_trackEvent&#39;, &#39;index&#39;, &#39;click_hotTopics&#39;])">
                                <strong>生物制药</strong>
                            </a>
                            <a href="#/zhaopin/kw-%E8%90%A5%E8%BF%90%E7%BB%8F%E7%90%86/" onclick="javascript:_gaq.push([&#39;_trackEvent&#39;, &#39;index&#39;, &#39;click_hotTopics&#39;])">
                                <strong>营运经理</strong>
                            </a>
                            <a href="#/zhaopin/kw-%E9%A1%B9%E7%9B%AE%E6%80%BB%E7%9B%91/" onclick="javascript:_gaq.push([&#39;_trackEvent&#39;, &#39;index&#39;, &#39;click_hotTopics&#39;])">
                                <strong>项目总监</strong>
                            </a>
                            <a href="#/zhaopin/kw-%E8%84%9A%E6%9C%AC%E5%BC%80%E5%8F%91/" onclick="javascript:_gaq.push([&#39;_trackEvent&#39;, &#39;index&#39;, &#39;click_hotTopics&#39;])">
                                <strong>脚本开发</strong>
                            </a>

                        </div>

                        <div class="ebox-condition">
                            <div class="select_pop js_popcity" maxselectcount="3" selecttxt="工作地点">
                                <i class="ico_select_pop"></i>
                                <input class="form-control control-sm js_pop_text" placeholder="工作地点" id="" name="city[text]" type="text" value="" readonly="">
                                <input class="form-control control-sm js_pop_val" placeholder="" id="" name="city[id]" type="hidden">
                            </div>
                            <div class="select_pop js_popjobduty" maxselectcount="3" selecttxt="职能">
                                <i class="ico_select_pop"></i>
                                <input class="form-control control-sm js_pop_text" placeholder="职能" name="duty[text]" type="text" value="" readonly="">
                                <input class="form-control control-sm js_pop_val" placeholder="" id="" name="duty[id]" type="hidden">
                            </div>
                            <div class="select_pop js_popindustry" maxselectcount="3" selecttxt="行业">
                                <i class="ico_select_pop"></i>
                                <input class="form-control control-sm js_pop_text" placeholder="行业" name="industry[text]" type="text" value="" readonly="">
                                <input class="form-control control-sm js_pop_val" placeholder="" id="" name="industry[id]" type="hidden">
                            </div>
                        </div>

                        <div class="ebox-btn">
                            <!-- <div class="fl-right">                  
                    <input class="btn_link fc-blue3" type="reset" value="重置">
                </div> -->
                            <a href="javascript:;" onclick="javascript:_gaq.push([&#39;_trackEvent&#39;, &#39;index&#39;, &#39;search_direct&#39;]);$(&#39;#pos_search_form&#39;).submit();"
                                class="btn btn-orange w-220" id="pos_search_form_submit">搜索</a>
                        </div>
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
                            <ul class="ullist-1 js_agent" agenttag="li">
                                <li agenturl="/zhiwei/view/29546736/" agenttarget="_blank">

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
                                </li>

                                <li agenturl="/zhiwei/view/29546736/" agenttarget="_blank">

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
                                        <a class="btn btn-sm btn-green3 w-110 xx" target="_blank" href="#">查看详情</a>
                                    </p>

                                    <p class="mt20 xx">

                                        <div class="clear"></div>
                                </li>
                                <li agenturl="/zhiwei/view/29546736/" agenttarget="_blank">

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
                                        <a class="btn btn-sm btn-green3 w-110 xx" target="_blank" href="#">查看详情</a>
                                    </p>

                                    <p class="mt20 xx">

                                        <div class="clear"></div>
                                </li>
                                <li agenturl="/zhiwei/view/29546736/" agenttarget="_blank">

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
                                        <a class="btn btn-sm btn-green3 w-110 xx" target="_blank" href="#">查看详情</a>
                                    </p>

                                    <p class="mt20 xx">

                                        <div class="clear"></div>
                                </li>
                                <li agenturl="/zhiwei/view/29546736/" agenttarget="_blank">

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
                                        <a class="btn btn-sm btn-green3 w-110 xx" target="_blank" href="#">查看详情</a>
                                    </p>

                                    <p class="mt20 xx">

                                        <div class="clear"></div>
                                </li>
                            </ul>
                            <div class="pages_more">
                                <a href="#/zhaopin/" class="more btn btn-info" onclick="javascript:_gaq.push([&#39;_trackEvent&#39;, &#39;index&#39;, &#39;click_more&#39;])">查看更多经历&gt;&gt;</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="m-right4">




                <div class="i-ebox1 mt10">
                    <div class="title" onclick="javascript:_gaq.push([&#39;_trackEvent&#39;, &#39;index&#39;, &#39;click_recommendCompany&#39;])">
                        <i class="ico ico-square"></i>推荐会员</div>
                    <div class="conbox">
                        <ul class="i-recommend-company evenParent" even_cell="li">


                            <li>
                                <a href="#">
                                    <img src="/Public/dist/image/1442028166"> </a>
                                <a href="#">小高</a>
                            </li>

                            <li>
                                <a href="#">
                                    <img src="/Public/dist/image/1442028166"> </a>
                                <a href="#">小高</a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/Public/dist/image/1442028166"> </a>
                                <a href="#">小高</a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/Public/dist/image/1442028166"> </a>
                                <a href="#">小高</a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/Public/dist/image/1442028166"> </a>
                                <a href="#">小高</a>
                            </li>
                        </ul>
                        <div class="clear"></div>
                    </div>
                </div>

            </div>
        </div>
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
                                        <input type="text" id="username" name="username" value="" class="form-control w-248 js_validate" placeholder="请输入邮箱"> </li>

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


                        <div class="clear"></div>

                    </div>
                </div>
            </div>
        </div>
        <!-- 登录弹出层 end -->
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

        <script src="/Public/dist/js/new_city.js"></script>
        <script src="/Public/dist/js/new_job_duty.js"></script>
        <script src="/Public/dist/js/new_industry.js"></script>
        <script src="/Public/dist/js/data_type.js"></script>
        <script src="/Public/dist/js/play.js"></script>

        <!-- footer end-->
        <script src="/Public/dist/js/handlebars-v3.0.3.js"></script>

</body>

</html>