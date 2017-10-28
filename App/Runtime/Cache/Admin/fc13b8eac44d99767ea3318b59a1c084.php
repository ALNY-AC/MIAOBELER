<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>商品列表</title>

        <link rel="stylesheet" href="/Public/vendor/layui/css/layui.css">
        <link rel="stylesheet" href="/Public/vendor/layer/mobile/need/layer.css">
        <style type="text/css">
            body {
                padding: 20px;
                padding-bottom: 100px;
            }
        </style>
    </head>

    <body>

        <fieldset class="layui-elem-field layui-field-title">
            <legend>商品列表</legend>
        </fieldset>

        <div class="layui-btn-group">
            <a class="layui-btn layui-btn-small" id="add" href="<?php echo U('add');?>">
                <span>添加商品</span>
                <i class="layui-icon">&#xe654;</i>
            </a>

            <button class="layui-btn layui-btn-small" id="remove">
                <span>批量删除</span>
                <i class="layui-icon">&#xe640;</i>
            </button>
            <button class="layui-btn layui-btn-small" id="remove">
                <span>批量上架</span>
                <i class="layui-icon">&#xe698;</i>
            </button>
        </div>

        <table class="layui-table" lay-data="{id:'table1',page:true}" lay-filter="demo">
            <thead>
                <tr>
                    <th lay-data="{checkbox:true,fixed: true}"></th>
                    <th lay-data="{field:'id', width:100}" class="text-center">id</th>
                    <th lay-data="{field:'title', width:300,sort:true}">商品标题</th>
                    <!---->
                    <!--<th lay-data="{field:'goods_id', width:300}">商品id</th>-->
                    <th lay-data="{field:'str_price', width:100,sort:true}">原价</th>
                    <th lay-data="{field:'price', width:100,sort:true}">现价</th>
                    <th lay-data="{field:'integral', width:100,sort:true}">积分</th>
                    <th lay-data="{field:'info_id', width:80}">详情页</th>
                    <th lay-data="{field:'class_id', width:100,sort:true}">分类</th>
                    <th lay-data="{field:'add_time', width:180,sort:true}">添加时间</th>
                    <th lay-data="{field:'edit_time', width:180,sort:true}">最后修改时间</th>
                    <th lay-data="{field:'is_show', width:100,sort:true}">上/下架</th>
                    <th lay-data="{field:'tool', width:180}">操作</th>
                </tr>
            </thead>

            <?php if(is_array($goodsList)): $i = 0; $__LIST__ = $goodsList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
                    <td></td>
                    <td><?php echo ($vol["id"]); ?></td>
                    <td><?php echo ($vol["title"]); ?></td>
                    <!---->
                    <!--<td><?php echo ($vol["goods_id"]); ?></td>-->
                    <td><?php echo ($vol["str_price"]); ?></td>
                    <td><?php echo ($vol["price"]); ?></td>
                    <td><?php echo ($vol["integral"]); ?></td>
                    <td>
                        <button class="layui-btn layui-btn-mini" data-info-id='<?php echo ($vol["info_id"]); ?>'>查看</button>
                    </td>
                    <td><?php echo ($vol["class_title"]); ?></td>
                    <td><?php echo (date('Y-m-d H:i:s',$vol["add_time"])); ?></td>
                    <td><?php echo (date('Y-m-d H:i:s',$vol["edit_time"])); ?></td>
                    <td>
                        <?php if($vol["is_show"] == 1): ?><!--已经上架-->
                            <a href="javascript:;" class="layui-btn layui-btn-mini upshow" data-goods-id="<?php echo ($vol['goods_id']); ?>" data-href="<?php echo U('hide','goods_id='.$vol['goods_id']);?>">下架</a>
                            <?php else: ?>
                            <!--已经下架-->
                            <a href="javascript:;" class="layui-btn layui-btn-mini layui-btn-primary upshow" data-goods-id="<?php echo ($vol['goods_id']); ?>" data-href="<?php echo U('show','goods_id='.$vol['goods_id']);?>">上架</a><?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo U('edit','goods_id='.$vol['goods_id']);?>" class="layui-btn layui-btn-mini layui-btn-primary edit-goods">
                            <span>编辑</span>
                            <i class="layui-icon">&#xe642;</i>
                        </a>
                        <button data-href="<?php echo U('remove','goods_id='.$vol['goods_id']);?>" class="layui-btn layui-btn-mini layui-btn-primary remove-goods">
                            <span>删除</span>
                            <i class="layui-icon">&#xe640;</i>
                        </button>

                    </td>

                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>

        <script src="/Public/vendor/jquery/jquery-2.1.0.js" type="text/javascript" charset="utf-8"></script>
        <script src="/Public/vendor/layer/layer.js"></script>
        <script src="/Public/vendor/layui/layui.js"></script>

        <script type="text/javascript">
            var table;
            layui.use('table', function() {

                table = layui.table;
                table.init('demo', {});

            });

            $(function() {

                $(document).on('click', '.upshow', function() {

                    var _this = $(this);
                    $.get($(this).attr('data-href'), function(result) {
                        _this.toggleClass('layui-btn-primary');

                        if(result == 'show') {
                            _this.text('下架');
                            _this.attr('data-href', "/index.php/Admin/Goods/hide/goods_id/" + _this.attr('data-goods-id'));

                        }

                        if(result == 'hide') {
                            _this.text('上架');
                            _this.attr('data-href', "/index.php/Admin/Goods/show/goods_id/" + _this.attr('data-goods-id'));
                        }

                    })

                });
                $(document).on('click', '.remove-goods', function() {
                    var _this = $(this);

                    layer.confirm('确定删除此商品？', function(index) {

                        $.get(_this.attr('data-href'), function(result) {

                            console.log(result);
                            _this.parents('tr').remove();

                            layer.msg('删除成功~');

                        })

                    });

                });

            })
        </script>
    </body>

</html>