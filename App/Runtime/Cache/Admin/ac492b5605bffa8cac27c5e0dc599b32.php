<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/Public/vendor/layui/css/layui.css" rel="stylesheet" type="text/css">
    <title>经历列表</title>
    <style>
        body {
            padding: 15px;
        }
    </style>
</head>

<body>

    <fieldset class="layui-elem-field layui-field-title">
        <legend>经历列表</legend>
    </fieldset>
    <div class="layui-inline">
        <input class="layui-input" name="user_id" id="user_id" placeholder="搜索" autocomplete="off">
    </div>
    <button class="layui-btn" id="reload" data-type="reload">搜索</button>



    <table id="live_table" lay-filter="live_table_filter"></table>
    <script src="/Public/vendor/Jquery/jquery-2.1.0.js"></script>
    <script src="/Public/vendor/layer/layer.js"></script>
    <script src="/Public/vendor/layui/layui.js"></script>

    <script type="text/html" id="bar1">

        <a class="layui-btn layui-btn-xs" lay-event="open">查看</a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
    
      </script>

    <script>
        var tableIns;

        layui.use('table', function () {
            var table = layui.table
                , form = layui.form;


            //第一个实例
            tableIns = table.render({
                elem: '#live_table'
                , url: '/index.php/Admin/Article/getList' //数据接口
                , page: true //开启分页
                , limit: localStorage.limit == null ? 20 : localStorage.limit
                , cols: [[ //表头
                    { field: 'live_id', title: 'ID', width: 150 }
                    , { field: 'user_id', title: '账号' }
                    , { field: 'read_count', title: '阅读', width: 80, align: 'center' }
                    , { field: 'good_count', title: '点赞', width: 80, align: 'center' }
                    , { field: 'title', title: '标题&职位', style: 'cursor: pointer;', event: 'openNew' }
                    , { field: 'industry_text', title: '行业' }
                    , { fixed: 'right', width: 150, align: 'center', title: '操作', toolbar: '#bar1' } //这里的toolbar值是模板元素的选择器
                ]]
            });

            //监听工具条
            table.on('tool(live_table_filter)', function (obj) { //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
                var data = obj.data; //获得当前行数据
                var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
                var tr = obj.tr; //获得当前行 tr 的DOM对象

                var live_id = data.live_id;
                console.log(obj);

                //查看
                if (layEvent === 'open') {
                    var url = '<?php echo U("Home/Article/article/","","");?>' + '/live_id/' + live_id;
                    var windo = layer.open({
                        type: 2,
                        title: data.title,
                        shadeClose: true,
                        maxmin: true, //开启最大化最小化按钮
                        area: ['893px', '600px'],
                        content: url
                    });
                    layer.full(windo);
                }
                //新窗口打开
                if (layEvent === 'openNew') {
                    var url = '<?php echo U("Home/Article/article/","","");?>' + '/live_id/' + live_id;
                    window.open(url);
                }


                if (layEvent === 'del') { //删除

                    layer.confirm('真的删除此经历吗？', function (index) {
                        //删除对应行（tr）的DOM结构，并更新缓存
                        obj.del();
                        layer.close(index);
                        //向服务端发送删除指令

                        $.post('/index.php/Admin/Article/del', {
                            "live_id": obj.data.live_id,
                        }, function (res) {
                            res = JSON.parse(res);
                            if (res.res == 0) {
                                layer.msg('删除成功~', {
                                    offset: '80%'
                                });
                                obj.del();

                            } else {
                                layer.msg(res.msg, {
                                    offset: '80%'
                                });
                            }
                        });


                    });
                }

            });

        });

        /**
        数据搜索
        */
        $(document).on('click', '#reload', function () {
            var key = $('#user_id').val();
            //执行重载
            tableIns.reload({
                page: {
                    curr: 1 //重新从第 1 页开始
                }
                , where: {
                    key: key
                }
                , done: function (res, curr, count) {
                    //如果是异步请求数据方式，res即为你接口返回的信息。
                    //如果是直接赋值的方式，res即为：{data: [], count: 99} data为当前页数据、count为数据总长度
                    console.log(res);

                    //得到当前页码
                    console.log(curr);

                    //得到数据总量
                    console.log(count);
                }
            });

        });
    </script>


</body>

</html>