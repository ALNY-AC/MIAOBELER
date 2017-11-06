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
*
* @author 代马狮
*
*/
class ShoppingBagController extends CommonController {
    
    /**
    * 添加购物袋
    * */
    public function addBag() {
        
        if (IS_POST) {
            
            $goods_id = I('post.goods_id');
            $num = I('post.num');
            $where['token']=I('post.token');
            
            $model=M('user');
            $result= $model->where($where)->find();
            $user_id=$result['user_id'];
            
            if ($user_id) {
                //用户登录了
                $model = D('ShoppingBag');
                $result = $model -> addBag($goods_id, $num, $user_id);
                
                
                if($result!==false){
                    $result_info['result'] = 'success';
                    $result_info['message'] ='添加成功~';
                }else{
                    $result_info['result'] = 'error';
                    $result_info['message'] ='添加失败！';
                }
                
                
                
            } else {
                //用户未登录
                $result_info['result'] = 'error';
                $result_info['message'] = "user_id null";
            }
            
            if (I('get.debug') === 'true') {
                dump($result_info);
            } else {
                echo json_encode($result_info);
            }
            
        }
        
    }
    
    /**
    * 修改购物袋商品数量
    * */
    public function saveBagNum() {
        
        if (IS_POST) {
            
            $goods_id = I('post.goods_id');
            
            if ($goods_id) {
                $num = I('post.num');
                $model = D('ShoppingBag');
                $result = $model -> saveBagNum($goods_id, $num, session('user_id'));
                
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
    
    /**
    * 删除一个购物袋商品
    * */
    public function removeBag() {
        
        if (IS_POST) {
            
            $goods_id = I('post.goods_id');
            
            if ($goods_id) {
                
                $bag_id = I('post.bag_id');
                $model = D('ShoppingBag');
                $result = $model -> removeBag($bag_id, session('user_id'));
                
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
    
    /**
    * 显示用户的购物车信息
    * */
    public function showList() {
        
        $model = D('ShoppingBag');
        $result = $model -> showList(session('user_id'));
        
        if (I('get.debug') === 'true') {
            dump($result);
        } else {
            echo json_encode($result);
        }
        
    }
    
}