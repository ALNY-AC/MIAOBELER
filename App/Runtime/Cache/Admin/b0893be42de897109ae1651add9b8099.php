<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <link rel="stylesheet" href="/Public/vendor/layui/css/layui.css">
        <link rel="stylesheet" type="text/css" href="/Public/vendor/bootstrap/css/bootstrap.min.css" />

        <title>反馈信息</title>
        <style type="text/css">
            body {
                padding: 20px;
            }
            
            a {
                text-decoration: none;
            }
            
            a:hover {
                text-decoration: none;
            }
        </style>
    </head>

    <body>
        <h1><?php echo ($info); ?></h1>

        <a href='<?php echo ($go_url); ?>' class="layui-btn">继续<?php echo ($isgo); ?></a>
        <a href='<?php echo U("showlist");?>' class="layui-btn">返回列表</button>

    </body>

</html>