<?php

namespace UserV0_1\Controller;
use Think\Controller;

/**
* +----------------------------------------------------------------------
* 创建日期：2017年10月30日
* +----------------------------------------------------------------------
* https：//github.com/ALNY-AC
* +----------------------------------------------------------------------
* weixin：AJS0314
* +----------------------------------------------------------------------
*测试控制器
* @author 代马狮
*
*/
class TestController extends Controller {
    
    public function test() {
        
        $goods_list[]='36013d450b6a0cf33b189286fdd3a446';
        $goods_list[]='c84909be302e5029fafcc874e217a59a';
        
        
        
        
        
        $goods_list=implode(",",$goods_list);
        $where['goods_id']=array('in',$goods_list);
        
        $model=M('goods');
        $result=$model->where($where)->select();
        $sql=  $model->_sql();
        
        dump($sql);
        dump($result);
        
        
        
    }
    
}