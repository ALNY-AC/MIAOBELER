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
 * 轮播图控制器
 * @author 代马狮
 *
 */
class CarouselController extends CommonController {

    /**
     * 获得轮播图图片地址
     * */
    public function get() {

        $model = M('Carousel');
        $result = $model -> select();
        if (I('get.debug') === 'true') {
            dump($result);
        } else {
            echo json_encode($result);
        }

    }

}
