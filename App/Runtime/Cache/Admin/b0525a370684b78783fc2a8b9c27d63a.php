<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>导航管理</title>

        <link rel="stylesheet" type="text/css" href="/Public/vendor/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/Public/vendor/font-awesome/css/font-awesome.css" />
        <style type="text/css">
            body {
                padding： 20px;
            }
        </style>
    </head>

    <body>

        <div class="container">
            <h1>导航管理</h1>

            <div class="row">
                <div class="col-sm-3">

                    <div class="panel panel-default">
                        <div class="panel-body" id="1">
                            <p class="text-muted">NO.1</p>

                            <div class="form-group">
                                <label for="">导航名:</label>
                                <input type="text" class="form-control title">
                            </div>
                            <div class="form-group">
                                <label for="">商品关键字:</label>
                                <input type="text" class="form-control goods_name">
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-success btn-block save">保存</button>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-sm-3">

                    <div class="panel panel-default">
                        <div class="panel-body" id="2">
                            <p class="text-muted">NO.2</p>

                            <div class="form-group">
                                <label for="">导航名:</label>
                                <input type="text" class="form-control title">
                            </div>
                            <div class="form-group">
                                <label for="">商品关键字:</label>
                                <input type="text" class="form-control goods_name">
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-success btn-block save">保存</button>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-sm-3">

                    <div class="panel panel-default">
                        <div class="panel-body" id="3">
                            <p class="text-muted">NO.3</p>

                            <div class="form-group">
                                <label for="">导航名:</label>
                                <input type="text" class="form-control title">
                            </div>
                            <div class="form-group">
                                <label for="">商品关键字:</label>
                                <input type="text" class="form-control goods_name">
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-success btn-block save">保存</button>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-sm-3">

                    <div class="panel panel-default">
                        <div class="panel-body" id="4">
                            <p class="text-muted">NO.4</p>

                            <div class="form-group">
                                <label for="">导航名:</label>
                                <input type="text" class="form-control title">
                            </div>
                            <div class="form-group">
                                <label for="">商品关键字:</label>
                                <input type="text" class="form-control goods_name">
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-success btn-block save">保存</button>
                            </div>

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

        <script type="text/javascript">
            var nav = {

                init: function() {

                    $.getJSON('/index.php/Admin/Nav/get', function(result) {

                        for(x in result) {
                            $('#' + result[x].id).find('.title').val(result[x].title);
                            $('#' + result[x].id).find('.goods_name').val(result[x].goods_name);

                        }

                    })

                    $(document).on('click', '.save', function() {

                        nav.save($(this));

                    })

                },
                save: function($em) {

                    var $body = $em.parents('.panel-body');
                    var add = {
                        id: $body.attr('id'),
                        title: $body.find('.title').val(),
                        goods_name: $body.find('.goods_name').val(),
                    };
                    $.post('/index.php/Admin/Nav/add', add, function(result) {

                    })

                }

            }
            nav.init();
        </script>
    </body>

</html>