<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>管理后台</title>
    <link href="/Public/vendor/layui/css/layui.css" rel="stylesheet" type="text/css">
    <style>
        #iframeBox {
            position: absolute;
            /* height: calc(100%); */
            bottom: 0;
            top: 0;
            left: 0;
            right: 0;
        }

        #fream {
            position: absolute;
            padding: 0;
            width: 100%;
            height: 100%;
        }

        .layui-layout-admin .layui-body {
            top: 60px;
            bottom: 0;
        }
    </style>
</head>

<body>
    <div class="layui-layout layui-layout-admin">
        <div class="layui-header">
            <div class="layui-logo">Angsir</div>
            <!-- 头部区域（可配合layui已有的水平导航） -->
            <ul class="layui-nav layui-layout-left">
                <li class="layui-nav-item">
                    <a href="">控制台</a>
                </li>
                <li class="layui-nav-item">
                    <a href="">商品管理</a>
                </li>
                <li class="layui-nav-item">
                    <a href="">用户</a>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;">其它系统</a>
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="">邮件管理</a>
                        </dd>
                        <dd>
                            <a href="">消息管理</a>
                        </dd>
                        <dd>
                            <a href="">授权管理</a>
                        </dd>
                    </dl>
                </li>
            </ul>
            <ul class="layui-nav layui-layout-right">
                <li class="layui-nav-item">
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="">基本资料</a>
                        </dd>
                        <dd>
                            <a href="">安全设置</a>
                        </dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a href="<?php echo U('Login/sinOut');?>">退了</a>
                </li>
            </ul>
        </div>

        <div class="layui-side layui-bg-black">
            <div class="layui-side-scroll">
                <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
                <ul class="layui-nav layui-nav-tree" lay-filter="test">
                    <li class="layui-nav-item ">
                        <a href="javascript:;" data-src='Index/home'>首页</a>
                    </li>
                    <li class="layui-nav-item ">
                        <a href="javascript:;" data-src='Article/index'>经历管理</a>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;" data-src='User/index'>用户管理</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="layui-body">
            <!-- 内容主体区域 -->
            <div id="iframeBox">
                <iframe src="/index.php/Admin/Index/home" id="fream" frameborder="0"></iframe>
            </div>
        </div>


    </div>


    <script src="/Public/vendor/Jquery/jquery-2.1.0.js"></script>
    <script src="/Public/vendor/layer/layer.js"></script>
    <script src="/Public/vendor/layui/layui.js"></script>
    <!-- popper.min.js 用于弹窗、提示、下拉菜单 -->
    <script>

        layui.use('element', function () {
            var element = layui.element;
        });
        $(function () {

            if ('<?php echo ($admin_url); ?>' != null && '<?php echo ($admin_url); ?>' != '') {
                $('#fream').attr('src', '<?php echo ($admin_url); ?>');
            }

            $(document).on('click', 'a[href="javascript:;" ]', function () {

                if (!($(this).attr('data-src') == null)) {

                    $.post('', {
                        url: $(this).attr('data-src')
                    }, function (date) {
                        $('#fream').attr('src', date);

                    })
                }

            })

        })




    </script>
</body>

</html>