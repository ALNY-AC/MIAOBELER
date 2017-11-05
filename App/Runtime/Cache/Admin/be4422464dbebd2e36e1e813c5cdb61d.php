<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>商品列表2</title>

    <link rel="stylesheet" href="/Public/vendor/layui/css/layui.css">
    <link rel="stylesheet" href="/Public/vendor/layer/mobile/need/layer.css">
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
        <legend>商品列表2</legend>
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

    <div class="demoTable">
        搜索ID：
        <div class="layui-inline">
            <input class="layui-input" name="id" id="demoReload" autocomplete="off">
        </div>
        <button class="layui-btn" data-type="reload">搜索</button>
    </div>

    <table class="layui-table" id="goodsTable" lay-filter="demo">
    </table>
    <div class="test"></div>

    <script src="/Public/vendor/jquery/jquery-2.1.0.js" type="text/javascript" charset="utf-8"></script>
    <script src="/Public/vendor/layer/layer.js"></script>
    <script src="/Public/vendor/layui/layui.js"></script>

    <script type="text/html" id="barDemo">
        <a class="layui-btn layui-btn-mini" lay-event="detail">查看</a>
        <a class="layui-btn layui-btn-mini" lay-event="edit">编辑</a>
        <a class="layui-btn layui-btn-danger layui-btn-mini" lay-event="del">删除</a>
        
        <!-- 这里同样支持 laytpl 语法，如： -->
        {{#  if(d.auth > 2){ }}
          <a class="layui-btn layui-btn-mini" lay-event="check">审核</a>
        {{#  } }}
    </script>

    <script type="text/html" id="isShowTool">
        <!-- 上下架控制 -->
        <a class="layui-btn layui-btn-mini" lay-event="detail">上架</a>
        <a class="layui-btn layui-btn-mini" lay-event="edit">下架</a>
    </script>


    <script type="text/javascript">
        var table;
        layui.use('table', function () {

            table = layui.table;
            // table.init('demo', {});




            $.get('<?php echo U("Goods/getList");?>', {}, function (result) {
                var goodsList;
                goodsList = JSON.parse(result).message;

                console.log(goodsList.message);

                table.render({
                    elem: '#goodsTable',
                    page: true,
                    //赋值数据============
                    data: goodsList,
                    //设置行================
                    cols: [
                        [
                            { checkbox: true, fixed: true, width: 100 },
                            { field: 'id', title: 'ID', width: 100 },
                            { field: 'goods_id', title: '商品id', width: 100 },
                            { field: 'title', title: '商品标题', width: 100 },
                            { field: 'str_price', title: '原价', width: 100, sort: true },
                            { field: 'price', title: '现价', width: 100, sort: true },
                            { field: 'integral', title: '积分', width: 100, sort: true },
                            { field: 'class_title', title: '分类', width: 100, sort: true },
                            { field: 'add_time', title: '添加时间', width: 130, sort: true },
                            { field: 'edit_time', title: '最后修改时间', width: 130, sort: true },
                            { field: 'is_show', title: '上/下架', width: 130, align: 'center', sort: true, toolbar: '#isShowTool' },
                            { fixed: 'right', width: 150, align: 'center', toolbar: '#barDemo' },//这里的toolbar值是模板元素的选择器
                        ]
                    ],
                });

            })










        });

        $(function () {

            $(document).on('click', '.upshow', function () {

                var _this = $(this);
                $.get($(this).attr('data-href'), function (result) {
                    _this.toggleClass('layui-btn-primary');

                    if (result == 'show') {
                        _this.text('下架');
                        _this.attr('data-href', "/index.php/Admin/Goods/hide/goods_id/" + _this.attr('data-goods-id'));
                    }

                    if (result == 'hide') {
                        _this.text('上架');
                        _this.attr('data-href', "/index.php/Admin/Goods/show/goods_id/" + _this.attr('data-goods-id'));
                    }

                })

            });
            $(document).on('click', '.remove-goods', function () {
                var _this = $(this);

                layer.confirm('确定删除此商品？', function (index) {

                    $.post(_this.attr('data-href'), function (result) {

                        $('#' + _this.attr('data-id')).remove();
                        layer.msg('删除成功~');
                        table.init('demo', {});
                    })

                });

            });

            $(document).on('click', '#remove', function () {

                var o = table.checkStatus('table1');
                if (o.data.length <= 0) {
                    console.log('啥也没选，别乱点');
                    return;
                }

                layer.confirm('确定删除这些商品？', function (index) {

                    var id = '';

                    for (var i = 0; i < o.data.length; i++) {
                        id += "'" + $('#' + o.data[i].id).parents('tr').attr('id') + "',";
                    }
                    id = id.substring(0, id.length - 1);
                    $.post('/index.php/Admin/Goods/removes', {
                        'goods_id': id
                    }, function (result) {

                        var obj = JSON.parse(result);

                        if (obj.result === 'success') {
                            layer.msg(obj.message);
                            for (var i = 0; i < o.data.length; i++) {

                                var gid = $('#' + o.data[i].id).attr('data-id');
                                $('#' + gid).remove();
                                table.init('demo', {});

                            }

                        }

                    });

                });

            });
            $(document).on('click', '#showall', function () {

                var o = table.checkStatus('table1');
                if (o.data.length <= 0) {
                    console.log('啥也没选，别点了');
                    return;
                }

                var id = '';

                for (var i = 0; i < o.data.length; i++) {
                    id += "'" + $('#' + o.data[i].id).parents('tr').attr('id') + "',";
                }
                id = id.substring(0, id.length - 1);
                $.post('/index.php/Admin/Goods/shows', {
                    'goods_id': id
                },
                    function (result) {

                        var obj = JSON.parse(result);

                        if (obj.result === 'success') {

                            if (obj.message >= 1) {
                                layer.msg('上架了' + obj.message + '条商品');
                                for (var i = 0; i < o.data.length; i++) {

                                    var gid = $('#' + o.data[i].id).attr('data-id');
                                    //                              $('#' + gid)
                                    //upshow
                                    $g = $('#' + gid).find('.upshow');

                                    $g.removeClass('layui-btn-primary');
                                    $g.text('下架');
                                    $g.attr('data-href', "/index.php/Admin/Goods/show/goods_id/" + $g.attr('data-goods-id'));
                                    table.init('demo', {});

                                }

                            } else {
                                layer.msg('并没有商品可以被上架');

                            }

                        }

                    });

            });
            $(document).on('click', '#hideall', function () {

                var o = table.checkStatus('table1');
                if (o.data.length <= 0) {
                    console.log('啥也没选，别乱点');
                    return;
                }

                var id = '';

                for (var i = 0; i < o.data.length; i++) {
                    id += "'" + $('#' + o.data[i].id).parents('tr').attr('id') + "',";
                }
                id = id.substring(0, id.length - 1);
                $.post('/index.php/Admin/Goods/hides', {
                    'goods_id': id
                }, function (result) {

                    var obj = JSON.parse(result);

                    if (obj.result === 'success') {

                        if (obj.message >= 1) {
                            layer.msg('下架了' + obj.message + '条商品');

                            for (var i = 0; i < o.data.length; i++) {

                                var gid = $('#' + o.data[i].id).attr('data-id');
                                //                              $('#' + gid)
                                //upshow
                                $g = $('#' + gid).find('.upshow');
                                console.log($g);

                                $g.addClass('layui-btn-primary');
                                $g.text('上架');
                                $g.attr('data-href', "/index.php/Admin/Goods/show/goods_id/" + $g.attr('data-goods-id'));
                                table.init('demo', {});

                            }
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