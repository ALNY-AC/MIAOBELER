<?php

namespace UserV0_1\Controller;
use Think\Controller;

/**
 * +----------------------------------------------------------------------
 * 创建日期：2017年10月28日
 * +----------------------------------------------------------------------
 * https：//github.com/ALNY-AC
 * +----------------------------------------------------------------------
 * weixin：AJS0314
 * +----------------------------------------------------------------------
 * 用户反馈控制器
 * @author 代马狮
 *
 */
class OpinionController extends CommonController {

    public function add() {

        if (IS_POST) {

            $user_id = session('user_id');
            $type = I('post.type');
            $content = I('post.content');

            $model = D('Opinion');
          
            $result_info = $model -> addOpinion($user_id, $type, $content);

            if (I('get.debug') === 'true') {
                dump($result_info);
            } else {
                echo json_encode($result_info);
            }

        }

    }

}
