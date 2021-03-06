<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>商品列表2</title>

    <link rel="stylesheet" href="/MIAOBELER/Public/vendor/layui/css/layui.css">
    <link rel="stylesheet" href="/MIAOBELER/Public/vendor/layer/mobile/need/layer.css">
    <style type="text/css">
        body {
            padding: 20px;
            padding-bottom: 100px;
            padding-top: 80px;
        }

        .demoTable {
            padding: 20px 0;
        }
    </style>
</head>

<body>

    <fieldset class="layui-elem-field layui-field-title">
        <legend>商品管理</legend>
    </fieldset>

    <div class="layui-btn-group">
        <button class="layui-btn layui-btn-small" id="remove">
            <span>批量删除</span>
            <i class="layui-icon">&#xe640;</i>
        </button>
        <button class="layui-btn layui-btn-small" id="showall">
            <span>批量上架</span>
            <i class="layui-icon">&#xe698;</i>
        </button>
        <button class="layui-btn layui-btn-small" id="hideall">
            <span>批量下架</span>
            <i class="layui-icon">&#xe698;</i>
        </button>
    </div>

    <!--
         <div class="demoTable">
        搜索ID：
        <div class="layui-inline">
            <input class="layui-input" name="id" id="demoReload" autocomplete="off">
        </div>
        <button class="layui-btn" data-type="reload">搜索</button>
    </div> 
-->

    <table class="layui-table" id="goodsTable" lay-filter="demo">
    </table>
    <div class="test"></div>

    <script src="/MIAOBELER/Public/vendor/jquery/jquery-2.1.0.js" type="text/javascript" charset="utf-8"></script>
    <script src="/MIAOBELER/Public/vendor/layer/layer.js"></script>
    <script src="/MIAOBELER/Public/vendor/layui/layui.js"></script>

    <script type="text/html" id="barDemo">
        <a class="layui-btn layui-btn-mini" lay-event="edit">编辑</a>
        <a class="layui-btn layui-btn-danger layui-btn-mini" lay-event="del">删除</a>
        
        <!-- 这里同样支持 laytpl 语法，如： -->
        {{#  if(d.auth > 2){ }}
          <a class="layui-btn layui-btn-mini" lay-event="check">审核</a>
        {{#  } }}
    </script>

    <script type="text/html" id="isShowTool">
        <!-- 上下架控制 -->

        {{# if(d.is_show == 1){ }}

        <a class="layui-btn layui-btn-mini" lay-event="hide">下架</a>

        {{# }}}

        {{# if(d.is_show == 0){ }}
        
        <a class="layui-btn layui-btn-mini layui-btn-primary" lay-event="show">上架</a>
        
        {{# }}}

    </script>


    <script type="text/html" id="classTool">
        <!-- 分类显示 -->

        <h3>{{ d.t3_title }} / {{ d.t2_title }}</h3>

    </script>
    <script type="text/javascript">

        function getLocalTime(nS) {
            return new Date(parseInt(nS) * 1000).toLocaleString().replace(/:\d{1,2}$/, ' ');
        }

        var table;
        var tableIns;
        layui.use('table', function () {

            table = layui.table;
            // table.init('demo', {});




            function get() {



            }




            tableIns = table.render({
                elem: '#goodsTable',
                id: "goodsTable",
                page: true,
                url: '<?php echo U("Goods/getList");?>', //设置异步接口
                //赋值数据============
                // data: result.message,
                //设置行================
                cols: [
                    [
                        { checkbox: true, fixed: true },
                        { field: 'id', title: 'ID', width: 100 },
                        { field: 'goods_id', title: '商品id', width: 100 },
                        { field: 't1_title', title: '商品标题', width: 100 },
                        { field: 'str_price', title: '原价', edit: 'text', width: 100, sort: true },
                        { field: 'price', title: '现价', edit: 'text', width: 100, sort: true },
                        { field: 'integral', title: '积分', edit: 'text', width: 100, sort: true },
                        { field: 't2_title', title: '分类', width: 100, sort: true, toolbar: '#classTool' },
                        { field: 'add_time', title: '添加时间', width: 200, sort: true },
                        { field: 'edit_time', title: '最后修改时间', width: 200, sort: true },
                        { field: 'is_show', title: '上/下架', width: 130, align: 'center', sort: true, toolbar: '#isShowTool' },
                        { fixed: 'right', width: 150, align: 'center', toolbar: '#barDemo' },//这里的toolbar值是模板元素的选择器
                    ]
                ],
            });

            // $.get('<?php echo U("Goods/getList");?>', {}, function (result) {

            //     result = JSON.parse(result);
            //     console.warn(result.sql);



            //     for (var key in result.message) {
            //         if (result.message.hasOwnProperty(key)) {
            //             var item = result.message[key];
            //             item.add_time = getLocalTime(item.add_time);
            //             item.edit_time = getLocalTime(item.edit_time);
            //         }
            //     }

            //     table.render({
            //         elem: '#goodsTable',
            //         id: "goodsTable",
            //         page: true,
            //         //赋值数据============
            //         data: result.message,
            //         //设置行================
            //         cols: [
            //             [
            //                 { checkbox: true, fixed: true },
            //                 { field: 'id', title: 'ID', width: 100 },
            //                 { field: 'goods_id', title: '商品id', width: 100 },
            //                 { field: 'title', title: '商品标题', width: 100 },
            //                 { field: 'str_price', title: '原价', edit: 'text', width: 100, sort: true },
            //                 { field: 'price', title: '现价', edit: 'text', width: 100, sort: true },
            //                 { field: 'integral', title: '积分', edit: 'text', width: 100, sort: true },
            //                 { field: 'class_title', title: '分类', width: 100, sort: true },
            //                 { field: 'add_time', title: '添加时间', width: 200, sort: true },
            //                 { field: 'edit_time', title: '最后修改时间', width: 200, sort: true },
            //                 { field: 'is_show', title: '上/下架', width: 130, align: 'center', sort: true, toolbar: '#isShowTool' },
            //                 { fixed: 'right', width: 150, align: 'center', toolbar: '#barDemo' },//这里的toolbar值是模板元素的选择器
            //             ]
            //         ],
            //     });

            // });


            //监听工具条
            table.on('tool(demo)', function (obj) { //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
                var data = obj.data; //获得当前行数据
                var layEvent = obj.event; //获得 lay-event 对应的值
                var tr = obj.tr; //获得当前行 tr 的DOM对象
                console.log(obj.data.goods_id)

                if (layEvent === 'del') {

                    layer.confirm('确定删除此商品？', function (index) {

                        $.post('/MIAOBELER/index.php/Admin/Goods/remove/goods_id/' + obj.data.goods_id, function (result) {
                            layer.msg('删除成功~');
                            // table.update();
                            obj.del();
                        })
                    });

                }

                if (layEvent === 'edit') {
                    window.location.href = '/MIAOBELER/index.php/Admin/Goods/edit/goods_id/' + obj.data.goods_id;


                }


                if (layEvent === 'show') {

                    $.post('/MIAOBELER/index.php/Admin/Goods/show/goods_id/' + obj.data.goods_id, function (result) {
                        layer.msg('下架成功~');
                        obj.update({
                            is_show: ' <a class="layui-btn layui-btn-mini" lay-event="hide">下架</a>',
                        });
                    })

                }
                if (layEvent === 'hide') {


                    $.post('/MIAOBELER/index.php/Admin/Goods/hide/goods_id/' + obj.data.goods_id, function (result) {
                        layer.msg('下架成功~');
                        obj.update({
                            is_show: '<a class="layui-btn layui-btn-mini layui-btn-primary" lay-event="show">上架</a>',
                        });
                    })

                }

                //                  //同步更新缓存对应的值
                //                  obj.update({
                //                      username: '123',
                //                      title: 'xxx'
                //                  });
            });





        });

        $(function () {

            $(document).on('click', '.upshow', function () {

                var _this = $(this);
                $.get($(this).attr('data-href'), function (result) {
                    _this.toggleClass('layui-btn-primary');

                    if (result == 'show') {
                        _this.text('下架');
                        _this.attr('data-href', "/MIAOBELER/index.php/Admin/Goods/hide/goods_id/" + _this.attr('data-goods-id'));
                    }

                    if (result == 'hide') {
                        _this.text('上架');
                        _this.attr('data-href', "/MIAOBELER/index.php/Admin/Goods/show/goods_id/" + _this.attr('data-goods-id'));
                    }

                })

            });


            $(document).on('click', '#remove', function () {

                var o = table.checkStatus('goodsTable');
                if (o.data.length <= 0) {
                    console.log('啥也没选，别点了');
                    return;
                }

                layer.confirm('确定删除这些商品？', function (index) {

                    var id = '';

                    for (var i = 0; i < o.data.length; i++) {
                        id += "'" + o.data[i].goods_id + "',";
                    }
                    id = id.substring(0, id.length - 1);
                    $.post('/MIAOBELER/index.php/Admin/Goods/removes', {
                        'goods_id': id
                    }, function (result) {

                        var obj = JSON.parse(result);

                        if (obj.result === 'success') {
                            layer.msg(obj.message);

                            tableIns.reload({
                                url: '<?php echo U("Goods/getList");?>', //设置异步接口
                            });


                        }

                    });

                });

            });
            $(document).on('click', '#showall', function () {

                var o = table.checkStatus('goodsTable');

                if (o.data.length <= 0) {
                    console.log('啥也没选，别点了');
                    return;
                }

                var id = '';

                for (var i = 0; i < o.data.length; i++) {
                    id += "'" + o.data[i].goods_id + "',";
                }
                id = id.substring(0, id.length - 1);

                console.log(id);

                $.post('/MIAOBELER/index.php/Admin/Goods/shows', {
                    'goods_id': id
                }, function (result) {

                    var obj = JSON.parse(result);

                    if (obj.result === 'success') {

                        if (obj.message >= 1) {
                            layer.msg('上架了' + obj.message + '条商品');

                            tableIns.reload({
                                url: '<?php echo U("Goods/getList");?>', //设置异步接口
                            });

                        } else {
                            layer.msg('并没有商品可以被上架');

                        }

                    }

                });

            });
            $(document).on('click', '#hideall', function () {

                var o = table.checkStatus('goodsTable');
                if (o.data.length <= 0) {
                    console.log('啥也没选，别点了');
                    return;
                }

                var id = '';

                for (var i = 0; i < o.data.length; i++) {
                    id += "'" + o.data[i].goods_id + "',";
                }
                id = id.substring(0, id.length - 1);
                $.post('/MIAOBELER/index.php/Admin/Goods/hides', {
                    'goods_id': id
                }, function (result) {

                    var obj = JSON.parse(result);

                    if (obj.result === 'success') {

                        if (obj.message >= 1) {
                            layer.msg('下架了' + obj.message + '条商品');
                            tableIns.reload({
                                url: '<?php echo U("Goods/getList");?>', //设置异步接口
                            });
                        } else {
                            layer.msg('并没有商品可以被下架');

                        }

                    }

                });

            });

        })
    </script>
</body>

</html>