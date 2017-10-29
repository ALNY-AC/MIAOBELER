<?php

namespace Admin\Controller;
use Think\Controller;

/**
 * +----------------------------------------------------------------------
 * 创建日期：2017年10月28日
 * +----------------------------------------------------------------------
 * https：//github.com/ALNY-AC
 * +----------------------------------------------------------------------
 * weixin：AJS0314
 * +----------------------------------------------------------------------
 * 售后控制器
 * @author 代马狮
 *
 */
class CSController extends CommonController {

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

        $result = $model -> field('t1.*,t2.title as goods_title') -> table('mia_order as t1,mia_goods as t2') -> where('t1.goods_id = t2.goods_id AND state = 5') -> select();
        //      $result = $model -> select();

        $this -> assign('orderList', $result);

        $this -> assign('count', 1);
        $this -> display();

    }

    /**
     * 显示用户的售后信息
     * */

    public function showInfo() {

        $where['order_id'] = I('get.order_id');

        $model = M('Order');
        $result = $model -> where($where) -> find();

        $this -> assign('info', $result);
        //
        //      0：未处理
        //1：仅退货
        //2：仅退款
        //3：退货退款
        //4：退换货

        $this -> assign('state1', U('upCSState', array(
            'order_id' => $result['order_id'],
            'customer_service_info' => 1
        )));

        $this -> assign('state2', U('upCSState', array(
            'order_id' => $result['order_id'],
            'customer_service_info' => 2
        )));

        $this -> assign('state3', U('upCSState', array(
            'order_id' => $result['order_id'],
            'customer_service_info' => 3
        )));

        $this -> assign('state4', U('upCSState', array(
            'order_id' => $result['order_id'],
            'customer_service_info' => 4
        )));

        $this -> display();

    }

    /**
     *
     * 修改订单状态
     *
     * */
    public function upCSState() {
        $save['customer_service_info'] = I('get.customer_service_info');
        $where['order_id'] = I('get.order_id');

        $model = M('Order');
        $result = $model -> where($where) -> save($save);

        if ($result) {
            $result_info['result'] = 'success';
            $result_info['message'] = 'upState true';
        } else {
            $result_info['result'] = 'error';
            $result_info['message'] = 'upState false';
        }

        echo json_encode($result_info);

    }

    /**
     * 客服管理
     * */
    public function peopleList() {

        if (IS_POST) {
            $phone = I('post.phone');
            F('phone/list', $phone);

            $this -> assign('phone', F('phone/list'));
            $this -> display();
        } else {
            $this -> assign('phone', F('phone/list'));
            $this -> display();
        }

    }

}
