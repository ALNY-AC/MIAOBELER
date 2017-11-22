<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>品牌管理</title>

    <link rel="stylesheet" type="text/css" href="/Public/vendor/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/vendor/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="/Public/vendor/editle/editel.css" />
    <link rel="stylesheet" type="text/css" href="/Public/vendor/toastr/toastr.min.css" />

    <style type="text/css">
        body {
            padding: 20px;
            padding-bottom: 100px;
            padding-top: 80px;
        }
    </style>
</head>

<body>
    <h1>品牌管理</h1>

    <div class="container-fluid" id="brandApp">
        <div class="row">
            <div class="col-xs-4" v-for='(item,index) in list'>
                <div class="thumbnail">
                    <img :src="item.max_img" style="max-height:100px" alt="未上传图片">
                    <div class="caption">
                        <h3>{{item.brand_title}}</h3>
                        <p>{{item.info}}</p>

                        <p>
                            <a href="#" class="btn btn-info" @click='edit(index)' role="button">编辑</a>
                            <a href="#" class="btn btn-danger" @click='del(index)' role="button">删除</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/Public/vendor/jquery/jquery-2.1.0.js" type="text/javascript" charset="utf-8"></script>
    <script src="/Public/vendor/bootstrap/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/Public/vendor/jqueryUI/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/Public/vendor/layer/layer.js"></script>
    <script src="/Public/vendor/vue/vue.js" type="text/javascript" charset="utf-8"></script>
    <script src="/Public/vendor/toastr/toastr.min.js" type="text/javascript" charset="utf-8"></script>

    <script>


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
                list: []
            },
            methods: {
                update: function () {
                    var _this = this;
                    $.get('/index.php/Admin/Brand/getList', {}, function (result) {
                        result = JSON.parse(result);
                        console.log(result);

                        if (result.result == 'success') {
                            _this.list = result.message;
                        } else {
                            _this.list = [];
                        }

                    });

                },
                del: function (index) {

                    var _this = this;
                    $.post('/index.php/Admin/Brand/del', {
                        id: _this.list[index].id
                    }, function (result) {
                        result = JSON.parse(result);
                        if (result.result == 'success') {
                            toastr['success'](result.message);
                            _this.update();
                        }
                    });

                },
                edit: function (index) {
                    window.location.href = '/index.php/Admin/Brand/edit/id/' + this.list[index].id;
                },


            }

        })
        brandApp.update();
    </script>

</body>

</html>