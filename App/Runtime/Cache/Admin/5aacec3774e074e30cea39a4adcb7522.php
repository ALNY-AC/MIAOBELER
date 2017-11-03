<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <link rel="stylesheet" type="text/css" href="/Public/vendor/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/Public/vendor/font-awesome/css/font-awesome.css" />

        <title>标签管理</title>
        <style type="text/css">
            body {
                padding: 20px;
            }
            
            table.table tr td {
                vertical-align: middle
            }
        </style>
    </head>

    <body>

        <div class="container">

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">标签管理</div>
                <div class="panel-body" id="app1">

                    <div class="row">
                        <div id="test"></div>
                        <div class="col-sm-2" v-for="(item,index) in items">
                            <div class="form-group">
                                <input type="text" v-model="item.title" v-on:blur="save(index)" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-2 btn-box">
                            <button class="btn btn-default" v-on:click="add()" type="button">
                                <span class="glyphicon glyphicon-plus"></span>
                                <span>添加</span>
                            </button>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <script src="/Public/vendor/jquery/jquery-2.1.0.js" type="text/javascript" charset="utf-8"></script>
        <script src="/Public/vendor/bootstrap/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="/Public/vendor/jqueryUI/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="/Public/vendor/vue/vue.js" type="text/javascript" charset="utf-8"></script>
        <script src="/Public/dist/data/dataTool.js" type="text/javascript" charset="utf-8"></script>

        <script type="text/javascript">
            var app1 = new Vue({
                el: '#app1',
                data: {
                    items: []
                },
                methods: {
                    save: function(index) {

                        var id = this.items[index].id;
                        var title = this.items[index].title;

                        console.log(this.items[index]);

                        $.post('/index.php/Admin/Tag/update', {
                            id: id,
                            title: title
                        }, function(result) {
                            //                          $('#test').html(result);
                            //                          console.log(result);
                        });

                    },
                    add: function() {
                        this.items.push({
                            id: this.items.length,
                            title: ''
                        });

                    }
                }
            })

            $.get('/index.php/Admin/Tag/getList', function(result) {

                result = JSON.parse(result);
                app1.items = result;

            });
        </script>
    </body>

</html>