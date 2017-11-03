<?php

namespace UserV0_1\Controller;

use Think\Controller;

/**
 * +----------------------------------------------------------------------
 * 创建日期：2017年10月25日
 * +----------------------------------------------------------------------
 * https：//github.com/ALNY-AC
 * +----------------------------------------------------------------------
 * weixin：AJS0314
 * +----------------------------------------------------------------------
 *用户控制器
 * @author 代马狮
 *
 */
class UserController extends CommonController {
    public function getInfo() {

        $where['user_id'] = I('post.user_id');
        $model = M('User');
        $result = $model -> where($where) -> find();

        $result_info['result'] = 'success';
        $result_info['message'] = $result;

        echo json_encode($result_info);

    }

}
