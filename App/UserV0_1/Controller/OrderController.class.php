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
 * 订单控制器
 * @author 代马狮
 *
 */
class OrderController extends CommonController {

    /**
     * 添加订单
     * */
    public function add() {

        if (IS_POST) {
            $isNull = false;

            $user_id = session('user_id');
            //商品数量可以客户端传，因为后台将根据数量发货和生成价格
            $num = I('post.num');
            $goods_id = I('post.goods_id');

            if ($goods_id == false || $num == false) {
                $isNull = true;
            }

            if ($isNull) {
                $result_info['result'] = 'success';
                $result_info['message'] = 'goods_id || num == null';
                if (I('get.debug') === 'true') {
                    dump($result_info);
                } else {
                    echo json_encode($result_info);
                }
                exit ;
            }
            //  ==========
            //  = 正常输出 =
            //  ==========
            $model = D('Order');
            $result = $model -> add($goods_id, $num, $user_id);
            if (I('get.debug') === 'true') {
                dump($result_info);
            } else {
                echo json_encode($result_info);
            }

        }

    }

}
