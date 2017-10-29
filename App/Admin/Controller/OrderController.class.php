<?php

namespace Admin\Controller;
use Think\Controller;

/**
 * +----------------------------------------------------------------------
 * 创建日期：2017年10月29日
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
     * 显示所有订单
     * */

    public function showList() {
        //order_id
        //goods_id
        //user_id
        //odd_id
        //num
        //money
        //add_time
        //edit_time
        //payment_method
        //state

        //          SELECT t1.*,t2.title FROM mia_goods as t1,mia_class as t2 WHERE (t1.class_id = t2.class_id)

        $model = M('Order');

        $result = $model -> field('t1.*,t2.title as goods_title') -> table('mia_order as t1,mia_goods as t2') -> where('t1.goods_id = t2.goods_id') -> select();
        //      $result = $model -> select();

        $this -> assign('orderList', $result);
        $this -> assign('count', 1);
        $this -> display();

    }

}
