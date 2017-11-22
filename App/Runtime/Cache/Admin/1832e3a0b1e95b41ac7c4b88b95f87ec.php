<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>编辑品牌</title>
    <link rel="stylesheet" href="/Public/vendor/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" href="/Public/vendor/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/vendor/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="/Public/dist/brand/brand.css" />
    <link rel="stylesheet" type="text/css" href="/Public/vendor/toastr/toastr.min.css" />

    <link rel="stylesheet" type="text/css" href="/Public/vendor/editle/editel.css" />

    <style type="text/css">
        body {
            padding: 20px;
            padding-bottom: 100px;
            padding-top: 80px;
        }

        .upLogo-box {
            background-color: #ffffff;
            cursor: pointer;
            width: 120px;
            height: 30px;
        }

        #logoImg {
            max-width: 100%;
        }
    </style>
</head>

<body>
    <input type="hidden" name="" id="idbox" value='<?php echo ($id); ?>'>
    <div class="brand-box" id="brandApp">
        <div class="bg-img" :style="'background-image: url('+info.max_img+');'">
            <div class="upFileBgImg" data-toggle="tooltip" data-placement="right" data-original-title="点击上传">
                <span class="title" id="upMaxImg">点击上传图片</span>
            </div>
        </div>
        <div class="info-panel">
            <div class="container-fluid">
                <div class="row">
                    <div class="info-panel-head">
                        <div class="col-xs-4">
                            <div class="head-img " data-toggle="tooltip" data-placement="bottom" data-original-title="点击上传">
                                <img :src="info.head_img" class="head-img-img" id="upHeadImg" />
                            </div>
                            <div class="upLogo-box" id="upLogo" data-toggle="tooltip" data-placement="bottom" data-original-title="点击上传">
                                <img id="logoImg" :src="info.logo" alt="点我上传logo图片">
                            </div>
                        </div>
                        <div class="col-xs-8">
                            <span class="title editel" id="brandTitle" data-toggle="tooltip" data-placement="top" data-original-title="点击修改">
                                {{info.brand_title}}
                            </span>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="info-panel-info editel" id='brandInfo' data-toggle="tooltip" data-placement="bottom" data-original-title="点击修改">
                            {{info.info}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 text-center" style='padding:20px'>
                        <div class="btn btn-info" @click='save()'>保存</div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <script src="/Public/vendor/jquery/jquery-2.1.0.js" type="text/javascript" charset="utf-8"></script>
    <script src="/Public/vendor/jqueryUI/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/Public/vendor/bootstrap/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>

    <!--  -->

    <script src="/Public/vendor/layer/layer.js"></script>
    <script src="/Public/vendor/layui/layui.js"></script>
    <script src="/Public/vendor/vue/vue.js" type="text/javascript" charset="utf-8"></script>
    <script src="/Public/vendor/editle/editel.js" type="text/javascript" charset="utf-8"></script>
    <script src="/Public/vendor/toastr/toastr.min.js" type="text/javascript" charset="utf-8"></script>

    <script type="text/javascript">
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

        var brandApp = new Vue({
            el: '#brandApp',
            data: {
                info: []
            },
            methods: {

                update: function () {
                    var _this = this;

                    $.get('/index.php/Admin/Brand/getOne', {
                        id: $('#idbox').val()
                    }, function (result) {
                        console.log(result);

                        result = JSON.parse(result);
                        console.log(result);

                        if (result.result == 'success') {
                            _this.info = result.message;
                        }
                    });

                },
                save: function () {

                    if (this.head_img == '') {
                        toastr['warning']('请添加品牌头像');
                        return;

                    }

                    if (this.max_img == '') {
                        toastr['warning']('请添加品牌大图');
                        return;
                    }

                    var data = {
                        id: this.info.id,
                        brand_title: $('#brandTitle').text(),
                        info: $('#brandInfo').text(),
                        head_img: this.info.head_img,
                        max_img: this.info.max_img,
                        logo: this.logo

                    };

                    this.info.brand_title = data.brand_title;
                    this.info.info = data.info;

                    $.post('/index.php/Admin/Brand/save', data, function (result) {
                        result = JSON.parse(result);

                        if (result.result == 'success') {
                            toastr['success'](result.message);

                        } else {
                            toastr['error'](result.message);

                        }

                    });

                }
            }
        });

        brandApp.update();

        layui.use('upload', function () {
            var upload = layui.upload;
            upload.render({
                elem: '#upHeadImg',
                url: '/index.php/Admin/Brand/upFile',
                before: function (obj) {
                    console.log(obj);
                },
                done: function (res, index, upload) {
                    console.log(this);
                    console.log(res);
                    console.log(index);
                    console.log(upload);
                    //获取当前触发上传的元素，一般用于 elem 绑定 class 的情况，注意：此乃 layui 2.1.0 新增
                    //                      var item = this.item;

                    $('.head-img-img').attr('src', res.data.src);

                    brandApp.head_img = res.data.src;

                },
                error: function (index, upload) {
                    //                      console.log(index);
                    //                      console.log(upload);
                    //当上传失败时，你可以生成一个“重新上传”的按钮，点击该按钮时，执行 upload() 方法即可实现重新上传
                },
                accept: 'images',
                field: 'file'
            })
            upload.render({
                elem: '#upMaxImg',
                url: '/index.php/Admin/Brand/upFile',
                done: function (res, index, upload) {
                    //                      console.log(res);
                    //                      console.log(index);
                    //                      console.log(upload);
                    //获取当前触发上传的元素，一般用于 elem 绑定 class 的情况，注意：此乃 layui 2.1.0 新增
                    //                      var item = this.item;

                    $('.bg-img').css('background-image', 'url(' + res.data.src + ')');
                    brandApp.max_img = res.data.src;

                },
                error: function (index, upload) {
                    //                      console.log(index);
                    //                      console.log(upload);
                    //当上传失败时，你可以生成一个“重新上传”的按钮，点击该按钮时，执行 upload() 方法即可实现重新上传
                },
                accept: 'images',
                field: 'file'
            })
            upload.render({
                elem: '#upLogo',
                url: '/index.php/Admin/Brand/upFile',
                done: function (res, index, upload) {
                    //                      console.log(res);
                    //                      console.log(index);
                    //                      console.log(upload);
                    //获取当前触发上传的元素，一般用于 elem 绑定 class 的情况，注意：此乃 layui 2.1.0 新增
                    //                      var item = this.item;
                    $('#logoImg').attr('src', res.data.src);
                    brandApp.logo = res.data.src;

                },
                error: function (index, upload) {
                    //                      console.log(index);
                    //                      console.log(upload);
                    //当上传失败时，你可以生成一个“重新上传”的按钮，点击该按钮时，执行 upload() 方法即可实现重新上传
                },
                accept: 'images',
                field: 'file'
            })

        });

        $(function () {
            $(document).on('mouseenter', '[data-toggle="tooltip"]', function () {
                /*工具提示*/
                $(this).tooltip('show');
            });
        })
    </script>

</body>

</html>