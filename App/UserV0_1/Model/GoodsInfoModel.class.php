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
* 商品详情页模型，用于获取详情页
* @author 代马狮
*
*/

class GoodsInfoModel extends Model {
    
    public function getGoodsInfo($goods_id) {
        
        
        
        
        
        
        $where['goods_id'] = $goods_id;
        $result = $this -> where($where) -> find();
        
        if ($result !== null) {
            //有
            $result_info['result'] = 'success';
            $result['content'] = html_entity_decode($result['content']);
            
            $result_info['message'] = $result;
        } else {
            //没有
            $result_info['result'] = 'error';
            $result_info['message'] = 'no goods info';
        }
        
        $where['user_id']=session('user_id');
        $model=M('Collect');
        $result = $model -> where($where) -> find();
        
        if($result!==null &&  $result!==false ){
            $result_info['is_collect'] =1;
        }else{
            $result_info['is_collect'] =0;
        }
        
        
        
        return $result_info;
    }
    
}
?>