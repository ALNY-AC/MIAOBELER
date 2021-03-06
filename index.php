<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

//  ==========
//  = 头部配置b =
//  ==========



header('Access-Control-Allow-Origin:*');

// 应用入口文件

// 检测PHP环境
if (version_compare(PHP_VERSION, '5.3.0', '<'))
    die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG', True);

// 定义应用目录
define('APP_PATH', './App/');

//定义一个全局的key
define('KEY', 'null12138');

//定义工作路径
define('WORKING_PATH', str_replace('\\', '/', __DIR__));
//定义上传的跟目录
define('UPLOAD_ROOT_PATH', '/Public/Upload/');
// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单