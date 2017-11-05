<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>添加品牌</title>
        <link rel="stylesheet" href="/Public/vendor/layui/css/layui.css">
        <link rel="stylesheet" type="text/css" href="/Public/vendor/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/Public/vendor/font-awesome/css/font-awesome.css" />
        <link rel="stylesheet" type="text/css" href="/Public/dist/brand/brand.css" />

        <style type="text/css">
            body {
                padding: 20px;
                padding-bottom: 100px;
            }
        </style>
    </head>

    <body>

        <div class="brand-box">
            <div class="bg-img" style="background-image: url(../../../../Public/dist/img/4.png);">
                <div class="upFileBgImg">
                    <span class="title" id="upMaxImg">点击上传图片</span>
                </div>
            </div>
            <div class="info-panel">
                <div class="container-fluid">
                    <div class="row">
                        <div class="info-panel-head">

                            <div class="col-xs-4">
                                <div class="head-img">
                                    <img src="../../../../Public/dist/img/head.jpg" class="head-img-img" id="upHeadImg" />

                                </div>
                            </div>
                            <div class="col-xs-8">
                                <span class="title">
                                    妙贝尔
                                </span>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="info-panel-info">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla id facere iste dolore dolor cupiditate nisi et illum dignissimos obcaecati provident debitis eum minima doloribus nam aliquid amet ipsam unde.
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <script src="/Public/vendor/jquery/jquery-2.1.0.js" type="text/javascript" charset="utf-8"></script>
        <script src="/Public/vendor/jqueryUI/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="/Public/vendor/layer/layer.js"></script>
        <script src="/Public/vendor/layui/layui.js"></script>
        <script src="/Public/vendor/vue/vue.js" type="text/javascript" charset="utf-8"></script>

        <script type="text/javascript">
            layui.use('upload', function() {
                var upload = layui.upload;
                upload.render({
                    elem: '#upHeadImg',
                    url: '/index.php/Admin/Brand/upFile',
                    before: function(obj) {
                        console.log(obj);
                    },
                    done: function(res, index, upload) {
                        console.log(this);
                        console.log(res);
                        console.log(index);
                        console.log(upload);
                        //获取当前触发上传的元素，一般用于 elem 绑定 class 的情况，注意：此乃 layui 2.1.0 新增
                        //                      var item = this.item;

                        $('.head-img-img').attr('src', res.data.src);

                    },
                    error: function(index, upload) {
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
                    done: function(res, index, upload) {
                        //                      console.log(res);
                        //                      console.log(index);
                        //                      console.log(upload);
                        //获取当前触发上传的元素，一般用于 elem 绑定 class 的情况，注意：此乃 layui 2.1.0 新增
                        //                      var item = this.item;

                        $('.bg-img').css('background-image', 'url(' + res.data.src + ')');

                    },
                    error: function(index, upload) {
                        //                      console.log(index);
                        //                      console.log(upload);
                        //当上传失败时，你可以生成一个“重新上传”的按钮，点击该按钮时，执行 upload() 方法即可实现重新上传
                    },
                    accept: 'images',
                    field: 'file'
                })

            });
        </script>

    </body>

</html>