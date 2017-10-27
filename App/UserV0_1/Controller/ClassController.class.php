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
class ClassController extends CommonController {

    /**
     * 获取分类列表
     * */

    public function getClassList() {

        if (IS_GET) {

            $model = M('class');
            $result = $model -> order('sort asc') -> select();

            if (I('get.debug') === 'true') {
                dump($result);
            } else {
                echo json_encode($result);
            }

        }

    }

}
