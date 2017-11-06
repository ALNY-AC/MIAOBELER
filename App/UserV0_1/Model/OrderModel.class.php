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
    public function addOrder($goodsAll, $user_id) {
        
        
        //添加时间
        $date['add_time'] = time();
        //修改时间
        $date['edit_time'] = $date['add_time'];
        //用户id
        $date['user_id'] = $user_id;
        
        //支付方式
        $date['payment_method'] = 0;
        //默认的订单状况
        $date['state'] = 1;
        //订单号
        $date['order_id'] = date('YmdHis') . rand(1000, 5000);
        //价格
        $date['money'] =0;
        $date['user_money'] = 0;
        
        $goods_model=M('goods');
        
        for ($i=0; $i <count($goodsAll) ; $i++) {
            
            //设置订单号
            $goodsAll[$i]['order_id']= $date['order_id'];
            
            //找到商品
            $where['goods_id'] = $goodsAll[$i]['goods_id'];
            $goods_info = $goods_model->where($where)->find();
            //价格计算
            $goodsAll[$i]['price']= $goods_info['price']*  $goodsAll[$i]['num'];
            $date['money' ]+=  $goodsAll[$i]['price'];
            
            
        }
        
        
        $model=M('order_goods');
        $model->addAll($goodsAll);
        
        
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
        
        
        return $result_info;
        
    }
    
}
?>