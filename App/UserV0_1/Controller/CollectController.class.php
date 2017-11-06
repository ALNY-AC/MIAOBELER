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
class CollectController extends CommonController {
    
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
        
        if (IS_GET) {
            $model = D('Collect');
            
            $result = $model -> showList(session('user_id'));
            
            if (I('get.debug') === 'true') {
                dump($result);
            } else {
                echo json_encode($result);
            }
        }
        
    }
    
}