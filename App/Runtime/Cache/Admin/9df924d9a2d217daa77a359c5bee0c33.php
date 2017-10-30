<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <link rel="stylesheet" type="text/css" href="/Public/vendor/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/Public/vendor/font-awesome/css/font-awesome.css" />
        <link rel="stylesheet" type="text/css" href="/Public/dist/main/main.css" />
        <title>后台管理</title>

    </head>

    <body>
        <div class="top_nav">

            <div class="logo">MIAOBELER ADMIN</div>

            <ul>
                <li>
                    <a href="javascript:;">
                        <span>管理账户</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <span>消息</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <span>退出登录</span>
                    </a>
                </li>
            </ul>

        </div>
        <div class="left-nav">
            <ul>
                <li>

                    <a href="javascript:;" data-src='Goods/add'>
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>添加商品</span>
                    </a>

                </li>
                <li>

                    <a href="javascript:;" data-src='Goods/showList'>
                        <i class="glyphicon glyphicon-shopping-cart"></i>
                        <span>商品管理</span>
                    </a>

                </li>
                <li>

                    <a href="javascript:;" data-src='Order/showList'>
                        <i class="glyphicon glyphicon-list-alt"></i>
                        <span>订单管理</span>
                    </a>

                </li>
                <li>

                    <a href="javascript:;" data-src='Express/showList'>
                        <i class="fa fa-truck"></i>
                        <span>发货管理</span>
                    </a>

                </li>
                <li>

                    <a href="javascript:;" data-src='CS/showList'>
                        <i class="glyphicon glyphicon-tags"></i>
                        <span>售后管理</span>
                    </a>

                </li>
                <li class="fg"></li>
                <li>

                    <a href="javascript:;" data-src='Nav/showList'>
                        <i class="glyphicon glyphicon-option-horizontal"></i>
                        <span>导航管理</span>
                    </a>

                </li>
                <li>

                    <a href="javascript:;" data-src='Class/showList'>
                        <i class="glyphicon glyphicon-list"></i>
                        <span>分类管理</span>
                    </a>

                </li>
                <li>

                    <a href="javascript:;" data-src='Carousel/showList'>
                        <i class="glyphicon glyphicon-picture"></i>
                        <span>轮播管理</span>
                    </a>

                </li>
                <li class="fg"></li>

                <li>

                    <a href="javascript:;" data-src="Opinion/showList">
                        <i class="glyphicon glyphicon-envelope"></i>
                        <span>用户反馈</span>
                    </a>

                </li>
                <li>

                    <a href="javascript:;" data-src='CS/peopleList'>
                        <i class="glyphicon glyphicon-headphones"></i>
                        <span>客服管理</span>
                    </a>

                </li>
            </ul>
        </div>
        <div class="content-box">
            <iframe src="" frameborder='0' id="fream"></iframe>
        </div>

        <script src="/Public/vendor/jquery/jquery-2.1.0.js" type="text/javascript" charset="utf-8"></script>
        <script src="/Public/vendor/bootstrap/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript">
            $(function() {

                if('<?php echo ($admin_url); ?>' != null && '<?php echo ($admin_url); ?>' != '') {
                    $('#fream').attr('src', '<?php echo ($admin_url); ?>');
                }

                $(document).on('click', 'a', function() {

                    if(!($(this).attr('data-src') == null)) {
                        $.post('', {
                            url: $(this).attr('data-src')
                        }, function(date) {
                            $('#fream').attr('src', date);

                        })
                    }

                })
            })
        </script>
    </body>

</html>