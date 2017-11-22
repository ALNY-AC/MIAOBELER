<?php

namespace UserV0_1\Controller;
use Think\Controller;

/**
 * +----------------------------------------------------------------------
 * 创建日期：2017年10月30日
 * +----------------------------------------------------------------------
 * https：//github.com/ALNY-AC
 * +----------------------------------------------------------------------
 * weixin：AJS0314
 * +----------------------------------------------------------------------
 *测试控制器
 * @author 代马狮
 *
 */
class TestController extends Controller {

    public function test() {

        $result_info['result'] = '这是个测试回调';
        $result_info['message'] = '这是回调的信息';
        $result_info['a1'] = md5('15071063');
        $result_info['a2'] = md5(15071063);

        if (I('get.debug') === 'true') {
            dump($result_info);
        } else {
            echo json_encode($result_info);
        }

    }

}
