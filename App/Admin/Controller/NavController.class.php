<?php

namespace Admin\Controller;
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

    public function showList() {
        $this -> display();
    }

    public function add() {

        $date = I('post.');

        $model = M('nav');
        $result = $model -> add($date, null, true);

        $result_info['result'] = 'success';
        $result_info['message'] = $result;
        echo json_encode($result_info);

    }

    public function get() {

        $model = M('nav');
        $result = $model -> select();
        $result_info['result'] = 'success';
        $result_info['message'] = $result;
        echo json_encode($result_info);

    }

}
