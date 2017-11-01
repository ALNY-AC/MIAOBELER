<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>登录</title>
        <link rel="stylesheet" type="text/css" href="/Public/vendor/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/Public/vendor/font-awesome/css/font-awesome.css" />
        <style type="text/css">
            body {
                background-color: #24292E;
            }
            
            .login-box {
                position: absolute;
                top: 30%;
                left: 50%;
                transform: translate(-50%, -50%);
                margin: 0 auto;
            }
            
            .panel {
                width: 300px;
                margin: 0 auto;
            }
            
            .title {
                text-align: center;
                color: #fff;
            }
        </style>
    </head>

    <body>

        <div class="container-fluid">

            <div class="login-box">

                <h1 class="title">MIAOBELER</h1>
                <h3 class="title" style="padding-bottom: 20px;">admin</h3>

                <div class="panel panel-default ">
                    <div class="text" style=""></div>

                    <div class="panel-body">
                        <div class="alert alert-danger hidden" id="info" role="alert">密码有误！</div>
                        <div class="form-group">
                            <label for="user_id">账户：</label>
                            <input type="text" class="form-control" id="user_id" placeholder="账户">
                        </div>
                        <div class="form-group">
                            <label for="user_pwd">密码：</label>
                            <input type="password" class="form-control" id="user_pwd" placeholder="密码">
                        </div>
                        <div class="form-group">
                            <label for="user_pwd">验证码：</label>

                            <div class="input-group">
                                <input type="text" class="form-control" id="captcha" placeholder="验证码">
                                <span class="input-group-addon" style="padding: 0;" id="basic-addon2">
                                    <img id="captchaB" style="cursor: pointer;" onclick="this.src='/index.php/Admin/Login/captcha/key/'+Math.random()" src="/index.php/Admin/Login/captcha" />
                                </span>

                            </div>

                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-default btn-block login">登录</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="/Public/vendor/jquery/jquery-2.1.0.js" type="text/javascript" charset="utf-8"></script>
        <script src="/Public/vendor/bootstrap/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript">
            $('.login').on('click', function() {

                var user_id = $('#user_id').val();
                var user_pwd = $('#user_pwd').val();
                var captcha = $('#captcha').val();

                $.post('/index.php/Admin/Login/login', {
                    'user_id': user_id,
                    'user_pwd': user_pwd,
                    'captcha': captcha,
                }, function(result) {

                    console.log(result);
                    result = JSON.parse(result);

                    if(result['result'] === 'error') {
                        $('#info').removeClass('hidden');
                        $('#info').text(result.message);
                        $('#captchaB').attr('src', '/index.php/Admin/Login/captcha/key/' + Math.random());
                    } else {
                        window.location.href = '<?php echo U("Index/index");?>';
                    }

                });

            });
        </script>

    </body>

</html>