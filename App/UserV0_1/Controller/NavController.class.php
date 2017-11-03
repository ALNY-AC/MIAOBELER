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
 * 导航栏控制器
 * @author 代马狮
 *
 */
class NavController extends CommonController {

    public function get() {

        $model = M('nav');
        $result = $model -> select();

        if ($result !== false) {
            $result_info['result'] = 'success';
            $result_info['message'] = $result;
        } else {
            $result_info['result'] = 'error';
        }

        if (I('get.debug') === 'true') {
            dump($result_info);
        } else {
            echo json_encode($result_info);
        }

    }

}
