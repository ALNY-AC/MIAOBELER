<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>售后列表</title>

    <link rel="stylesheet" href="/MIAOBELER/Public/vendor/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" href="/MIAOBELER/Public/vendor/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="/MIAOBELER/Public/vendor/layer/mobile/need/layer.css">
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
        <legend>售后列表</legend>
    </fieldset>

    <!-- <div class="layui-btn-group">
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
        </div> -->
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
                <th lay-data="{field:'user_customer_service_info', width:100}">售后信息</th>
                <th lay-data="{field:'state', width:100}">处理状态</th>
                <th lay-data="{field:'add_time', width:200}">添加时间</th>
                <th lay-data="{field:'edit_time', width:200}">最后修改时间</th>

            </tr>
        </thead>

        <tbody>

            <?php if(is_array($orderList)): $i = 0; $__LIST__ = $orderList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr id="<?php echo ($vol["order_id"]); ?>">
                    <td>

                        <a href="<?php echo U('CS/showInfo','order_id='.$vol['order_id']);?>" class="layui-btn layui-btn-mini">
                            <span>去处理</span>
                        </a>

                    </td>

                    <td><?php echo ($vol["order_id"]); ?></td>

                    <td>
                        <a href="<?php echo U('Goods/edit','goods_id='.$vol['goods_id']);?>">【<?php echo ($vol["goods_title"]); ?>】</a>
                    </td>

                    <td><?php echo ($vol["user_id"]); ?></td>

                    <td>

                        <?php echo ($vol["user_customer_service_info"]); ?>

                    </td>

                    <td>

                        <?php if($vol["customer_service_info"] == 0): ?><span class="layui-badge layui-bg-blue">未处理</span><?php endif; ?>
                        <?php if($vol["customer_service_info"] == 1): ?><span class="layui-badge layui-bg-blue">仅退货</span><?php endif; ?>
                        <?php if($vol["customer_service_info"] == 2): ?><span class="layui-badge layui-bg-blue">仅退款</span><?php endif; ?>
                        <?php if($vol["customer_service_info"] == 3): ?><span class="layui-badge layui-bg-blue">退货退款</span><?php endif; ?>
                        <?php if($vol["customer_service_info"] == 4): ?><span class="layui-badge layui-bg-blue">退换货</span><?php endif; ?>

                    </td>
                    <td><?php echo (date('Y-m-d H:i:s',$vol["add_time"])); ?></td>
                    <td><?php echo (date('Y-m-d H:i:s',$vol["edit_time"])); ?></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>

    <script src="/MIAOBELER/Public/vendor/jquery/jquery-2.1.0.js" type="text/javascript" charset="utf-8"></script>
    <script src="/MIAOBELER/Public/vendor/layer/layer.js"></script>
    <script src="/MIAOBELER/Public/vendor/layui/layui.js"></script>

    <script type="text/javascript">
        var table;
        layui.use('table', function () {

            table = layui.table;
            table.init('demo', {});

        });
    </script>
</body>

</html>