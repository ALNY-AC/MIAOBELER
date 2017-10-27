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
 * 用户的购物车管理
 * @author 代马狮
 *
 */

class ShoppingBagModel extends Model {

    /**
     * 添加购物袋商品
     * */
    public function addBag($goods_id, $num, $user_id) {
        $result_info;
        /*
         * 先看看有没有
         * 有的话num++
         * 没有的话就添加
         *
         * */
        $where['goods_id'] = $goods_id;
        $where['user_id'] = $user_id;
        $result = $this -> where($where) -> find();
        if ($result) {
            //有数据
            $num = $result['num'];
            $date['num'] = ++$num;
            $date['edit_time'] = time();

            $result = $this -> where($where) -> save($date);

        } else {

            //没有数据，添加新数据
            $user_id = session('user_id');
            $date = array();
            $date['add_time'] = time();
            $date['edit_time'] = time();
            $date['user_id'] = $user_id;
            $date['goods_id'] = $goods_id;
            $date['num'] = $num;
            $date['bag_id'] = md5($date['user_id'] . $date['goods_id'] . $date['add_time'] . md5(rand()));
            $result = $this -> add($date);

        }
        if ($result) {
            //有信息
            $result_info['result'] = 'success';
            $result_info['message'] = 'addBag true';
        } else {
            //没有信息
            $result_info['result'] = 'error';
            $result_info['message'] = "no addBag $goods_id, $num";
        }
        return $result_info;

    }

    /**
     * 修改购物袋中商品的数量
     * */
    public function saveBagNum($goods_id, $num, $user_id) {

        //有数据
        $date['num'] = $num;
        $date['edit_time'] = time();

        $where['goods_id'] = $goods_id;
        $where['user_id'] = $user_id;
        $result = $this -> where($where) -> save($date);

        if ($result !== false) {
            //有信息
            $result_info['result'] = 'success';
            $result_info['message'] = 'saveGabNum true';

        } else {
            //没有信息
            $result_info['result'] = 'error';
            $result_info['message'] = "false saveGabNum $goods_id, $num";

        }
        return $result_info;
    }

    /**移除购物车的一个商品*/
    public function removeBag($bag_id, $user_id) {

        $where['bag_id'] = $bag_id;
        $where['user_id'] = $user_id;
        $result = $this -> where($where) -> delete();

        if ($result !== false) {
            //有信息
            $result_info['result'] = 'success';
            $result_info['message'] = 'removeBag true';

        } else {
            //没有信息
            $result_info['result'] = 'error';
            $result_info['message'] = "removeBag false $bag_id";

        }
        return $result_info;
    }

    /**
     * 显示用户的购物车
     * */
    public function showList($user_id) {

        $where['user_id'] = $user_id;
        $result = $this -> where($where) -> select();

        if ($result) {
            //有信息
            $result_info['result'] = 'success';
            $result_info['message'] = $result;

        } else {
            //没有信息
            $result_info['result'] = 'error';
            $result_info['message'] = "showList false $user_id";

        }
        return $result_info;

    }

}
?>