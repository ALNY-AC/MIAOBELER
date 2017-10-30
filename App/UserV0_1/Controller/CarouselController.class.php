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

        $a['a_url_1'] = F("Carousel/a_url_1");
        $a['a_url_2'] = F("Carousel/a_url_2");
        $a['a_url_3'] = F("Carousel/a_url_3");
        $a['a_url_4'] = F("Carousel/a_url_4");

        $arr['a_url'] = $a;
        $arr['img'] = $img;

        $return_info['message'] = $arr;

        if (I('get.debug') === 'true') {
            dump($return_info);
        } else {
            echo json_encode($return_info);
        }

    }

}
