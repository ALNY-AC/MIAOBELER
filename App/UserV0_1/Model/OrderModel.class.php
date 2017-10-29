<?php
namespace UserV0_1\Model;
use Think\Model;

/**
 * +----------------------------------------------------------------------
 * 创建日期：2017年10月27日
 * +----------------------------------------------------------------------
 * https：//github.com/ALNY-AC
 * +----------------------------------------------------------------------
 * weixin：AJS0314
 * +----------------------------------------------------------------------
 * 订单模型
 * @author 代马狮
 *
 */

class OrderModel extends Model {

    /**添加订单*/
    public function addOrder($goods_id, $num, $user_id) {

        $model = M('Goods');
        $where['goods_id'] = $goods_id;
        $result = $model -> where($where) -> find();

        if ($result) {
            //添加时间
            $date['add_time'] = time();
            //修改时间
            $date['edit_time'] = $date['add_time'];
            //商品id
            $date['goods_id'] = $goods_id;
            //用户id
            $date['user_id'] = $user_id;
            //总数
            $date['num'] = $num + 0;
            //支付方式
            $date['payment_method'] = 0;
            //默认的订单状况
            $date['state'] = 1;
            //订单号
            $date['order_id'] = date('YmdHis') . rand(1000, 5000);
            //价格
            $date['money'] = $result['price'] * $num;
            $date['user_money'] = 0;

            $result = $this -> add($date);

            if ($result) {
                //添加了
                $result_info['result'] = 'success';
                $result_info['message'] = $date['order_id'];
            } else {
                //失败了
                $result_info['result'] = 'error';
                $result_info['message'] = "no add order order_id:" . $date['order_id'];
            }

        } else {
            //没有这个商品
            $result_info['result'] = 'success';
            $result_info['message'] = 'goods null $goods_id';
        }

        return $result_info;

    }

}
?>