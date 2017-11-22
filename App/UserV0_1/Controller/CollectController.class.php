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
* 用户收藏控制器
* @author 代马狮
*
*/
class CollectController extends Controller {
    
    /**切换用户收藏*/
    public function toggle() {
        //      session('user_id', '11012012137');
        if (IS_POST) {
            
            $goods_id = I('post.goods_id');
            
            if ($goods_id) {
                
                $model = D('Collect');
                
                $result = $model -> toggle($goods_id, session('user_id'));
                
                
                if (I('get.debug') === 'true') {
                    dump($result);
                } else {
                    echo json_encode($result);
                }
                
            } else {
                
                $result_info['result'] = 'error';
                $result_info['message'] = "goods_id null";
                if (I('get.debug') === 'true') {
                    dump($result_info);
                } else {
                    echo json_encode($result_info);
                }
                exit ;
                
            }
            
        }
        
    }
    
    /**显示收藏列表*/
    public function showList() {
        
        $model = D('Collect');
        $result = $model -> showList(session('user_id'));
        
        // select t1.*,t2.*,t3.* from mia_order as t1,mia_order_goods as t2,mia_goods as t3 where(t1.order_id = t2.order_id AND t2.goods_id = t3.goods_id)
        // $result = $model -> field('t1.*,t2.goods_id,t2.title,t2.price,t2.str_price,t2.head_img') -> table('mia_recommend as t1,mia_goods as t2') -> where('t1.goods_id = t2.goods_id') -> order('t1.sort asc') -> select();
        
        // select t1.*,t2.* from mia_collect as t1,mia_goods as t2 WHERE(t1.goods_id = t2.goods_id )
        
        $result = $model -> field('t1.*,t2.*') -> table('mia_collect as t1,mia_goods as t2') -> where('t1.goods_id = t2.goods_id') -> select();
        
        $result_info['result'] = 'success';
        $result_info['message'] = $result;
        
        if (I('get.debug') === 'true') {
            dump($result_info);
        } else {
            echo json_encode($result_info);
        }
        
    }
    
}