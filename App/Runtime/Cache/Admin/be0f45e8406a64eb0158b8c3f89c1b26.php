<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/Angsir/code/Angsir/Public/vendor/layui/css/layui.css" rel="stylesheet" type="text/css">
    <title>热搜管理</title>
    <style>
        body {
            padding: 15px;
        }
    </style>
</head>

<body>

    <fieldset class="layui-elem-field layui-field-title">
        <legend>热搜管理</legend>
    </fieldset>

    <div class="layui-inline">
        <input class="layui-input" name="hot_id" id="hot_id" placeholder="搜索" autocomplete="off">
    </div>
    <button class="layui-btn" id="reload" data-type="reload">搜索</button>
    <div class="layui-row" style="padding-top:10px">

        <div class="layui-btn-group">

            <button class="layui-btn layui-btn-sm" id="add">
                <i class="layui-icon">&#xe654;</i>新增热搜
            </button>
            <button class="layui-btn layui-btn-sm" id="removeAll">
                <i class="layui-icon">&#xe640;</i>批量删除
            </button>
        </div>


    </div>


    <table id="table" lay-filter="table_filter"></table>

    <script src="/Angsir/code/Angsir/Public/vendor/Jquery/jquery-2.1.0.js"></script>
    <script src="/Angsir/code/Angsir/Public/vendor/layer/layer.js"></script>
    <script src="/Angsir/code/Angsir/Public/vendor/layui/layui.js"></script>

    <script type="text/html" id="bar1">
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
      </script>

    <script>
        var tableIns;
        var table;
        layui.use('table', function () {
            table = layui.table
                , form = layui.form;
            //第一个实例
            tableIns = table.render({
                id: 'table'
                , elem: '#table'
                , url: '/Angsir/code/Angsir/index.php/Admin/Hot/getList' //数据接口
                , page: true //开启分页
                , limit: localStorage.limit == null ? 20 : localStorage.limit
                // , limits: [5, 10]
                , cols: [[ //表头
                    // { type: 'numbers', title: '序号', }
                    { type: 'checkbox', width: 50, fixed: 'lfet' }
                    , { field: 'hot_id', title: 'ID', width: 180 }
                    , { field: 'value', title: '热搜关键字', edit: 'text', width: 200 }
                    , { fixed: 'right', width: 180, align: 'center', title: '操作', toolbar: '#bar1' } //这里的toolbar值是模板元素的选择器
                ]]
            });


            //监听复选框操作
            form.on('checkbox(is_up)', function (obj) {

                var hot_id = this.value;
                layer.tips(hot_id + '：' + obj.elem.checked, obj.othis);

                var up = obj.elem.checked ? 1 : 0;

                setIsUp(this.value, up, function (res) {
                    if (res.res == 0) {


                    } else {
                        layer.msg(res.msg, {
                            offset: '80%'
                        });
                    }
                });


            });


            //监听工具条
            table.on('tool(table_filter)', function (obj) { //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
                var data = obj.data; //获得当前行数据
                var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
                var tr = obj.tr; //获得当前行 tr 的DOM对象
                var hot_id = data.hot_id;
                console.log(layEvent);
                //查看
                var url = '/Angsir/code/Angsir/index.php/Admin/Hot/add/';



                if (layEvent === 'del') { //删除

                    layer.confirm('真的删除此热搜吗？', function (index) {
                        //删除对应行（tr）的DOM结构，并更新缓存
                        layer.close(index);
                        //向服务端发送删除指令

                        $.post('/Angsir/code/Angsir/index.php/Admin/Hot/del', {
                            "hot_id": obj.data.hot_id,
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
            /**
            监听单元格编辑
            */
            table.on('edit(table_filter)', function (obj) { //注：edit是固定事件名，test是table原始容器的属性 lay-filter="对应的值"
                console.log(obj.value); //得到修改后的值
                console.log(obj.field); //当前编辑的字段名
                console.log(obj.data); //所在行的所有相关数据  

                var save = {};
                save[obj.field] = obj.value;

                saveInfo({
                    "hot_id": obj.data.hot_id,
                    "save": save
                }, function (res) {
                    if (res.res == 0) {
                        layer.msg('修改成功~', {
                            offset: '80%'
                        });
                    } else {
                        layer.msg(res.msg, {
                            offset: '80%'
                        });
                    }
                });



            });


        });

        /**
        数据搜索
        */
        $(document).on('click', '#reload', function () {
            var key = $('#hot_id').val();
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
        // 
        /**
          * 批量删除
          */
        $(document).on('click', '#removeAll', function () {
            var o = table.checkStatus('table');
            if (o.data.length <= 0) {
                return;
            }

            layer.confirm('确定删除这些热搜？', function (index) {
                var id = '';
                for (var i = 0; i < o.data.length; i++) {
                    id += "'" + o.data[i].hot_id + "',";
                }
                id = id.substring(0, id.length - 1);

                $.post('/Angsir/code/Angsir/index.php/Admin/Hot/removes', {
                    'hot_id': id
                }, function (res) {

                    var res = JSON.parse(res);

                    if (res.res > 0) {

                        layer.msg('成功删除' + res.res + '数据~');

                        tableIns.reload();
                    } else {
                        layer.msg('删除失败！' + res.msg);

                    }

                });

            });

        });
        /**
        * 新增
        */
        $(document).on('click', '#add', function () {
            //prompt层
            var index = layer.prompt({ title: '请输入热搜关键字', formType: 0 }, function (info, index) {
                console.log(info);
                layer.close(index);


                $.post('/Angsir/code/Angsir/index.php/Admin/Hot/add', {
                    value: info
                }, function (res) {
                    res = JSON.parse(res);
                    if (res.res == 0) {
                        layer.msg('添加成功');
                    } else {
                        layer.msg('添加失败');
                    }

                })


            });

        });


        function saveInfo(post, f) {
            $.post('<?php echo U("hot/saveInfo");?>', post, function (res) {
                console.log(res);
                res = JSON.parse(res);
                if (f != null) {
                    f(res);
                }
            });
        }


        function setIsUp(hot_id, is_up, f) {

            var post = {
                "hot_id": hot_id,
                "save": {
                    "is_up": is_up
                }
            };
            saveInfo(post, f);
        }
    </script>


</body>

</html>