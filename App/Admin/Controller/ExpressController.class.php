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
 * 发货管理
 * @author 代马狮
 *
 */
class ExpressController extends CommonController {

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

        // $result = $model -> field('t1.*,t2.title as goods_title') -> table('mia_order as t1,mia_goods as t2') -> where('t1.goods_id = t2.goods_id AND state = 2') -> select();
        //      $result = $model -> select();

        // $this -> assign('orderList', $result);

        $this -> assign('count', 1);
        $this -> display();

    }

    public function showInfo() {

        if (IS_POST) {

            if (!empty(I('post.odd_id'))) {

                $where['order_id'] = I('post.order_id');

                $save['odd_id'] = I('post.odd_id');
                $save['odd_name'] = I('post.odd_name');
                $save['state'] = 3;

                $model = M('Order');
                $result = $model -> where($where) -> save($save);

                //  ==========
                //  = Banner =
                //  ==========
                $result = $model -> where($where) -> find();
                $this -> assign('isok', 'true');
                $this -> assign('info', $result);

                $order_id = I('get.order_id');
                $this -> display();

            } else {
                echo '没写订单';
            }

        } else {

            $model = M('Order');
            $where['order_id'] = I('get.order_id');
            $result = $model -> where($where) -> find();
            $this -> assign('order', $result);
            $user_id = $result['user_id'];
            $address_id = $result['address_id'];

            //  ==========
            //  = Banner =
            //  ==========

            $model = M('Goods');
            $where['goods_id'] = $result['goods_id'];
            $result = $model -> where($where) -> find();
            $this -> assign('goods', $result);

            //  ==========
            //  = Banner =
            //  ==========

            $model = M('User');
            $where['user_id'] = $user_id;
            $result = $model -> where($where) -> find();
            $this -> assign('user', $result);

            //  ==========
            //  = Banner =
            //  ==========

            $model = M('Address');
            $where['user_id'] = $user_id;
            $where['address_id'] = $address_id;
            $result = $model -> where($where) -> find();
            $this -> assign('address', $result);

            //  ==========
            //  = Banner =
            //  ==========

            $this -> display();

        }

    }

}
