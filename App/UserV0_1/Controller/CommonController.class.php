<?php

namespace UserV0_1\Controller;
use Think\Controller;

/**
 * +----------------------------------------------------------------------
 * 创建日期：2017年10月26日
 * +----------------------------------------------------------------------
 * https：//github.com/ALNY-AC
 * +----------------------------------------------------------------------
 * weixin：AJS0314
 * +----------------------------------------------------------------------
 *
 * @author 代马狮
 *
 */
class CommonController extends Controller {

    public function _initialize() {

        $user_id = session('user_id');
        $token = I('post.token');

        $isLogin = false;

        if (empty($token)) {
            //如果没有令牌

            $result_info['result'] = 'error';
            $result_info['message'] = "token null";

            if (I('get.debug') === 'true') {
                dump($result_info);
            } else {
                echo json_encode($result_info);
            }
            exit ;

        }
        if (empty($user_id)) {
            //如果没有用户id
            $result_info['result'] = 'error';
            $result_info['message'] = "login false";
            if (I('get.debug') === 'true') {
                dump($result_info);
            } else {
                echo json_encode($result_info);
            }
            exit ;
        }

        //  ==========
        //  = 基本信息都有，下面查询是否对 =
        //  ==========
        $model = M('token');

        $where['user_id'] = $user_id;
        $where['token'] = $token;
        $result = $model -> where($where) -> find();

        if ($result === null) {
            //如果没查到令牌

            $result_info['result'] = 'error';
            $result_info['message'] = "token false user_id false";
            if (I('get.debug') === 'true') {
                dump($result_info);
            } else {
                echo json_encode($result_info);
            }exit ;

        }

    }

}
