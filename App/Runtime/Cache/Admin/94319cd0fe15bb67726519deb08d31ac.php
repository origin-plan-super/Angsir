<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>添加优惠码</title>
    <link href="/Angsir/code/Angsir/Public/vendor/layui/css/layui.css" rel="stylesheet" type="text/css">

    <style>
        body {
            padding: 15px
        }
    </style>

</head>

<body>
    <fieldset class="layui-elem-field layui-field-title">
        <legend>添加优惠码</legend>
    </fieldset>

    <form class="layui-form">
        <div class="layui-form-item">
            <div class="layui-block">
                <label class="layui-form-label">优惠价格</label>
                <div class="layui-input-inline" style="width: 100px;">
                    <input type="number" name="money" placeholder="￥" autocomplete="off" class="layui-input">
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-block">
                <label class="layui-form-label">生成数量</label>
                <div class="layui-input-inline" style="width: 100px;">
                    <input type="number" name="num" placeholder="" autocomplete="off" class="layui-input">
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="*">生成</button>
            </div>
        </div>

    </form>
    <script src="/Angsir/code/Angsir/Public/vendor/Jquery/jquery-2.1.0.js"></script>
    <script src="/Angsir/code/Angsir/Public/vendor/layer/layer.js"></script>
    <script src="/Angsir/code/Angsir/Public/vendor/layui/layui.js"></script>
    <script>
        layui.use('form', function () {
            var form = layui.form;
            form.on('submit(*)', function (data) {
                console.log(data.elem) //被执行事件的元素DOM对象，一般为button对象
                console.log(data.form) //被执行提交的form对象，一般在存在form标签时才会返回
                console.log(data.field) //当前容器的全部表单字段，名值对形式：{name: value}


                var index = layer.load(2, { time: 1000 });
                $.post('', data.field, function (res) {
                    res = JSON.parse(res);
                    layer.close(index);

                    if (res.res > 0) {
                        layer.msg('生成成功~');
                    } else {
                        layer.msg('生成失败！' + res.msg);
                    }



                });

                return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
            });

        });
    </script>
</body>

</html>