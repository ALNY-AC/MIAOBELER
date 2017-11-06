<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" type="text/css" href="/Public/vendor/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/vendor/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="/Public/dist/main/main.css" />
    <link rel="stylesheet" type="text/css" href="/Public/dist/icon/iconfont.css" />

    <style>
       
    </style>

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

                <a href="javascript:;" data-src='Goods/showList2'>
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

        </ul>
        <div class="fg"></div>
        <ul>
            <li>

                <a href="javascript:;" data-src='FrontEnd/show'>
                    <!--<i class="glyphicon glyphicon-phone"></i>-->
                    <i class="iconfont icon-5"></i>
                    <span>App设计</span>
                </a>

            </li>
            <li>

                <a href="javascript:;" data-src='Brand/showList'>
                    <i class="glyphicon glyphicon-globe"></i>
                    <span>品牌管理</span>
                </a>

            </li>
            <li>

                <a href="javascript:;" data-src='Brand/add'>
                    <i class="glyphicon glyphicon-globe"></i>
                    <span>添加品牌</span>
                </a>

            </li>
        </ul>

        <div class="fg"></div>

        <ul>
            <li>

                <a href="javascript:;" data-src="User/showList">
                    <i class="glyphicon glyphicon-user"></i>
                    <span>用户管理</span>
                </a>

            </li>
        </ul>
        <div class="fg"></div>
        <ul>

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
        $(function () {

            if ('<?php echo ($admin_url); ?>' != null && '<?php echo ($admin_url); ?>' != '') {
                $('#fream').attr('src', '<?php echo ($admin_url); ?>');
            }

            $(document).on('click', 'a', function () {

                if (!($(this).attr('data-src') == null)) {
                    $.post('', {
                        url: $(this).attr('data-src')
                    }, function (date) {
                        $('#fream').attr('src', date);

                    })
                }

            })
        })
    </script>
</body>

</html>