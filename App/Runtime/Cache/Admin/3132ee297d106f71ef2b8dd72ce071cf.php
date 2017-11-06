<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>发货列表</title>

    <link rel="stylesheet" href="/Public/vendor/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" href="/Public/vendor/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="/Public/vendor/layer/mobile/need/layer.css">
    <style type="text/css">
        body {
            padding: 20px;
            padding-bottom: 100px;
            padding-top: 80px;

        }

        .payment-method {
            max-width: 10px;
            max-height: 20px;
        }
    </style>
</head>

<body>

    <fieldset class="layui-elem-field layui-field-title">
        <legend>发货列表</legend>
    </fieldset>

    <table class="layui-table" id="table1id" lay-data="{id:'table1',page:true}" lay-filter="demo">
        <thead>

            <!--
order_id
goods_id
user_id
odd_id
num
money
add_time
edit_time
payment_method
state
-->

            <tr>
                <th lay-data="{field:'tool', width:100,fixed:'left'}">操作</th>
                <th lay-data="{field:'order_id', width:200}">订单号</th>
                <th lay-data="{field:'goods_title', width:200}">商品</th>
                <th lay-data="{field:'user_id', width:100}">用户</th>
                <th lay-data="{field:'state', width:100}">发货状态</th>
                <th lay-data="{field:'add_time', width:200}">添加时间</th>
                <th lay-data="{field:'edit_time', width:200}">最后修改时间</th>

            </tr>
        </thead>

        <tbody>

            <?php if(is_array($orderList)): $i = 0; $__LIST__ = $orderList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr id="<?php echo ($vol["order_id"]); ?>">
                    <td>

                        <a href="<?php echo U('showInfo','order_id='.$vol['order_id']);?>" class="layui-btn layui-btn-mini layui-btn-warm">
                            <span>去发货</span>
                        </a>

                    </td>

                    <td><?php echo ($vol["order_id"]); ?></td>

                    <td>
                        <a href="<?php echo U('Goods/edit','goods_id='.$vol['goods_id']);?>">【<?php echo ($vol["goods_title"]); ?>】</a>
                    </td>

                    <td><?php echo ($vol["user_id"]); ?></td>

                    <td>
                        <span class="layui-badge layui-bg-orange">待发货</span>
                    </td>
                    <td><?php echo (date('Y-m-d H:i:s',$vol["add_time"])); ?></td>
                    <td><?php echo (date('Y-m-d H:i:s',$vol["edit_time"])); ?></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
    <div class="test"></div>

    <script src="/Public/vendor/jquery/jquery-2.1.0.js" type="text/javascript" charset="utf-8"></script>
    <script src="/Public/vendor/layer/layer.js"></script>
    <script src="/Public/vendor/layui/layui.js"></script>

    <script type="text/javascript">
        var table;
        layui.use('table', function () {

            table = layui.table;
            table.init('demo', {});

        });
    </script>
</body>

</html>