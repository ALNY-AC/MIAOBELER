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
 * 标签控制器
 * @author 代马狮
 *
 */
class TagController extends CommonController {

    public function getList() {
        $model = M('Tag');
        $result = $model -> field('title') -> select();

        $result_info['result'] = 'success';
        $result_info['message'] = $result;
        echo json_encode($result_info);
    }

}
