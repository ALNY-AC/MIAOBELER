<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <link rel="stylesheet" type="text/css" href="/Public/vendor/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/Public/vendor/font-awesome/css/font-awesome.css" />

        <title>客服管理</title>
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
                <div class="panel-heading">客服电话</div>
                <div class="panel-body" id="app1">
                    <form action="" method="post">

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="input-group">

                                        <input type="text" value="<?php echo ($phone); ?>" name="phone" class="form-control" placeholder="客服电话">
                                        <span class="input-group-btn">
                                            <button class="btn btn-success " type="submit">
                                                <span class="glyphicon glyphicon-floppy-saved"></span>
                                            </button>
                                        </span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <script src="/Public/vendor/jquery/jquery-2.1.0.js" type="text/javascript" charset="utf-8"></script>
        <script src="/Public/vendor/bootstrap/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript">
        </script>
    </body>

</html>