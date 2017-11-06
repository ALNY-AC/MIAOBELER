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
class ClassController extends CommonController {
    
    /**
    * 获取分类列表
    * */
    public function getClassList() {
        
        if (IS_GET) {
            
            $model = M('class');
            $result = $model -> order('sort asc') -> select();
            
            if (I('get.debug') === 'true') {
                dump($result);
            } else {
                echo json_encode($result);
            }
            
        }
        
    }
    
    /**
    * 获取分类列表1
    * */
    public function getClassList1() {
        
        if (IS_GET) {
            
            $model = M('class');
            $result = $model -> where('level = 1') -> order('sort asc') -> select();
            
            if ($result !== false) {
                $result_info['result'] = 'success';
                $result_info['message'] = $result;
            } else {
                
                $result_info['result'] = 'error';
                $result_info['message'] = $sql;
            }
            echo json_encode($result_info);
            
        }
        
    }
    
    /**
    * 获取分类列表2
    * */
    public function getClassList2() {
        
        if (IS_GET) {
            
            $model = M('class');
            
            $where['super_id'] = I('get.super_id');
            $where['level'] = 2;
            $result = $model -> where($where) -> order('sort asc') -> select();
            
            if ($result !== false) {
                $result_info['result'] = 'success';
                $result_info['message'] = $result;
            } else {
                
                $result_info['result'] = 'error';
                $result_info['message'] = $sql;
            }
            echo json_encode($result_info);
            
        }
        
    }
}