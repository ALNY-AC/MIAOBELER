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
        
        $where['user_id'] =session('user_id');
        
        $model = M('User');
        $result = $model -> where($where) -> find();
        
        if($result!==null){
            $result_info['result'] = 'success';
            $result_info['message'] = $result;
        }else{
            $result_info['result'] = 'error';
            $result_info['message'] = '用户不存在';
        }
        
        
        echo json_encode($result_info);
        
    }
    
    public function save(){
        
        $where['user_id'] =session('user_id');
        $model = M('User');
        // $result = $model -> where($where) -> find();
        if(!empty(I('user_name'))){
            //昵称设置
            $save['user_name'] = I('post.user_name');
            $result = $model -> where($where) -> save($save);
            
            if($result!==false){
                $result_info['result']='success';
                $result_info['message']= '修改成功';
                
            }else{
                $result_info['result']='error';
                $result_info['message']= '操作失败';
            }
            
        }
        
        if(!empty(I('user_info'))){
            //个性签名
            $save['user_info'] = I('post.user_info');
            $result = $model -> where($where) -> save($save);
            if($result!==false){
                $result_info['result']='success';
                $result_info['message']= '修改成功';
                
            }else{
                $result_info['result']='error';
                $result_info['message']= '操作失败';
            }
            
        }
        
        if(!empty(I('head_img_url'))){
            //头像
            $save['user_info'] = I('post.head_img_url');
            $result = $model -> where($where) -> save($save);
            if($result!==false){
                $result_info['result']='success';
                $result_info['message']= '修改成功';
                
            }else{
                $result_info['result']='error';
                $result_info['message']= '操作失败';
            }
            
        }
        echo json_encode($result_info);
        
    }
    /**
    *
    *上传图片，一次只能上传一张
    * */
    public function upImg() {
        
        $file = $_FILES['file'];
        
        if (!$file['error']) {
            //定义配置
            $cfg = array(
            //配置上传路径
            'rootPath' => WORKING_PATH . UPLOAD_ROOT_PATH);
            //实例化上传类
            $upload = new \Think\Upload($cfg);
            //开始上传
            $info = $upload -> uploadOne($file);
            //判断是否上传成功
            if ($info) {
                //图片地址
                $img_url = UPLOAD_ROOT_PATH . $info['savepath'] . $info['savename'];
                
                
                $model=M('User');
                $where['user_id']=session('user_id');
                $save['head_img_url']= $img_url;
                
                
                $model->where($where)->save($save);
                
                
                $result['code'] = 0;
                $result['msg'] = '成功';
                $result['data'] = array();
                $result['data']['src'] = $img_url;
                echo json_encode($result);
                
            }
            
        }
        
    }
}