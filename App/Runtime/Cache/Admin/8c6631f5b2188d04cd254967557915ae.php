<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>售后信息</title>
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

            <h3>售后信息</h3>
            <hr />

            <div class="row" style="padding-bottom: 20px;">
                <div class="col-md-12">
                    <p class="text-muted">订单号：</p>
                    <a href=""><?php echo ($info["order_id"]); ?></a>

                </div>
            </div>
            <div class="row" style="padding-bottom: 20px;">
                <div class="col-md-12">
                    <p class="text-muted">操作：</p>

                    <div class="btn-group" role="group" aria-label="...">
                        <a data-href="<?php echo ($state1); ?>" type="button" class="btn btn-default btn-tool">仅退货</a>
                        <a data-href="<?php echo ($state2); ?>" type="button" class="btn btn-default btn-tool">仅退款</a>
                        <a data-href="<?php echo ($state3); ?>" type="button" class="btn btn-default btn-tool">退货退款</a>
                        <a data-href="<?php echo ($state4); ?>" type="button" class="btn btn-default btn-tool">退换货</a>
                    </div>
                </div>
            </div>
            <div class="row" style="padding-bottom: 20px;">
                <div class="col-md-12">
                    <p class="text-muted">当前状态：</p>

                    <?php if($info["customer_service_info"] == 0): ?><span class="label label-default">未处理</span><?php endif; ?>
                    <?php if($info["customer_service_info"] == 1): ?><span class="label label-default">仅退货</span><?php endif; ?>
                    <?php if($info["customer_service_info"] == 2): ?><span class="label label-default">仅退款</span><?php endif; ?>
                    <?php if($info["customer_service_info"] == 3): ?><span class="label label-default">退货退款</span><?php endif; ?>
                    <?php if($info["customer_service_info"] == 4): ?><span class="label label-default">退换货</span><?php endif; ?>

                </div>

            </div>

            <div class="row">

                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">用户</div>
                        <div class="panel-body">
                            <address>
<strong>超级买家</strong><br>
手机号：11012012138<br>
提交的类型：退换货<br>
<hr />
<strong>售后原因：</strong><br>
<?php echo ($info["user_customer_service_info"]); ?>

</address>

                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-1 text-right">
                    <p class="text-muted">反馈图：</p>
                </div>
                <div class="col-md-11">

                    <div class="row">
                        <div class="col-xs-6 col-md-3">
                            <a href="#" class="thumbnail">
                                <img src="<?php echo ($info["img1_url"]); ?>" class="img-responsive img-rounded" alt="未上传图片">
                            </a>
                        </div>
                        <div class="col-xs-6 col-md-3">
                            <a href="#" class="thumbnail">
                                <img src="<?php echo ($info["img2_url"]); ?>" class="img-responsive img-rounded" alt="未上传图片">
                            </a>
                        </div>
                        <div class="col-xs-6 col-md-3">
                            <a href="#" class="thumbnail">
                                <img src="<?php echo ($info["img3_url"]); ?>" class="img-responsive img-rounded" alt="未上传图片">
                            </a>
                        </div>
                    </div>

                </div>

            </div>

        </div>
        <script src="/Public/vendor/jquery/jquery-2.1.0.js" type="text/javascript" charset="utf-8"></script>
        <script src="/Public/vendor/bootstrap/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>

        <script src="/Public/vendor/layer/layer.js"></script>
        <script type="text/javascript">
            $(document).on('click', '.btn-tool', function() {

                url = $(this).attr('data-href');

                $.get(url, function() {

                    location.reload();

                })

            });
        </script>

    </body>

</html>