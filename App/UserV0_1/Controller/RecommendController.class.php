<?php

namespace UserV0_1\Controller;
use Think\Controller;

/**
* +----------------------------------------------------------------------
* 创建日期：2017年11月6日
* +----------------------------------------------------------------------
* https：//github.com/ALNY-AC
* +----------------------------------------------------------------------
* weixin：AJS0314
* +----------------------------------------------------------------------
* 首页推荐控制器
* @author 代码狮
*
*/
class RecommendController extends Controller {
    
    /**获得首页推荐列表*/
    public function get() {
        
        $model = M();
        $result = $model -> field('t1.*,t2.goods_id,t2.title,t2.price,t2.str_price,t2.head_img') -> table('mia_recommend as t1,mia_goods as t2') -> where('t1.goods_id = t2.goods_id') -> order('t1.sort asc') -> select();
        
        $sql = $model -> _sql();
        
        if ($result !== false) {
            $result_info['result'] = 'success';
            $result_info['message'] = $result;
            $result_info['sql'] = $sql;
        } else {
            
            $result_info['result'] = 'error';
            $result_info['message'] = $sql;
        }
        echo json_encode($result_info);
        
    }
    
    
}