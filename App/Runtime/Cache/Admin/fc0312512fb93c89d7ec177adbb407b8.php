<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>编辑公告</title>

    <link href="/Angsir/Public/vendor/summernote/summernote.css" rel="stylesheet" type="text/css">
    <link href="/Angsir/Public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="/Angsir/Public/vendor/umeditor/themes/default/css/umeditor.css" />
    <style>
        body {
            padding: 15px;
        }
    </style>

</head>

<body>


    <form class="layui-form">

        <!-- <input type="hidden" name="about_id" id="about_id" value="<?php echo ($about["about_id"]); ?>"> -->
        <!-- <textarea id="summernote" name='content'><?php echo ($about["content"]); ?></textarea> -->
        <script id="container" name="content" type="text/plain" style="width:100%;min-height:80vh;" lay-verify='required'><?php echo (htmlspecialchars_decode($about["content"])); ?></script>
        <button class="btn btn-primary btn-lg btn-block" type="button" lay-submit lay-filter="*" style="margin-top:20px">保存</button>

    </form>
    <script src="/Angsir/Public/vendor/jquery/jquery-2.1.0.js"></script>
    <script src="/Angsir/Public/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="/Angsir/Public/vendor/layui/layui.js"></script>
    <!-- 中文-->

    <!-- 引入 etpl -->
    <script src="/Angsir/Public/vendor/umeditor/third-party/template.min.js" type="text/javascript" charset="utf-8"></script>
    <!-- 配置文件 -->
    <script src="/Angsir/Public/vendor/umeditor/umeditor.config.js" type="text/javascript" charset="utf-8"></script>
    <!-- 编辑器源码文件 -->
    <script src="/Angsir/Public/vendor/umeditor/umeditor.js" type="text/javascript" charset="utf-8"></script>
    <!-- 语言包文件 -->
    <script src="/Angsir/Public/vendor/umeditor/lang/zh-cn/zh-cn.js" type="text/javascript" charset="utf-8"></script>
    <!---->
    <script>

        // $(function () {
        //     $('#summernote').summernote({
        //         height: '80vh',
        //         tabsize: 2,
        //         lang: 'zh-CN',
        //         toolbar: [
        //             // [groupName, [list of button]]
        //             ['style', ['bold', 'italic', 'underline', 'clear']],
        //             ['font', ['strikethrough', 'superscript', 'subscript']],
        //             ['fontsize', ['fontsize']],
        //             ['color', ['color']],
        //             ['para', ['ul', 'ol', 'paragraph']],
        //             ['height', ['height']]
        //         ]
        //     });
        // })



        window.um = UM.getEditor('container', {
            /* 传入配置参数,可配参数列表看umeditor.config.js */
        });



        layui.use('form', function () {
            var form = layui.form;
            form.on('submit(*)', function (data) {
                // console.log(data.elem) //被执行事件的元素DOM对象，一般为button对象
                // console.log(data.form) //被执行提交的form对象，一般在存在form标签时才会返回
                console.log(data.field) //当前容器的全部表单字段，名值对形式：{name: value}

                save('保存成功~');

                return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
            });


        });

        setInterval(function () {

            save(function () {
                layer.msg('自动保存完成', {
                    offset: '80%'
                });
            });

        }, 10000);


        function save(successInfo) {

            var content = UM.getEditor('container').getContent();

            $.post('', {
                "content": content
            }, function (res) {

                res = JSON.parse(res);


                if (res.res > 0) {

                    if (successInfo != null) {

                        if (typeof (successInfo) == 'function') {
                            successInfo();

                        } else {

                            layer.msg(successInfo, {
                                offset: '80%'
                            });
                        }


                    }

                } else {
                    layer.msg('保存失败：' + res.msg, {
                    });
                }
            });
        }
    </script>
</body>

</html>