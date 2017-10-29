<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>分类管理</title>

        <link rel="stylesheet" type="text/css" href="/Public/vendor/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/Public/vendor/font-awesome/css/font-awesome.css" />
        <style type="text/css">
            body {
                padding: 20px;
                padding-bottom: 100px;
            }
            
            .placeholder {
                background-color: #777;
                border: dashed 2px #aaa;
                line-height: 30px;
                margin: 10px 0;
                color: #fff;
                padding: 15px;
            }
            
            .placeholder:before {
                content: "放置分类";
            }
            
            .placeholder2 {
                float: left;
                background-color: #777;
                border: dashed 2px #aaa;
                width: 181.38px;
                line-height: 34px;
                color: #fff;
                margin: 0 10px;
                text-align: center;
            }
            
            .placeholder2:before {
                content: "放置分类";
            }
            
            .move {
                cursor: pointer;
            }
        </style>
    </head>

    <body>

        <div class="container">
            <h1>分类管理</h1>

            <div class="row">

                <div class="col-md-3" id="app1">
                    <div class="panel panel-default">

                        <div class="panel-heading">一级分类</div>
                        <div class="panel-body" id="move1">
                            <div class="" v-for="(item,index) in items">

                                <div class="form-group" :data-id="item.class_id">
                                    <div class="input-group">
                                        <span class="input-group-addon move">
                                            <span class="glyphicon glyphicon-move"></span>
                                        </span>
                                        <input type="text" class="form-control" v-on:blur='edit(index)' v-on:focus='show(index)' v-on:keyup.enter="edit(index)" :date-id='item.class_id' v-model="item.title" placeholder="分类名">
                                        <span class="input-group-btn">
                                            <!--<button class="btn btn-warning open" v-on:click="show(index)" type="button">
                                                <span class="glyphicon glyphicon-eye-open"></span>
                                            </button>-->
                                            <button class="btn btn-danger remove" v-on:click="deleteInfo(index)" type="button">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </button>
                                        </span>
                                    </div>
                                </div>

                            </div>
                            <button class="btn btn-default btn-block" id="add1" type="button">添加</button>

                        </div>

                    </div>
                </div>

                <div class="col-md-9" id="app2">
                    <div class="panel panel-default">
                        <div class="panel-heading">二级分类</div>
                        <div class="panel-body">
                            <div class="row" style="padding-bottom: 15px;">
                                <div class="col-sm-12">
                                    <span class="label label-danger">{{ super_title }}类</span>
                                </div>
                            </div>

                            <div class="row" id="move2">
                                <div class="col-sm-3" v-for="(item,index) in items">
                                    <div class="form-group" :data-id="item.class_id">
                                        <div class="input-group">
                                            <span class="input-group-addon move">
                                                <span class="glyphicon glyphicon-move"></span>
                                            </span>
                                            <input type="text" class="form-control" v-on:blur='edit(index)' v-on:keyup.enter="edit(index)" :date-id='item.class_id' v-model="item.title" placeholder="二级分类名">
                                            <span class="input-group-btn">
                                                <button class="btn btn-danger remove" v-on:click="deleteInfo(index)" type="button">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3 btn-box">
                                    <button class="btn btn-default" id="add2" type="button">添加</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div id="test"></div>
            </div>

        </div>

        <script src="/Public/vendor/jquery/jquery-2.1.0.js" type="text/javascript" charset="utf-8"></script>
        <script src="/Public/vendor/bootstrap/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="/Public/vendor/jqueryUI/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="/Public/vendor/layer/layer.js"></script>
        <script src="/Public/vendor/vue/vue.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript">
            getClassList();
            var classListArr = [];
            var app2 = new Vue({
                el: '#app2',
                data: {
                    super_title: '',
                    items: []
                },
                methods: {
                    deleteInfo: function(index) {

                        var _this = this;

                        $.get('/index.php/Admin/Class/remove', {
                            'class_id': _this.items[index].class_id,
                        }, function(result) {

                            _this.items.splice(index, 1);

                        });

                    },
                    edit: function(index) {
                        var _this = this;
                        var item = _this.items[index];

                        $.post('/index.php/Admin/Class/edit', {
                            'class_id': item.class_id,
                            'title': item.title,
                        }, function(result) {

                        });

                    }
                }
            });
            var app1 = new Vue({
                el: '#app1',
                data: {
                    show_id: null,
                    items: []
                },
                methods: {
                    deleteInfo: function(index) {

                        var _this = this;

                        $.get('/index.php/Admin/Class/remove', {
                            'class_id': _this.items[index].class_id,
                            'level': '1',
                        }, function(result) {

                            _this.items.splice(index, 1);

                        });

                    },
                    show: function(index) {
                        var _this = this;
                        var itme = _this.items[index];
                        _this.show_id = itme['class_id'];

                        app2.super_title = itme.title;
                        app2.items.splice(0, app2.items.length);

                        for(var x in classListArr) {
                            classListArr[x];
                            if(classListArr[x].super_id == itme.class_id) {

                                app2.items.push(classListArr[x]);

                            }

                        }

                    },
                    edit: function(index) {
                        var _this = this;
                        var item = _this.items[index];

                        $.post('/index.php/Admin/Class/edit', {
                            'class_id': item.class_id,
                            'title': item.title,
                        }, function(result) {

                        });

                    }

                }
            });

            $(document).on('click', '#add1', function() {

                //[0] => array(5) {
                //  ["class_id"] => string(3) "abc"
                //  ["super_id"] => string(0) ""
                //  ["sort"] => string(1) "0"
                //  ["level"] => string(1) "1"
                //  ["title"] => string(11) "分组1asdf"
                //}
                add1();
            });

            function add1() {

                var item = {
                    class_id: getRandom(9),
                    super_id: '',
                    sort: 0,
                    level: 1,
                    title: '',

                };

                item.sort = app1.items.length;

                $.post('/index.php/Admin/Class/add', {
                    'addDate': item
                }, function(result) {

                    classListArr.push(item);
                    app1.items.push(classListArr[classListArr.length - 1]);

                });

            }

            $(document).on('click', '#add2', function() {

                //[0] => array(5) {
                //  ["class_id"] => string(3) "abc"
                //  ["super_id"] => string(0) ""
                //  ["sort"] => string(1) "0"
                //  ["level"] => string(1) "1"
                //  ["title"] => string(11) "分组1asdf"
                //}
                add2();
            });

            function add2() {
                var item = {
                    class_id: getRandom(9),
                    super_id: app1.show_id,
                    sort: 0,
                    level: 2,
                    title: '',
                };

                item.sort = app2.items.length;

                $.post('/index.php/Admin/Class/add', {
                    'addDate': item
                }, function(result) {

                    classListArr.push(item);
                    app2.items.push(classListArr[classListArr.length - 1]);

                });

            }

            function getClassList() {

                $.get('<?php echo U("getClassList");?>', function(result) {

                    result = JSON.parse(result);
                    classListArr = result;
                    //                  console.log(result);
                    buList();

                });

            }

            function buList() {

                app1.items.splice(0, app1.items.length);
                app2.items.splice(0, app2.items.length);

                for(var x in classListArr) {

                    if(classListArr[x].level == '1') {
                        app1.items.push(classListArr[x]);
                    }

                }
                if(classListArr.length > 0) {
                    app1.show(0);
                }

            }

            function getRandom(length) {

                var str = '';

                for(var i = 1; i <= length; i++) {
                    str += String.fromCharCode(97 + parseInt(Math.random() * 25));
                }
                var time = '' + new Date().getTime();

                time = time.substr(time.length - 5, time.length);

                return str + time;

            }

            var sort = function() {

                var sort1 = {};

                $('#move1').find('.form-group').each(function(i, em) {
                    var class_id = $(em).attr('data-id');
                    sort1[class_id] = {};
                    sort1[class_id].class_id = class_id;
                    sort1[class_id].sort = i;

                });

                for(var x in app1.items) {
                    var class_id = app1.items[x].class_id;
                    app1.items[x].sort = sort1[class_id].sort;
                }

                $.post('/index.php/Admin/Class/sortList', {
                    'list': app1.items,
                }, function(result) {

                });

            }
            var sort2 = function() {

                var sort2 = {};

                $('#move2').find('.form-group').each(function(i, em) {

                    var class_id = $(em).attr('data-id');
                    sort2[class_id] = {};
                    sort2[class_id].class_id = class_id;
                    sort2[class_id].sort = i;

                });

                for(var x in app2.items) {
                    var class_id = app2.items[x].class_id;
                    app2.items[x].sort = sort2[class_id].sort;
                }

                $.post('/index.php/Admin/Class/sortList', {
                    'list': app2.items,
                }, function(result) {

                });

            }

            //==========================================
            //jqui
            $("#move1").sortable({
                placeholder: "placeholder", //占位符
                items: ".form-group", //谁能动
                handle: ".move", //拖拽句柄
                revert: 100,
                opacity: 0.8,
                axis: "y",

                start: function(event, ui) {
                    //开始

                },
                stop: function(event, ui) {

                    sort();

                },

            });
            $("#move1").disableSelection();
            //==========================================
            //jqui
            $("#move2").sortable({
                placeholder: "placeholder2", //占位符
                items: ".col-sm-3:not(.btn-box)", //谁能动
                handle: ".move", //拖拽句柄
                revert: 100,
                opacity: 0.8,

                start: function(event, ui) {
                    //开始

                },
                stop: function(event, ui) {

                    sort2();

                },

            });
            $("#move2").disableSelection();
        </script>

    </body>

</html>