<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>订单列表</title>

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
            <legend>订单列表</legend>
        </fieldset>

        <div class="layui-btn-group">

            <!--<button class="layui-btn layui-btn-small" id="remove">
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
            </button>-->
        </div>

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
                    <th lay-data="{field:'tool', width:80,fixed:'left',align:'center'}">操作</th>
                    <th lay-data="{field:'order_id', width:200}">订单号</th>
                    <th lay-data="{field:'goods_title', width:200}">商品</th>

                    <th lay-data="{field:'user_id', width:100}">用户</th>
                    <th lay-data="{field:'odd_id', width:200}">快递单号</th>
                    <th lay-data="{field:'num', width:100}">购买数量</th>
                    <th lay-data="{field:'money', width:100}">应付金额</th>
                    <th lay-data="{field:'user_oeny', width:100}">已付金额</th>
                    <th lay-data="{field:'payment_method', width:100}">支付方式</th>
                    <th lay-data="{field:'state', width:150}">状态</th>
                    <th lay-data="{field:'add_time', width:200}">添加时间</th>
                    <th lay-data="{field:'edit_time', width:200}">最后修改时间</th>

                </tr>
            </thead>

            <tbody>
                <?php if(is_array($orderList)): $i = 0; $__LIST__ = $orderList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr id="<?php echo ($vol["order_id"]); ?>">
                        <td>

                            <?php if($vol["state"] == 1): endif; ?>
                            <?php if($vol["state"] == 2): ?><a href="<?php echo U('Express/showInfo','order_id='.$vol['order_id']);?>" data-id='<?php echo ($vol["goods_id"]); ?>' class="layui-btn layui-btn-mini layui-btn-warm">
                                    <span>去发货</span>
                                </a><?php endif; ?>
                            <?php if($vol["state"] == 3): endif; ?>
                            <?php if($vol["state"] == 4): endif; ?>
                            <?php if($vol["state"] == 5): ?><a href="<?php echo U('CS/showInfo','order_id='.$vol['order_id']);?>" data-id='<?php echo ($vol["goods_id"]); ?>' class="layui-btn layui-btn-mini layui-btn-normal">
                                    <span>去处理</span>
                                </a><?php endif; ?>
                            <?php if($vol["state"] == 6): endif; ?>
                            <?php if($vol["state"] == 7): endif; ?>

                        </td>

                        <td><?php echo ($vol["order_id"]); ?></td>

                        <td>
                            <a href="<?php echo U('Goods/edit','goods_id='.$vol['goods_id']);?>">【<?php echo ($vol["goods_title"]); ?>】</a>
                        </td>

                        <td><?php echo ($vol["user_id"]); ?></td>
                        <td>

                            <a href="<?php echo U('Express/showInfo','order_id='.$vol['order_id']);?>" data-id='<?php echo ($vol["goods_id"]); ?>' class="">
                                <span>【<?php echo ((isset($vol["odd_id"]) && ($vol["odd_id"] !== ""))?($vol["odd_id"]):"未发货"); ?>】</span>
                            </a>

                        </td>
                        <td><?php echo ($vol["num"]); ?></td>
                        <td><?php echo ($vol["money"]); ?></td>
                        <td><?php echo ($vol["user_money"]); ?></td>

                        <td>
                            <?php if($vol["payment_method"] == 1): ?><!--微信-->
                                <i class="fa fa-weixin" style="color: #5FB878;"></i><?php endif; ?>
                            <?php if($vol["payment_method"] == 2): ?><!--支付宝-->
                                <img src="/MIAOBELER/Public/dist/img/zfb.ico" class="payment-method" /><?php endif; ?>

                        </td>
                        <td>

                            <!--1：待付款
2：待发货
3：待收货
4：完成
5：售后处理（退换货）
-->

                            <?php if($vol["state"] == 1): ?><span class="layui-badge">待付款</span><?php endif; ?>
                            <?php if($vol["state"] == 2): ?><span class="layui-badge layui-bg-orange">待发货</span><?php endif; ?>
                            <?php if($vol["state"] == 3): ?><span class="layui-badge layui-bg-green">待收货</span><?php endif; ?>
                            <?php if($vol["state"] == 4): ?><span class="layui-badge layui-bg-cyan">完成</span><?php endif; ?>
                            <?php if($vol["state"] == 5): ?><span class="layui-badge layui-bg-blue">售后</span>

                                <?php if($vol["customer_service_info"] == 0): ?><span class="layui-badge layui-bg-gray">未处理</span><?php endif; ?>
                                <?php if($vol["customer_service_info"] == 1): ?><span class="layui-badge layui-bg-gray">仅退货</span><?php endif; ?>
                                <?php if($vol["customer_service_info"] == 2): ?><span class="layui-badge layui-bg-gray">仅退款</span><?php endif; ?>
                                <?php if($vol["customer_service_info"] == 3): ?><span class="layui-badge layui-bg-gray">退货退款</span><?php endif; ?>
                                <?php if($vol["customer_service_info"] == 4): ?><span class="layui-badge layui-bg-gray">退换货</span><?php endif; endif; ?>

                        </td>
                        <td><?php echo (date('Y-m-d H:i:s',$vol["add_time"])); ?></td>
                        <td><?php echo (date('Y-m-d H:i:s',$vol["edit_time"])); ?></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
        <div class="test"></div>

        <script src="/MIAOBELER/Public/vendor/jquery/jquery-2.1.0.js" type="text/javascript" charset="utf-8"></script>
        <script src="/MIAOBELER/Public/vendor/layer/layer.js"></script>
        <script src="/MIAOBELER/Public/vendor/layui/layui.js"></script>

        <script type="text/javascript">
            var table;
            layui.use('table', function() {

                table = layui.table;
                table.init('demo', {});

            });
        </script>
    </body>

</html>