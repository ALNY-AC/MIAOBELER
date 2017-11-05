<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>添加商品</title>

        <!--<link rel="stylesheet" type="text/css" href="/Public/vendor/bootstrap/css/bootstrap.min.css" />-->
        <link rel="stylesheet" type="text/css" href="/Public/vendor/font-awesome/css/font-awesome.css" />
        <!--<link rel="stylesheet" href="./umeditor/themes/default/css/umeditor.css">-->
        <link rel="stylesheet" type="text/css" href="/Public/vendor/umeditor/themes/default/css/umeditor.css" />
        <link rel="stylesheet" href="/Public/vendor/layui/css/layui.css">

        <style type="text/css">
            body {
                padding: 20px;
                padding-bottom: 100px;
            }
            
            #container {
                width: 100%;
                height: 1000px;
            }
        </style>
    </head>

    <body id="body_a">
        <fieldset class="layui-elem-field layui-field-title">
            <legend>添加商品</legend>
        </fieldset>
        <form action="" id="form_a" class="form-horizontal layui-form" method="post" enctype="multipart/form-data">

            <!--  -->
            <div class="layui-form-item">
                <label class="layui-form-label">商品标题：</label>
                <div class="layui-input-block">
                    <input type="text" name="title" placeholder="商品标题" autocomplete="off" class="layui-input">
                </div>
            </div>

            <!--  -->

            <div class="layui-form-item">
                <label class="layui-form-label">原价：</label>
                <div class="layui-input-inline">
                    <input type="number" step="0.01" name="str_price" placeholder="原价" autocomplete="off" class="layui-input">
                </div>
            </div>

            <!--  -->

            <div class="layui-form-item">
                <label class="layui-form-label">现价：</label>
                <div class="layui-input-inline">
                    <input type="number" step="0.01" name="price" placeholder="现价" autocomplete="off" class="layui-input">
                </div>
            </div>

            <!--  -->

            <div class="layui-form-item">
                <label class="layui-form-label">积分：</label>
                <div class="layui-input-inline">
                    <input type="number" name="integral" placeholder="积分" autocomplete="off" class="layui-input">
                </div>
            </div>

            <!--  -->

            <div class="layui-form-item">
                <label class="layui-form-label">类别：</label>
                <div class="layui-input-inline">
                    <select id="quiz1" lay-filter="filter">
                        <option v-for="item in items" :value="item.class_id"> {{ item.title }}</option>
                    </select>

                </div>
                <div class="layui-input-inline">
                    <select name="class_id" id="quiz2" lay-filter="filter2">
                        <option v-for="item in items" :value="item.class_id"> {{ item.title }}</option>
                    </select>
                </div>
            </div>
            <!--  -->

            <div class="layui-form-item">
                <label class="layui-form-label">商品头像：</label>
                <div class="layui-input-inline">
                    <input type="file" name="head_img" placeholder="商品头像">
                </div>
            </div>
            <!--  -->

            <div class="layui-form-item">
                <label class="layui-form-label">详情大图：</label>
                <div class="layui-input-inline">
                    <input type="file" name="head_lg_img" placeholder="详情页的大图">
                </div>
            </div>
            <!--  -->

            <div class="layui-form-item">
                <label class="layui-form-label"></label>
                <div class="layui-input-inline">
                    <button class="layui-btn" lay-submit lay-filter="*">提交</button>
                </div>
            </div>
            <!--  -->

            <div class="layui-form-item">
                <label class="layui-form-label">详情：</label>
                <div class="layui-input-block">
                    <div class="layui-col-md9" style="z-index: 1;">
                        <script id="container" name="content" type="text/plain" style=""></script>
                    </div>
                </div>
            </div>

        </form>

        <!-- 加载编辑器的容器 -->

        <script src="/Public/vendor/jquery/jquery-2.1.0.js" type="text/javascript" charset="utf-8"></script>
        <script src="/Public/vendor/bootstrap/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>

        <!-- 引入 etpl -->
        <script src="/Public/vendor/umeditor/third-party/template.min.js" type="text/javascript" charset="utf-8"></script>
        <!-- 配置文件 -->
        <script src="/Public/vendor/umeditor/umeditor.config.js" type="text/javascript" charset="utf-8"></script>
        <!-- 编辑器源码文件 -->
        <script src="/Public/vendor/umeditor/umeditor.js" type="text/javascript" charset="utf-8"></script>
        <!-- 语言包文件 -->
        <script src="/Public/vendor/umeditor/lang/zh-cn/zh-cn.js" type="text/javascript" charset="utf-8"></script>
        <!---->
        <script src="/Public/vendor/layui/layui.js"></script>
        <script src="/Public/vendor/vue/vue.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript">
            function showRequest() {
                console.log('上传开始');
            }

            function showResponse() {
                console.log('上传完成');

            }

            $(function() {

                var typelist = [];

                var quiz1 = new Vue({
                    el: '#quiz1',
                    data: {
                        items: []
                    }
                });
                var quiz2 = new Vue({
                    el: '#quiz2',
                    data: {
                        items: []
                    }
                });
                var form;
                layui.use('form', function() {
                    form = layui.form;

                    //各种基于事件的操作，下面会有进一步介绍
                    form.on('select(filter)', function(data) {
                        //                  console.log(data.elem); //得到select原始DOM对象
                        //                  console.log(data.value); //得到被选中的值
                        //                  console.log(data.othis); //得到美化后的DOM对象

                        quiz2.items.splice(0, quiz2.items.length);

                        for(x in typelist) {
                            if(typelist[x].super_id == data.value) {
                                console.log(typelist[x]);
                                quiz2.items.push(typelist[x]);
                            }
                        }

                        setTimeout(function() {
                            form.render('select');
                        }, 0);

                    });
                    form.on('select(filter2)', function(data) {
                        console.log(data.elem); //得到select原始DOM对象
                        console.log(data.value); //得到被选中的值
                        console.log(data.othis); //得到美化后的DOM对象

                    });

                    $.getJSON('<?php echo U("Class/getClassList");?>', function(result) {
                        typelist = result.message;
                        for(x in typelist) {
                            if(typelist[x].level == '1') {
                                quiz1.items.push(typelist[x]);
                            }
                        }
                        setTimeout(function() {
                            form.render('select');
                        }, 0);
                    });

                });

                window.um = UM.getEditor('container', {
                    /* 传入配置参数,可配参数列表看umeditor.config.js */
                });

            });
        </script>
    </body>

</html>