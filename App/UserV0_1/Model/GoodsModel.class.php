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
 * 用户获取商品列表
 * @author 代马狮
 *
 */

class GoodsModel extends Model {

    /**
     *此为工具函数，用于获取某个字段
     * */
    public function getGoodsfield($field, $goods_id) {

        $where['goods_id'] = $goods_id;

        $result = $this -> field($field) -> where($where) -> find();

        if ($result) {
            //有信息
            $result_info['result'] = 'success';
            $result_info['message'] = $result;
            return $result_info;

        } else {

            $result_info['result'] = 'error';
            $result_info['message'] = "no data $field";
            return $result_info;

        }

    }

    /**
     * 查找：
     * 1、通过关键字
     * 2、通过类别
     */
    public function getGoodsLists($type, $key) {

        $result;
        $result_info;
        if ($type === 'link') {
            //通过关键字查找
            $where['title'] = array('like', $key, 'OR');
            $result = $this -> where($where) -> select();

        }

        if ($type === 'class') {
            //通过类别查找
            $where['class_id'] = $key;
            $result = $this -> where($where) -> select();
        }

        if ($result) {
            //找到了
            $result_info['result'] = 'success';
            $result_info['message'] = $result;

        } else {
            //找不到
            $result_info['result'] = 'error';
            $result_info['message'] = "no data $type";

        }

        return $result_info;
    }

}
?>