<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/Public/vendor/layui/css/layui.css" rel="stylesheet" type="text/css">
    <title>查看用户</title>
    <style>
        body {
            padding: 15px;
        }
    </style>
</head>

<body>

    <fieldset class="layui-elem-field layui-field-title">
        <legend>用户信息</legend>
        <div class="layui-field-box">

            <form class="layui-form" action="">
                <div class="layui-form-item">
                    <label class="layui-form-label">账号：</label>
                    <div class="layui-form-mid layui-word-aux"><?php echo ($user_info["user_id"]); ?></div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">昵称：</label>
                    <div class="layui-input-block">
                        <div class="layui-form-mid layui-word-aux"><?php echo ($user_info["user_name"]); ?></div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">职位：</label>
                    <div class="layui-form-mid layui-word-aux"><?php echo ($user_info["industry_text"]); ?></div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">行业：</label>
                    <div class="layui-form-mid layui-word-aux"><?php echo ($user_info["duty_text"]); ?></div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">地址：</label>
                    <div class="layui-input-block">
                        <div class="layui-form-mid layui-word-aux"><?php echo ($user_info["user_address"]); ?></div>
                    </div>
                </div>

            </form>

        </div>
    </fieldset>


    <script src="/Public/vendor/Jquery/jquery-2.1.0.js"></script>
    <script src="/Public/vendor/layer/layer.js"></script>
    <script src="/Public/vendor/layui/layui.js"></script>
    <script>

        // //Demo
        // layui.use('form', function () {
        //     var form = layui.form;

        //     //监听提交
        //     form.on('submit(formDemo)', function (data) {

        //         saveInfo({
        //             "user_id": '<?php echo ($user_info["user_id"]); ?>',
        //             "save": data.field
        //         }, function (res) {

        //             if (res.res == 0) {
        //                 layer.msg('修改成功~', {
        //                     offset: '80%'
        //                 });
        //             } else {
        //                 layer.msg(res.msg, {
        //                     offset: '80%'
        //                 });
        //             }

        //         });

        //         return false;
        //     });
        // });
        // function saveInfo(post, f) {
        //     $.post('<?php echo U("User/saveInfo");?>', post, function (res) {
        //         console.log(res);
        //         res = JSON.parse(res);
        //         if (f != null) {
        //             f(res);
        //         }
        //     });
        // }

    </script>

</body>

</html>