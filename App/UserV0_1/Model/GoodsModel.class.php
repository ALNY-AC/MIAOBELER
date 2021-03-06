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
    *此为工具函数，用于获取某个字段的值
    * */
    public function getGoodsfield($field, $goods_id) {
        
        $where['goods_id'] = $goods_id;
        $where['is_show'] = 1;
        
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
            $where['title'] = array(
            'like',
            $key,
            'OR'
            );
            $where['is_show'] = 1;
            
            $result = $this -> where($where) -> select();
            
            //          echo $this -> _sql();
            //          exit ;
        }
        
        if ($type === 'class') {
            //通过类别查找
            $where['class_id'] = $key;
            $where['is_show'] = 1;
            $result = $this -> where($where) -> select();
        }
        $result_info['sql'] = $this->_sql();
        
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
    
    /**通过id查找单个*/
    public function getGoods($goods_id) {
        
        $where['goods_id'] = $goods_id;
        $where['is_show'] = 1;
        $result = $this -> where($where) -> find();
        
        if ($result) {
            //找到了
            $result_info['result'] = 'success';
            $result_info['message'] = $result;
            
        } else {
            //找不到
            $result_info['result'] = 'error';
            $result_info['message'] = "no Goods $goods_id";
            
        }
        return $result_info;
    }
    
    /**通过id查找多个*/
    public function getGoodsAll($goods_id) {
        
        //      $where['goods_id'] = $goods_id;
        //      $where['is_show'] = 1;
        
        //      goods_id in('8a61ac4bd043fd1d3210bd806ab9a68e','0499e29cc1b826608e8066a85d6b80d0')
        
        $where = 'goods_id in(' . $goods_id . ')';
        $result = $this -> where($where) -> select();
        
        if ($result) {
            //找到了
            $result_info['result'] = 'success';
            $result_info['message'] = $result;
            
        } else {
            //找不到
            $result_info['result'] = 'error';
            $result_info['message'] = "no Goods $goods_id";
            
        }
        return $result_info;
    }
    
}
?>