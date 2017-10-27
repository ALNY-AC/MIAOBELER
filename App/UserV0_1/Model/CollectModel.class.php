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
 * 用户收藏表
 * @author 代马狮
 *
 */

class CollectModel extends Model {

    /**切换用户收藏*/
    public function toggle($goods_id, $user_id) {

        $where['goods_id'] = $goods_id;
        $where['user_id'] = $user_id;

        $result = $this -> where($where) -> find();

        if ($result === null) {
            //未收藏，需要添加

            $date['user_id'] = session('user_id');
            $date['add_time'] = time();
            $date['goods_id'] = $goods_id;
            $date['collect_id'] = md5($date['user_id'] . $date['add_time'] . $date['goods_id'] . md5(rand()));

            $result = $this -> add($date);

            if ($result) {
                //添加了
                $result_info['result'] = 'success';
                $result_info['message'] = 'add collect true';
            } else {
                //失败了
                $result_info['result'] = 'error';
                $result_info['message'] = "no add collect $goods_id";
            }

        } else {
            //收藏了，需要删除

            $result = $this -> where($where) -> delete();

            if ($result !== false) {
                //删除了
                $result_info['result'] = 'success';
                $result_info['message'] = 'remove true';
            } else {
                //失败了
                $result_info['result'] = 'error';
                $result_info['message'] = "no remove collect $goods_id";
            }

        }

        return $result_info;

    }

    /**查找用户收藏*/
    public function showList($user_id) {

        $where['user_id'] = $user_id;
        $result = $this -> where($where) -> select();

        if ($result) {
            //有数据
            $result_info['result'] = 'success';
            $result_info['message'] = $result;
        } else {
            //没数据
            $result_info['result'] = 'success';
            $result_info['message'] = "0";
        }
        return $result_info;
    }

}
?>