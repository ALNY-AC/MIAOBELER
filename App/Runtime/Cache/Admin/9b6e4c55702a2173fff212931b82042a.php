<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>用户反馈</title>

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
            <legend>用户反馈</legend>
        </fieldset>

        <!--
            opinion_id
            content
            user_id
            add_time
            state
            info
        -->
        <form class="layui-form" action="">
            <?php if($isWhere == true): ?><input type="checkbox" name="like[read]" lay-filter="filter1" checked="checked" title="仅看未处理"><?php endif; ?>
            <?php if($isWhere == false): ?><input type="checkbox" name="like[read]" lay-filter="filter1" title="仅看未处理"><?php endif; ?>

        </form>

        <table class="layui-table" id="table1id" lay-data="{id:'table1',page:true}" lay-filter="demo">
            <thead>
                <tr>
                    <th lay-data="{field:'opinion_id', width:180}">反馈ID</th>
                    <th lay-data="{field:'type', width:100}">反馈类型</th>
                    <th lay-data="{field:'user_id', width:100, align:'center'}">用户ID</th>
                    <th lay-data="{field:'content', width:180}">反馈内容</th>
                    <th lay-data="{field:'add_time', width:180}">添加时间</th>
                    <th lay-data="{field:'state', width:100}">状态</th>
                    <th lay-data="{field:'tool', width:320, align:'center'}">操作</th>
                </tr>
            </thead>

            <tbody>
                <?php if(is_array($OpinionList)): $i = 0; $__LIST__ = $OpinionList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr id="<?php echo ($vol["opinion_id"]); ?>">

                        <td><?php echo ($vol["opinion_id"]); ?></td>
                        <td><?php echo ($vol["type"]); ?></td>
                        <td><?php echo ($vol["user_id"]); ?></td>
                        <td><?php echo ($vol["content"]); ?></td>
                        <td><?php echo (date('Y-m-d H:i:s',$vol["add_time"])); ?></td>
                        <td>
                            <!--
                                1：待处理
                                2：正在处理
                                3：处理完成
                            -->

                            <?php if($vol["state"] == 1): ?><span class="layui-badge">待处理</span><?php endif; ?>

                            <?php if($vol["state"] == 2): ?><span class="layui-badge layui-bg-orange">正在处理</span><?php endif; ?>
                            <?php if($vol["state"] == 3): ?><span class="layui-badge layui-bg-green">处理完成</span><?php endif; ?>

                        </td>
                        <td>

                            <button data-content='<?php echo ($vol["content"]); ?>' class="layui-btn layui-btn-mini showInfo">查看</button>
                            <a href="<?php echo U('up','opinion_id='.$vol['opinion_id'].'&state=1');?>" class="layui-btn layui-btn-mini layui-btn-danger">未处理</a>
                            <a href="<?php echo U('up','opinion_id='.$vol['opinion_id'].'&state=2');?>" class="layui-btn layui-btn-mini layui-btn-warm">正在处理</a>
                            <a href="<?php echo U('up','opinion_id='.$vol['opinion_id'].'&state=3');?>" class="layui-btn layui-btn-mini ">处理完成</a>
                            <a href="<?php echo U('remove','opinion_id='.$vol['opinion_id']);?>" class="layui-btn layui-btn-mini layui-btn-danger"><i class="layui-icon">&#xe640;</i></a>

                        </td>

                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>

            </tbody>
        </table>
        <div class="test"></div>

        <script src="/Public/vendor/jquery/jquery-2.1.0.js" type="text/javascript" charset="utf-8"></script>
        <script src="/Public/vendor/layer/layer.js"></script>
        <script src="/Public/vendor/layui/layui.js"></script>

        <script type="text/javascript">
            var table;
            layui.use(['form', 'table'], function() {
                var form = layui.form //获取form模块
                table = layui.table;
                table.init('demo', {});

                form.on('checkbox(filter1)', function(data) {
                    console.log(data.elem); //得到checkbox原始DOM对象
                    console.log(data.elem.checked); //开关是否开启，true或者false
                    console.log(data.value); //开关value值，也可以通过data.elem.value得到
                    console.log(data.othis); //得到美化后的DOM对象

                    if(data.elem.checked) {
                        var where = data.elem.checked ? 1 : 2;
                        window.location.href = '/index.php/Admin/Opinion/showList/where/' + where;
                    } else {
                        window.location.href = '/index.php/Admin/Opinion/showList';

                    }

                });

            });

            $(document).on('click', '.showInfo', function() {

                layer.open({
                    type: 0,
                    title: '用户反馈信息',
                    closeBtn: 0,
                    shadeClose: true,
                    skin: 'yourclass',
                    content: $(this).attr('data-content')
                });

            });
        </script>
    </body>

</html>