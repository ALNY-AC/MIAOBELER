<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>用户管理</title>

        <link rel="stylesheet" href="/Public/vendor/layui/css/layui.css">
        <link rel="stylesheet" href="/Public/vendor/layer/mobile/need/layer.css">
        <style type="text/css">
            body {
                padding: 20px;
                padding-bottom: 100px;
                padding-top: 80px;
            }
            
            img.head-img {
                max-width: 50px;
                max-height: 50px;
                border-radius: 50%;
            }
        </style>
    </head>

    <body>

        <fieldset class="layui-elem-field layui-field-title">
            <legend>用户管理</legend>
        </fieldset>
        <div id="test"></div>
        <div class="layui-btn-group">
            <a class="layui-btn layui-btn-small" id="add" href="<?php echo U('add');?>">
                <span>添加用户</span>
                <i class="layui-icon">&#xe654;</i>
            </a>

            <button class="layui-btn layui-btn-small" id="removeALL">
                <span>批量删除</span>
                <i class="layui-icon">&#xe640;</i>
            </button>
            <button class="layui-btn layui-btn-small" id="banAll">
                <span>批量封号</span>
                <i class="layui-icon">&#x1006;</i>
            </button>
            <button class="layui-btn layui-btn-small" id="NoBanAll">
                <span>批量解封</span>
                <i class="layui-icon">&#x1006;</i>
            </button>
        </div>

        <script type="text/html" id="barDemo">
            <a class="layui-btn layui-btn-danger layui-btn-mini" lay-event="del">删除</a>
        </script>
        <table class="layui-table" lay-data="{id:'table1',page:true,limit:10}" lay-size="lg" lay-filter="demo">
            <thead>
                <tr>

                    <th lay-data="{checkbox:true,fixed: true}"></th>

                    <th lay-data="{field:'user_id', width:180,sort:true}">用户id</th>
                    <th lay-data="{field:'head_img_url', width:80}">头像</th>
                    <th lay-data="{field:'user_name', width:300,sort:true}">昵称</th>
                    <th lay-data="{field:'user_info', width:300,sort:true}">签名</th>
                    <th lay-data="{field:'integral', width:100,sort:true}">积分</th>
                    <th lay-data="{field:'consume_count', width:100,align:'center'}">累计消费</th>

                    <th lay-data="{field:'add_time', width:180,sort:true}">添加时间</th>
                    <th lay-data="{field:'last_time', width:180,sort:true}">最后登录时间</th>
                    <th lay-data="{field:'is_ban', width:80,sort:true,align:'center',fixed:'right',}">封禁</th>
                    <th lay-data="{field:'tool', width:80, align:'center',fixed:'right',toolbar: '#barDemo'}">操作</th>

                </tr>
            </thead>

            <tbody>
                <?php if(is_array($user_info)): $i = 0; $__LIST__ = $user_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr id="<?php echo ($vol["user_id"]); ?>">
                        <td></td>

                        <td id="<?php echo ($vol["id"]); ?>" data-id='<?php echo ($vol["user_id"]); ?>'><?php echo ($vol["user_id"]); ?></td>
                        <td>
                            <img class="head-img" src="<?php echo ($vol["head_img_url"]); ?>" alt="未上传头像" />
                        </td>
                        <td><?php echo ($vol["user_name"]); ?></td>
                        <td><?php echo ($vol["user_info"]); ?></td>

                        <td>
                            <input type="number" value="<?php echo ($vol["integral"]); ?>" autocomplete="off" class="layui-input" data-id-name='user_id' data-id-value='<?php echo ($vol["user_id"]); ?>' data-field='integral'>
                        </td>
                        <td><?php echo ($vol["consume_count"]); ?></td>

                        <td><?php echo (date('Y-m-d H:i:s',$vol["add_time"])); ?></td>
                        <td><?php echo (date('Y-m-d H:i:s',$vol["last_time"])); ?></td>
                        <td>
                            <?php if($vol["is_ban"] == 1): ?><input type="checkbox" lay-filter="toggleBan" lay-skin="primary" id="toggleBan_<?php echo ($vol["user_id"]); ?>" data-href="<?php echo U('toggleBan','user_id='.$vol['user_id']);?>" checked="">
                                <?php else: ?>
                                <input type="checkbox" lay-filter="toggleBan" lay-skin="primary" id="toggleBan_<?php echo ($vol["user_id"]); ?>" data-href="<?php echo U('toggleBan','user_id='.$vol['user_id']);?>"><?php endif; ?>
                        </td>
                        <td>

                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>

        <div class="test"></div>

        <script src="/Public/vendor/jquery/jquery-2.1.0.js" type="text/javascript" charset="utf-8"></script>
        <script src="/Public/vendor/layer/layer.js"></script>
        <script src="/Public/vendor/layui/layui.js"></script>
        <script src="/Public/dist/data/dataTool.js" type="text/javascript" charset="utf-8"></script>

        <script type="text/javascript">
            var table;
            layui.use(['table', 'form'], function() {

                table = layui.table;
                form = layui.form;
                table.init('demo', {});

                //监听工具条
                table.on('tool(demo)', function(obj) { //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
                    var data = obj.data; //获得当前行数据
                    var layEvent = obj.event; //获得 lay-event 对应的值
                    var tr = obj.tr; //获得当前行 tr 的DOM对象
                    console.log(obj)

                    if(layEvent === 'del') {
                        //删除
                        layer.confirm('真的删除此用户吗', function(index) {

                            //向服务端发送删除指令

                            $.post('/index.php/Admin/User/del', {
                                user_id: obj.data.user_id
                            }, function(result) {

                                layer.msg('删除用户成功~');
                                obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
                                layer.close(index);

                            })

                        });

                    }

                    //                  //同步更新缓存对应的值
                    //                  obj.update({
                    //                      username: '123',
                    //                      title: 'xxx'
                    //                  });
                });

                form.on('checkbox(toggleBan)', function(data) {

                    var _this = $(data.elem);
                    $.get(_this.attr('data-href'), function(result) {})

                });
            });

            $(function() {

                $(document).on('click', '.edit-user', function() {
                    var href = $(this).attr('data-href');

                    layer.open({
                        type: 2,
                        title: '编辑用户',
                        shadeClose: true,
                        shade: false,
                        maxmin: true, //开启最大化最小化按钮
                        area: ['893px', '600px'],
                        content: href
                    });
                });

                onAJAX({
                    eventName: 'blur',
                    elName: '.layui-input',
                    fromName: 'user',
                    type: 'post',
                    url: '<?php echo U("Currency/u");?>',
                    fun: function(result) {
                        $('#test').html(result);
                        console.log(result);

                    }
                });

                $(document).on('click', '#remove', function() {
                    //批量删除

                    var o = table.checkStatus('table1');

                    console.log(o);
                    return;

                    if(o.data.length <= 0) {
                        console.log('啥也没选，别乱点');
                        return;
                    }

                    layer.confirm('确定删除这些商品？', function(index) {

                        //  ========== 
                        //  = Banner = 
                        //  ========== 

                        var id = '';

                        for(var i = 0; i < o.data.length; i++) {
                            id += "'" + $('#' + o.data[i].id).parents('tr').attr('id') + "',";
                        }
                        id = id.substring(0, id.length - 1);
                        $.post('/index.php/Admin/User/removes', {
                            'user_id': id
                        }, function(result) {

                            var obj = JSON.parse(result);

                            if(obj.result === 'success') {
                                layer.msg(obj.message);
                                for(var i = 0; i < o.data.length; i++) {

                                    var gid = $('#' + o.data[i].id).attr('data-id');
                                    $('#' + gid).remove();
                                    //                                  table.init('demo', {});

                                }

                            }

                        });

                    });

                });
                $(document).on('click', '#NoBanAll', function() {
                    //解封
                    //                  banAll(0);
                    is_ban = 0;
                    ajaxAll('table1', 'user_id', 'user', '<?php echo U("Currency/uAll");?>', 'post', 'is_ban', is_ban, function(result) {
                        var o = table.checkStatus('table1');
                        var obj = JSON.parse(result);

                        if(obj.result === 'success') {

                            if(obj.message >= 1) {
                                layer.msg('修改了' + obj.message + '条数据');

                                for(var i = 0; i < o.data.length; i++) {

                                    var user_id_s = $('#toggleBan_' + o.data[i].user_id);
                                    user_id_s.removeAttr('checked');

                                    if(is_ban == 1) {
                                        user_id_s.attr('checked', 'checked');
                                    }
                                    table.init('demo', {});
                                }
                            } else {
                                layer.msg('并没有用户可以被修改');

                            }

                        }

                    });
                });
                $(document).on('click', '#banAll', function() {
                    //封禁
                    //                  banAll(1);
                    is_ban = 1;
                    ajaxAll('table1', 'user_id', 'user', '<?php echo U("Currency/uAll");?>', 'post', 'is_ban', is_ban, function(result) {
                        var o = table.checkStatus('table1');
                        var obj = JSON.parse(result);

                        if(obj.result === 'success') {

                            if(obj.message >= 1) {
                                layer.msg('修改了' + obj.message + '条数据');

                                for(var i = 0; i < o.data.length; i++) {

                                    var user_id_s = $('#toggleBan_' + o.data[i].user_id);
                                    user_id_s.removeAttr('checked');

                                    if(is_ban == 1) {
                                        user_id_s.attr('checked', 'checked');
                                    }
                                    table.init('demo', {});
                                }
                            } else {
                                layer.msg('并没有用户可以被修改');

                            }

                        }

                    });

                });

                //              function banAll(is_ban) {
                //
                //                  var o = table.checkStatus('table1');
                //
                //                  if(o.data.length <= 0) {
                //                      layer.msg('啥也没选，别点了');
                //                      return;
                //                  }
                //
                //                  var id = '';
                //
                //                  for(var i = 0; i < o.data.length; i++) {
                //                      id += "'" + o.data[i].user_id + "',";
                //                  }
                //                  id = id.substring(0, id.length - 1);
                //                  $.post('/index.php/Admin/User/toggleBanAll', {
                //                      'user_id': id,
                //                      'is_ban': is_ban
                //                  }, function(result) {
                //
                //                      console.log(result);
                //
                //                      var obj = JSON.parse(result);
                //
                //                      if(obj.result === 'success') {
                //
                //                          if(obj.message >= 1) {
                //                              layer.msg('修改了' + obj.message + '条数据');
                //
                //                              for(var i = 0; i < o.data.length; i++) {
                //
                //                                  var user_id_s = $('#toggleBan_' + o.data[i].user_id);
                //                                  user_id_s.removeAttr('checked');
                //
                //                                  if(is_ban == 1) {
                //                                      user_id_s.attr('checked', 'checked');
                //                                  }
                //                                  table.init('demo', {});
                //                              }
                //                          } else {
                //                              layer.msg('并没有用户可以被修改');
                //
                //                          }
                //
                //                      }
                //
                //                  });
                //
                //              }

            })
        </script>
    </body>

</html>