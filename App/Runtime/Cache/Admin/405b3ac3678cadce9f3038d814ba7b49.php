<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <title>轮播管理</title>

        <link rel="stylesheet" type="text/css" href="/Public/vendor/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/Public/vendor/font-awesome/css/font-awesome.css" />
        <style type="text/css">
            body {
                padding: 20px;
                padding-bottom: 100px;
            }
        </style>
    </head>

    <body>

        <div class="container-fluid">
            <div class="row" style="padding-bottom: 20px;">

                <div class="col-sm-12">

                    <h1>轮播管理 </h1>
                    <p class="text-muted">预览：</p>
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="4"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <img src="<?php echo ($carousel[0]["img"]); ?>" alt="没有找到图片" onerror="this.src='/Public/dist/img/timg.jpg'" />
                            </div>
                            <div class="item ">
                                <img src="<?php echo ($carousel[1]["img"]); ?>" alt="没有找到图片" onerror="this.src='/Public/dist/img/timg.jpg'" />
                            </div>
                            <div class="item ">
                                <img src="<?php echo ($carousel[2]["img"]); ?>" alt="没有找到图片" onerror="this.src='/Public/dist/img/timg.jpg'" />
                            </div>

                            <div class="item ">
                                <img src="<?php echo ($carousel[3]["img"]); ?>" alt="没有找到图片" onerror="this.src='/Public/dist/img/timg.jpg'" />
                            </div>
                            <div class="item ">
                                <img src="<?php echo ($carousel[4]["img"]); ?>" alt="没有找到图片" onerror="this.src='/Public/dist/img/timg.jpg'" />
                            </div>
                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>

            </div>

            <div class="row" style="padding-top: 0;">
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <img src="<?php echo ($carousel[0]["img"]); ?>" alt="没有找到图片" onerror="this.src='/Public/dist/img/timg.jpg'" />

                        <div class="caption">
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" class="form-control" name="id" value="0" />
                                <h3>栏位一</h3>
                                <p>
                                    <input type="file" name="img" value="" />
                                    <div class="form-group">

                                        <input type="text" class="form-control" autocomplete="off" name="a_url" value="<?php echo ($carousel[0]["a_url"]); ?>" placeholder="请输入商品id" />
                                    </div>
                                </p>
                                <p>
                                    <button type="submit" class="btn btn-primary">保存</button>
                                    <a href="#" class="btn btn-danger" role="button">删除</a>
                                </p>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <img src="<?php echo ($carousel[1]["img"]); ?>" alt="没有找到图片" onerror="this.src='/Public/dist/img/timg.jpg'" />

                        <div class="caption">
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" class="form-control" name="id" value="1" />
                                <h3>栏位二</h3>
                                <p>
                                    <input type="file" name="img" value="" />
                                    <div class="form-group">

                                        <input type="text" class="form-control" autocomplete="off" name="a_url" value="<?php echo ($carousel[1]["a_url"]); ?>" placeholder="请输入商品id" />
                                    </div>
                                </p>
                                <p>
                                    <button type="submit" class="btn btn-primary">保存</button>
                                    <a href="#" class="btn btn-danger" role="button">删除</a>
                                </p>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <img src="<?php echo ($carousel[2]["img"]); ?>" alt="没有找到图片" onerror="this.src='/Public/dist/img/timg.jpg'" />

                        <div class="caption">
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" class="form-control" name="id" value="2s" />
                                <h3>栏位三</h3>
                                <p>
                                    <input type="file" name="img" value="" />
                                    <div class="form-group">

                                        <input type="text" class="form-control" autocomplete="off" name="a_url" value="<?php echo ($carousel[2]["a_url"]); ?>" placeholder="请输入商品id" />
                                    </div>
                                </p>
                                <p>
                                    <button type="submit" class="btn btn-primary">保存</button>
                                    <a href="#" class="btn btn-danger" role="button">删除</a>
                                </p>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <img src="<?php echo ($carousel[3]["img"]); ?>" alt="没有找到图片" onerror="this.src='/Public/dist/img/timg.jpg'" />

                        <div class="caption">
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" class="form-control" name="id" value="3" />
                                <h3>栏位四</h3>
                                <p>
                                    <input type="file" name="img" value="" />
                                    <div class="form-group">

                                        <input type="text" class="form-control" autocomplete="off" name="a_url" value="<?php echo ($carousel[3]["a_url"]); ?>" placeholder="请输入商品id" />
                                    </div>
                                </p>
                                <p>
                                    <button type="submit" class="btn btn-primary">保存</button>
                                    <a href="#" class="btn btn-danger" role="button">删除</a>
                                </p>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <img src="<?php echo ($carousel[4]["img"]); ?>" alt="没有找到图片" onerror="this.src='/Public/dist/img/timg.jpg'" />

                        <div class="caption">
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" class="form-control" name="id" value="4" />
                                <h3>栏位五
                                </h3>
                                <p>
                                    <input type="file" name="img" value="" />
                                    <div class="form-group">

                                        <input type="text" class="form-control" autocomplete="off" name="a_url" value="<?php echo ($carousel[4]["a_url"]); ?>" placeholder="请输入商品id" />
                                    </div>
                                </p>
                                <p>
                                    <button type="submit" class="btn btn-primary">保存</button>
                                    <a href="#" class="btn btn-danger" role="button">删除</a>
                                </p>

                            </form>
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

    </body>

</html>