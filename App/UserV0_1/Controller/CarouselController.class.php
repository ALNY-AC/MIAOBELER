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

        $img['img1'] = F("Carousel/img1");
        $img['img2'] = F("Carousel/img2");
        $img['img3'] = F("Carousel/img3");
        $img['img4'] = F("Carousel/img4");

        $return_info['message'] = $img;
        echo json_encode($return_info);
    }

}
