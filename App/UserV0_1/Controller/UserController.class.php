<?php

namespace UserV0_1\Controller;

use Think\Controller;

/**
* +----------------------------------------------------------------------
* 创建日期：2017年10月25日
* +----------------------------------------------------------------------
* https：//github.com/ALNY-AC
* +----------------------------------------------------------------------
* weixin：AJS0314
* +----------------------------------------------------------------------
*用户控制器
* @author 代马狮
*
*/
class UserController extends CommonController {
    
    public function getInfo() {
        
        $where['token'] = I('post.token');
        $model = M('User');
        $result = $model -> where($where) -> find();
        
        if($result!==null){
            $result_info['result'] = 'success';
            $result_info['message'] = $result;
        }else{
            $result_info['result'] = 'error';
            $result_info['message'] = '没有当前用户';
        }
        
        
        echo json_encode($result_info);
        
    }
    
}