<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>编辑商品</title>

    <!--<link rel="stylesheet" type="text/css" href="/MIAOBELER/Public/vendor/bootstrap/css/bootstrap.min.css" />-->
    <link rel="stylesheet" type="text/css" href="/MIAOBELER/Public/vendor/font-awesome/css/font-awesome.css" />
    <!--<link rel="stylesheet" href="./umeditor/themes/default/css/umeditor.css">-->
    <link rel="stylesheet" type="text/css" href="/MIAOBELER/Public/vendor/umeditor/themes/default/css/umeditor.css" />
    <link rel="stylesheet" href="/MIAOBELER/Public/vendor/layui/css/layui.css">

    <style type="text/css">
        body {
            padding: 20px;
            padding-bottom: 100px;
            padding-top: 80px;
        }

        #container {
            width: 100%;
            height: 1000px;
        }
    </style>
</head>

<body id="body_a">
    <fieldset class="layui-elem-field layui-field-title">
        <legend>编辑商品</legend>
    </fieldset>

    <form action="" id="form_a" class="form-horizontal layui-form" method="post" enctype="multipart/form-data">
        <input type="hidden" name="a_goods_id" id="" value="<?php echo ($goods_id); ?>" />
        <input type="hidden" name="a_goods_info_id" id="" value="<?php echo ($date["info_id"]); ?>" />
        <!--  -->
        <div class="layui-form-item">
            <label class="layui-form-label">商品标题：</label>
            <div class="layui-input-block">
                <input type="text" name="title" value="<?php echo ($date["title"]); ?>" placeholder="商品标题" autocomplete="off" class="layui-input">
            </div>
        </div>

        <!--  -->

        <div class="layui-form-item">
            <label class="layui-form-label">原价：</label>
            <div class="layui-input-inline">
                <input type="number" step="0.01" name="str_price" placeholder="原价" value="<?php echo ($date["str_price"]); ?>" autocomplete="off" class="layui-input">
            </div>
        </div>

        <!--  -->

        <div class="layui-form-item">
            <label class="layui-form-label">现价：</label>
            <div class="layui-input-inline">
                <input type="number" step="0.01" name="price" placeholder="现价" value="<?php echo ($date["price"]); ?>" autocomplete="off" class="layui-input">
            </div>
        </div>

        <!--  -->

        <div class="layui-form-item">
            <label class="layui-form-label">积分：</label>
            <div class="layui-input-inline">
                <input type="number" name="integral" placeholder="积分" value="<?php echo ($date["integral"]); ?>" autocomplete="off" class="layui-input">
            </div>
        </div>

        <!--  -->
        <div class="layui-form-item">
            <label class="layui-form-label">类别：</label>
            <div class="layui-input-inline">
                <select id="quiz1" lay-filter="filter" name="class_1_id">
                    <option value="">请选择一个类别</option>
                    <template v-for="item in items">

                        <option :value="item.class_id" v-if="item.class_id == '<?php echo ($class["super_id"]); ?>'" selected> {{ item.title }}</option>
                        <option :value="item.class_id" v-else> {{ item.title }}</option>

                    </template>
                </select>

            </div>
            <div class="layui-input-inline">
                <select name="class_id" id="quiz2" lay-filter="filter2">
                    <option value="">请选择一个类别</option>
                    <template v-for="item in items">

                        <option :value="item.class_id" v-if="item.class_id == '<?php echo ($class["class_id"]); ?>'" selected> {{ item.title }}</option>
                        <option :value="item.class_id" v-else> {{ item.title }}</option>

                    </template>

                </select>
            </div>
        </div>
        <!--  -->

        <div class="layui-form-item">
            <label class="layui-form-label">品牌：</label>
            <div class="layui-input-inline">
                <select id="brandApp" lay-verify='required' name="brand_id">
                    <template v-for="item in items">

                        <option :value="item.id" v-if="item.id == '<?php echo ($date["brand_id"]); ?>'" selected>{{ item.brand_title }}</option>
                        <option :value="item.id" v-else> {{ item.brand_title }}</option>

                    </template>

                </select>
            </div>
        </div>

        <!--  -->
        <div class="layui-form-item">
            <label class="layui-form-label">商品头像：</label>
            <div class="layui-input-inline">
                <img src="<?php echo ($date["head_img"]); ?>" style="max-width: 100px;" />
                <input type="file" name="head_img" placeholder="商品头像">
            </div>
        </div>
        <!--  -->

        <div class="layui-form-item">
            <label class="layui-form-label">详情顶图：</label>
            <div class="layui-input-inline">
                <img src="<?php echo ($date["head_lg_img"]); ?>" style="max-width: 100px;" />
                <input type="file" name="head_lg_img" placeholder="详情页顶部的大图">
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
                    <script id="container" name="content" type="text/plain" style=""><?php echo (htmlspecialchars_decode($date["content"])); ?></script>
                </div>
            </div>
        </div>

    </form>

    <!-- 加载编辑器的容器 -->

    <script src="/MIAOBELER/Public/vendor/jquery/jquery-2.1.0.js" type="text/javascript" charset="utf-8"></script>
    <script src="/MIAOBELER/Public/vendor/bootstrap/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>

    <!-- 引入 etpl -->
    <script src="/MIAOBELER/Public/vendor/umeditor/third-party/template.min.js" type="text/javascript" charset="utf-8"></script>
    <!-- 配置文件 -->
    <script src="/MIAOBELER/Public/vendor/umeditor/umeditor.config.js" type="text/javascript" charset="utf-8"></script>
    <!-- 编辑器源码文件 -->
    <script src="/MIAOBELER/Public/vendor/umeditor/umeditor.js" type="text/javascript" charset="utf-8"></script>
    <!-- 语言包文件 -->
    <script src="/MIAOBELER/Public/vendor/umeditor/lang/zh-cn/zh-cn.js" type="text/javascript" charset="utf-8"></script>
    <!---->
    <script src="/MIAOBELER/Public/vendor/layui/layui.js"></script>
    <script src="/MIAOBELER/Public/vendor/vue/vue.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        function showRequest() {
            console.log('上传开始');
        }

        function showResponse() {
            console.log('上传完成');

        }
        var form;
        $(function () {

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
            var brandApp = new Vue({
                el: '#brandApp',
                data: {
                    items: []
                }
            });
            layui.use('form', function () {
                form = layui.form;

                //各种基于事件的操作，下面会有进一步介绍
                form.on('select(filter)', function (data) {
                    //                  console.log(data.elem); //得到select原始DOM对象
                    //                  console.log(data.value); //得到被选中的值
                    //                  console.log(data.othis); //得到美化后的DOM对象

                    quiz2.items.splice(0, quiz2.items.length);

                    for (x in typelist) {
                        if (typelist[x].super_id == data.value) {
                            quiz2.items.push(typelist[x]);
                        }
                    }

                    setTimeout(function () {
                        form.render('select');
                    }, 100);

                });
                form.on('select(filter2)', function (data) {
                    console.log(data.elem); //得到select原始DOM对象
                    console.log(data.value); //得到被选中的值
                    console.log(data.othis); //得到美化后的DOM对象

                });

                $.getJSON('<?php echo U("Class/getClassList");?>', function (result) {

                    typelist = result.message;
                    for (var x in typelist) {

                        if (typelist[x].level == '1') {
                            quiz1.items.push(typelist[x]);
                        } else {

                        }

                    }

                    for (var x in typelist) {
                        if (typelist[x].level == '2') {

                            for (var y in typelist) {

                                var super_id = typelist[y].class_id;
                                if (typelist[x].super_id == super_id) {
                                    quiz2.items.push(typelist[x]);
                                }
                            }

                        }

                    }

                    setTimeout(function () {
                        form.render('select');
                    }, 0);
                });

            });

            window.um = UM.getEditor('container', {
                /* 传入配置参数,可配参数列表看umeditor.config.js */
            });

            $.getJSON('<?php echo U("Brand/getList");?>', function (result) {
                brandApp.items = result.message;
                console.log(brandApp.items);
                setTimeout(function () {
                    form.render('select');
                }, 120);
            });
        });
    </script>
</body>

</html>