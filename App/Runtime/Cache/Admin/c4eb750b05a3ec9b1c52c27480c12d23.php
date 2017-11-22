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
    <link rel="stylesheet" type="text/css" href="/Public/vendor/toastr/toastr.min.css" />


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
        <legend>添加商品</legend>
    </fieldset>
    <form action="" id="form_a" class="form-horizontal layui-form" method="post" enctype="multipart/form-data">

        <!--  -->
        <div class="layui-form-item">
            <label class="layui-form-label">商品标题：</label>
            <div class="layui-input-block">
                <input type="text" name="title" placeholder="商品标题" autocomplete="off" lay-verify='required' class="layui-input">
            </div>
        </div>

        <!--  -->

        <div class="layui-form-item">
            <label class="layui-form-label">原价：</label>
            <div class="layui-input-inline">
                <input type="number" step="0.01" name="str_price" placeholder="原价" lay-verify='required' autocomplete="off" class="layui-input">
            </div>
        </div>

        <!--  -->

        <div class="layui-form-item">
            <label class="layui-form-label">现价：</label>
            <div class="layui-input-inline">
                <input type="number" step="0.01" name="price" placeholder="现价" lay-verify='required' autocomplete="off" class="layui-input">
            </div>
        </div>

        <!--  -->

        <div class="layui-form-item">
            <label class="layui-form-label">积分：</label>
            <div class="layui-input-inline">
                <input type="number" name="integral" placeholder="积分" lay-verify='required' autocomplete="off" class="layui-input">
            </div>
        </div>

        <!--  -->

        <div class="layui-form-item">
            <label class="layui-form-label">类别：</label>
            <div class="layui-input-inline">
                <select id="quiz1" lay-filter="filter" lay-verify='required' nmae="class_1_id">
                    <option></option>
                    <option v-for="item in items" :value="item.class_id"> {{ item.title }}</option>
                </select>
            </div>
            <div class="layui-input-inline">
                <select name="class_id" id="quiz2" lay-filter="filter2" lay-verify='required'>
                    <option></option>
                    <option v-for="item in items" :value="item.class_id"> {{ item.title }}</option>
                </select>
            </div>
        </div>
        <!--  -->

        <div class="layui-form-item">
            <label class="layui-form-label">品牌：</label>
            <div class="layui-input-inline">
                <select id="brandApp" lay-verify='required' name="brand_id">
                    <option></option>
                    <option v-for="item in items" :value="item.id"> {{ item.brand_title }}</option>
                </select>
            </div>
        </div>
        <!--  -->

        <div class="layui-form-item">
            <label class="layui-form-label">商品头像：</label>
            <div class="layui-input-inline">
                <input type="file" name="head_img" placeholder="商品头像" lay-verify='required'>
            </div>
        </div>
        <!--  -->

        <div class="layui-form-item">
            <label class="layui-form-label">详情大图：</label>
            <div class="layui-input-inline">
                <input type="file" name="head_lg_img" placeholder="详情页的大图" lay-verify='required'>
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
                    <script id="container" name="content" type="text/plain" style="" lay-verify='required'></script>
                </div>
            </div>
        </div>

    </form>

    <!-- 加载编辑器的容器 -->

    <script src="/Public/vendor/jquery/jquery-2.1.0.js" type="text/javascript" charset="utf-8"></script>
    <script src="/Public/vendor/bootstrap/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/Public/vendor/toastr/toastr.min.js" type="text/javascript" charset="utf-8"></script>

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

            var form;
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
                            console.log(typelist[x]);
                            quiz2.items.push(typelist[x]);
                        }
                    }

                    setTimeout(function () {
                        form.render('select');
                    }, 0);

                });
                form.on('select(filter2)', function (data) {
                    console.log(data.elem); //得到select原始DOM对象
                    console.log(data.value); //得到被选中的值
                    console.log(data.othis); //得到美化后的DOM对象

                });
                form.on('submit(*)', function (data) {
                    console.log(data.elem) //被执行事件的元素DOM对象，一般为button对象
                    console.log(data.form) //被执行提交的form对象，一般在存在form标签时才会返回
                    console.log(data.field) //当前容器的全部表单字段，名值对形式：{name: value}

                    if (data.field.class_id == '') {
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "progressBar": false,
                            "positionClass": "toast-bottom-left",
                            "onclick": null,
                            "showDuration": "1",
                            "hideDuration": "1",
                            "timeOut": "1000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        toastr['warning']('请选择类别！');

                        return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
                    }

                });

                $.getJSON('<?php echo U("Class/getClassList");?>', function (result) {
                    typelist = result.message;
                    for (x in typelist) {
                        if (typelist[x].level == '1') {
                            quiz1.items.push(typelist[x]);
                        }
                    }
                    setTimeout(function () {
                        form.render('select');
                    }, 0);
                });

                $.getJSON('<?php echo U("Brand/getList");?>', function (result) {
                    console.log(result);
                    brandApp.items = result.message;
                    setTimeout(function () {
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