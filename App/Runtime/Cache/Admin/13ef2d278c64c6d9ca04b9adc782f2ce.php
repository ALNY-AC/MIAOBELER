<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>发货管理</title>
        <link rel="stylesheet" type="text/css" href="/Public/vendor/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/Public/vendor/font-awesome/css/font-awesome.css" />
        <link rel="stylesheet" href="/Public/vendor/layer/mobile/need/layer.css">

        <style type="text/css">
            body {
                padding: 20px;
                padding-bottom: 100px;
            }
            
            .payment-method {
                max-width: 10px;
                max-height: 20px;
            }
        </style>
    </head>

    <body>
        <div class="container">

            <h3>发货管理</h3>
            <hr />

            <div class="row" style="padding-bottom: 20px;">
                <div class="col-md-12">
                    <p class="text-muted">订单号： </p>
                    <a href=""><?php echo ($order["order_id"]); ?></a>
                </div>
            </div>
            <div class="row" style="padding-bottom: 20px;">
                <div class="col-md-12">
                    <p class="text-muted">下单时间：</p>
                    <p><?php echo (date('Y-m-d H:i:s',$order["add_time"])); ?></p>

                </div>
            </div>
            <div class="row" style="padding-bottom: 20px;">
                <div class="col-md-12">
                    <p class="text-muted">当前状态：</p>
                    <?php if($order["state"] == 2): ?><span class="label label-default">未发货</span>
                        <?php else: ?>
                        <span class="label label-default">已发货</span><?php endif; ?>

                </div>
            </div>

            <div class="row">

                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">用户</div>
                        <div class="panel-body">
                            <p>收货人：<?php echo ($address["people"]); ?></p>
                            <p>手机号：<?php echo ($address["phone"]); ?></p>
                            <p>收货地址：<?php echo ($address["content"]); ?></p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">商品</div>
                        <div class="panel-body">请核对商品信息</div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>商品名称</th>
                                    <th>商品数量</th>
                                    <th>单价</th>
                                    <th>需付金额</th>
                                    <th>已付金额</th>
                                </tr>
                            </thead>

                            <tbody>

                                <tr>
                                    <td>
                                        <img style="max-width: 50px;" src="<?php echo ($goods["head_img"]); ?>" /> <?php echo ($goods["title"]); ?>
                                    </td>
                                    <td><?php echo ($order["num"]); ?></td>
                                    <td><?php echo ($goods["price"]); ?></td>
                                    <td><?php echo ($order["money"]); ?></td>
                                    <td><?php echo ($order["user_money"]); ?></td>
                                </tr>

                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">发货单</div>
                        <div class="panel-body">

                            <form method="post">
                                <input type="hidden" name="order_id" value="<?php echo ($order["order_id"]); ?>" />

                                <div class="form-group">
                                    <label for="odd_name">快递公司：</label>
                                    <select class="form-control" name="odd_name" id="odd_name">
                                        <option value="圆通">圆通</option>
                                        <option value="顺丰">顺丰</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="odd_id">快递单号：</label>
                                    <input type="text" autocomplete="off" value="<?php echo ($order["odd_id"]); ?>" class="form-control" name='odd_id' id="odd_id" placeholder="请输入快递单号">
                                </div>

                                <button type="submit" class="btn btn-default po">提交</button>
                            </form>

                        </div>
                    </div>
                </div>

            </div>

        </div>
        <script src="/Public/vendor/jquery/jquery-2.1.0.js" type="text/javascript" charset="utf-8"></script>
        <script src="/Public/vendor/bootstrap/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>

        <script src="/Public/vendor/layer/layer.js"></script>
        <script type="text/javascript">
        </script>

    </body>

</html>