<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/Angsir/Public/vendor/layui/css/layui.css" rel="stylesheet" type="text/css">
    <title>用户列表</title>
    <style>
        body {
            padding: 15px;
        }
    </style>
</head>

<body>

    <fieldset class="layui-elem-field layui-field-title">
        <legend>用户列表</legend>
    </fieldset>

    <div class="layui-inline">
        <input class="layui-input" name="user_id" id="user_id" placeholder="搜索" autocomplete="off">
    </div>
    <button class="layui-btn" id="reload" data-type="reload">搜索</button>
    <div class="layui-row" style="padding-top:10px">

        <div class="layui-btn-group">

            <button class="layui-btn layui-btn-sm" id="removeAll">
                <i class="layui-icon">&#xe640;</i>批量删除
            </button>
        </div>


    </div>


    <table id="table" lay-filter="table_filter"></table>

    <script src="/Angsir/Public/vendor/Jquery/jquery-2.1.0.js"></script>
    <script src="/Angsir/Public/vendor/layer/layer.js"></script>
    <script src="/Angsir/Public/vendor/layui/layui.js"></script>

    <script type="text/html" id="bar1">

        <a class="layui-btn layui-btn-xs" lay-event="open">查看</a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
    
      </script>
    <script type="text/html" id="checkboxTpl">
        <!-- 这里的 checked 的状态只是演示 -->

        
        <input type="checkbox" name="lock" value="{{d.user_id}}" title="推荐" lay-filter="is_up" {{ d.is_up == 1 ? 'checked' : '' }}>

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
                , url: '/Angsir/index.php/Admin/User/getList' //数据接口
                , page: true //开启分页
                , limit: localStorage.limit == null ? 20 : localStorage.limit
                // , limits: [5, 10]
                , cols: [[ //表头
                    // { type: 'numbers', title: '序号', }
                    { type: 'checkbox', width: 50, fixed: 'lfet' }
                    , { field: 'user_id', title: '账号', width: 180 }
                    , { field: 'user_name', title: '用户名', edit: 'text', width: 180 }
                    , { field: 'duty_text', title: '职业' }
                    , { field: 'industry_text', title: '行业' }
                    , { field: 'user_address', title: '地区', edit: 'text', width: 200 }
                    , { field: 'is_up', fixed: 'right', title: '是否推荐', align: 'center', width: 110, templet: '#checkboxTpl', unresize: true }
                    , { fixed: 'right', width: 180, align: 'center', title: '操作', toolbar: '#bar1' } //这里的toolbar值是模板元素的选择器
                ]]
            });


            //监听复选框操作
            form.on('checkbox(is_up)', function (obj) {

                var user_id = this.value;
                layer.tips(user_id + '：' + obj.elem.checked, obj.othis);

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
                var user_id = data.user_id;
                console.log(layEvent);
                //查看
                var url = '/Angsir/index.php/Admin/User/show/user_id/' + user_id;
                if (layEvent === 'open') {
                    layer.open({
                        type: 2,
                        title: data.user_id + " | " + data.user_name,
                        shadeClose: true,
                        maxmin: true, //开启最大化最小化按钮
                        area: ['893px', '600px'],
                        content: url
                    });


                }



                if (layEvent === 'del') { //删除

                    layer.confirm('真的删除此用户吗？', function (index) {
                        //删除对应行（tr）的DOM结构，并更新缓存
                        layer.close(index);
                        //向服务端发送删除指令

                        $.post('/Angsir/index.php/Admin/User/del', {
                            "user_id": obj.data.user_id,
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
                    "user_id": obj.data.user_id,
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
        // 
        /**
          * 批量删除
          */
        $(document).on('click', '#removeAll', function () {
            var o = table.checkStatus('table');
            if (o.data.length <= 0) {
                return;
            }

            layer.confirm('确定删除这些用户？', function (index) {
                var id = '';
                for (var i = 0; i < o.data.length; i++) {
                    id += "'" + o.data[i].user_id + "',";
                }
                id = id.substring(0, id.length - 1);

                $.post('/Angsir/index.php/Admin/User/removes', {
                    'user_id': id
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
        function saveInfo(post, f) {
            $.post('<?php echo U("User/saveInfo");?>', post, function (res) {
                console.log(res);
                res = JSON.parse(res);
                if (f != null) {
                    f(res);
                }
            });
        }


        function setIsUp(user_id, is_up, f) {

            var post = {
                "user_id": user_id,
                "save": {
                    "is_up": is_up
                }
            };
            saveInfo(post, f);
        }
    </script>


</body>

</html>