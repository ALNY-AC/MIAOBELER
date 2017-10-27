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
class GoodsInfoController extends CommonController {
    public function debug() {
        $model = D('Goods');
        dump($model -> get());
    }

    /*详情页*/
    public function getGoodsInfo() {

        $goods_id = I('post.goods_id');
        $model = D('GoodsInfo');
        $result = $model -> getGoodsInfo($goods_id);

        if (I('get.debug') === 'true') {
            dump($result);
        } else {
            echo json_encode($result_info);
        }

    }

}
