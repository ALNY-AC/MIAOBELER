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

    public function deBug() {
        dump(session('user_id'));
    }

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
            $result = $model -> addOrder($goods_id, $num, $user_id);
            if (I('get.debug') === 'true') {
                dump($result);
            } else {
                echo json_encode($result);
            }

        }

    }

    /**支付接口*/
    public function payment() {
        if (IS_POST) {

            $where['user_id'] = $user_id = session('user_id');
            $where['order_id'] = I('post.order_id');

            $save['payment_method'] = I('post.payment_method');
            $save['user_money'] = I('post.user_money');
            $save['state'] = 2;
            $save['edit_time'] = time();

            //  ==========
            //  = 最好在此添加验证金额代码 =
            //  ==========

            $model = M('Order');
            $result = $model -> where($where) -> save($save);
            $result_info;
            if ($result) {
                $result_info['result'] = 'success';
                $result_info['message'] = "payment true";
            } else {
                $result_info['result'] = 'error';
                $result_info['message'] = "payment false";
            }

            if (I('get.debug') === 'true') {
                dump($result);
                dump($result_info);
            } else {
                echo json_encode($result_info);
            }

        }
    }

    /**删除订单*/
    public function remove() {

        if (IS_POST) {

            $where['user_id'] = $user_id = session('user_id');
            $where['order_id'] = I('post.order_id');

            $model = M('Order');
            $result = $model -> where($where) -> find($save);

            if ($result['state'] == 1) {
                $result = $model -> where($where) -> delete();

                if ($result) {
                    $result_info['result'] = 'success';
                    $result_info['message'] = "remove true";
                } else {
                    $result_info['result'] = 'error';
                    $result_info['message'] = "remove false";
                }

            } else {
                $result_info['result'] = 'error';
                $result_info['message'] = "已经支付，只能申请售后";
            }

            if (I('get.debug') === 'true') {
                dump($result);
                dump($result_info);
            } else {
                echo json_encode($result_info);
            }
        }

    }

    //获取单个订单
    public function getOne() {

        if (IS_GET) {
            $user_id = session('user_id');
            $order_id = I('post.order_id');
            $where['user_id'] = $user_id;
            $where['order_id'] = $order_id;
            $model = M('Order');
            $result = $model -> where($where) -> find();
            $result_info;
            if ($result) {

                $result_info['result'] = 'success';
                $result_info['message'] = $result;

            } else {

                $result_info['result'] = 'success';
                $result_info['message'] = "order_id null $order_id";

            }

            if (I('get.debug') === 'true') {
                dump($result_info);
            } else {
                echo json_encode($result_info);
            }

        }

    }

    public function showList() {

        if (IS_GET) {
            $user_id = session('user_id');
            $where['user_id'] = $user_id;
            $model = M('Order');
            $result = $model -> where($where) -> select();
            $result_info;
            if ($result) {

                $result_info['result'] = 'success';
                $result_info['message'] = $result;

            } else {

                $result_info['result'] = 'success';
                $result_info['message'] = "order_id null $order_id";

            }

            if (I('get.debug') === 'true') {
                dump($result_info);
            } else {
                echo json_encode($result_info);
            }

        }

    }

    //申请售后
    public function customerService() {

        if (IS_POST) {
            $user_id = session('user_id');
            $order_id = I('post.order_id');

            $where['user_id'] = $user_id;
            $where['order_id'] = $order_id;

            $save['state'] = 5;
            $save['content'] = I('post.content');

            $model = M('Order');
            $result = $model -> where($where) -> save($save);

            $result_info;

            if ($result) {

                $result_info['result'] = 'success';
                $result_info['message'] = 'customerService true';

            } else {

                $result_info['result'] = 'success';
                $result_info['message'] = "customerService false";

            }

            if (I('get.debug') === 'true') {
                dump($result_info);
            } else {
                echo json_encode($result_info);
            }

        }

    }

}
