<?php

namespace UserV0_1\Controller;
use Think\Controller;

/**
* +----------------------------------------------------------------------
* 创建日期：2017年11月7日
* +----------------------------------------------------------------------
* https：//github.com/ALNY-AC
* +----------------------------------------------------------------------
* weixin：AJS0314
* +----------------------------------------------------------------------
* 收获地址添加
* @author 代马狮
*
*/
class AddressController extends CommonController {
    
    public function add(){
        
        $user_id=session('user_id');
        
        $model=M('address');
        
        $add['address_id']=md5( $user_id.rand());
        $add['user_id']=$user_id;
        $add['people']=I('post.people');
        $add['content']=I('post.content');
        $add['phone']=I('post.phone');
        
        $result=$model->add($add);
        if($result!==false){
            $result_info['result']='success';
            $result_info['message']='add true';
        }else{
            $result_info['result']='error';
            $result_info['message']='add false';
        }
        echo json_encode($result_info);
        
    }
    public function getOne(){
        
        $user_id=session('user_id');
        $model=M('address');
        $where['user_id']=$user_id;
        $where['address_id']=I('post.address_id');
        $result = $model->where($where)->find();
        
        if($result!==false){
            $result_info['result']='success';
            $result_info['message']= $result;
        }else{
            $result_info['result']='error';
            $result_info['message']='getOne false';
        }
        echo json_encode($result_info);
    }
    
    public function getList(){
        
        $user_id=session('user_id');
        $model=M('address');
        $where['user_id']=$user_id;
        $result = $model->where($where)->select();
        
        if($result!==false){
            $result_info['result']='success';
            $result_info['message']= $result;
        }else{
            $result_info['result']='error';
            $result_info['message']='getList false';
        }
        echo json_encode($result_info);
        
    }
    
    public function del(){
        
        $user_id=session('user_id');
        $model=M('address');
        $where['address_id']=I('post.address_id');
        $where['user_id']=$user_id;
        $result = $model->where($where)->delete();
        
        if($result!==false){
            $result_info['result']='success';
            $result_info['message']= $result;
        }else{
            $result_info['result']='error';
            $result_info['message']='del false';
        }
        echo json_encode($result_info);
        
    }
    
    public function save(){
        
        $user_id=session('user_id');
        $model=M('address');
        $where['address_id']=I('post.address_id');
        $where['user_id']=$user_id;
        $result = $model->where($where)->save();
        
        if($result!==false){
            $result_info['result']='success';
            $result_info['message']= $result;
        }else{
            $result_info['result']='error';
            $result_info['message']='save false';
        }
        echo json_encode($result_info);
    }
    
    public function editDefault(){
        //修改默认地址
        
        $user_id=session('user_id');
        $model=M('address');
        $where['user_id']=$user_id;
        
        $save['is_default']=0;
        $result = $model->where($where)->save($save);
        
        $where['address_id']=I('post.address_id');
        $save['is_default']=1;
        $result = $model->where($where)->save($save);
        
        $result_info['user_id']=  $user_id;
        $result_info['address_id']= $where['address_id'];
        
        
        if($result!==false){
            $result_info['result']='success';
            $result_info['message']= 'editDefault true';
        }else{
            $result_info['result']='error';
            $result_info['message']='editDefault false';
        }
        echo json_encode($result_info);
    }
}