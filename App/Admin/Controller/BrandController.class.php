<?php

namespace Admin\Controller;
use Think\Controller;

/**
* +----------------------------------------------------------------------
* 创建日期：2017年10月28日
* +----------------------------------------------------------------------
* https：//github.com/ALNY-AC
* +----------------------------------------------------------------------
* weixin：AJS0314
* +----------------------------------------------------------------------
* 品牌
* @author 代马狮
*
*/
class BrandController extends CommonController {
    public function showList() {
        $this -> display();
    }
    
    public function upFile() {
        
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
                
                $result['code'] = 0;
                $result['msg'] = '成功';
                $result['data'] = array();
                $result['data']['src'] = $img_url;
                echo json_encode($result);
            }
            
        }
        
    }
    
    public function add(){
        
        
        if(IS_POST){
            //添加
            $add['brand_title']=I('post.brand_title');
            
            $add['info']=I('post.info');
            $add['head_img']=I('post.head_img');
            $add['max_img']=I('post.max_img');
            $add['logo']=I('post.logo');
            $add['add_time']=time();
            $add['edit_time']=time();
            
            $model=M('Brand');
            $result=$model->add($add);
            
            if($result!==false){
                
                $result_info['result']='success';
                $result_info['message']='添加成功';
                
            }else{
                
                $result_info['result']='error';
                $result_info['message']='添加失败';
                
            }
            
            echo json_encode($result_info);
            
            
        }else{
            
            $this -> display();
            
        }
        
    }
    
    public function save(){
        
        
        if(IS_POST){
            //保存
            $where['id']=I('post.id');
            $save['brand_title']=I('post.brand_title');
            
            $save['info']=I('post.info');
            $save['head_img']=I('post.head_img');
            $save['max_img']=I('post.max_img');
            $save['logo']=I('post.logo');
            $save['edit_time']=time();
            
            $model=M('Brand');
            $result=$model->where($where)->save($save);
            
            if($result!==false){
                
                $result_info['result']='success';
                $result_info['message']='保存成功';
                
            }else{
                
                $result_info['result']='error';
                $result_info['message']='保存失败';
                
            }
            
            echo json_encode($result_info);
            
            
        }else{
            
            $this -> display();
            
        }
        
    }
    
    
    public function getList(){
        
        $model=M('Brand');
        $result=$model->select();
        
        if($result!==false){
            
            $result_info['result']='success';
            $result_info['message']=  $result;
            
        }else{
            
            $result_info['result']='error';
            $result_info['message']  =$result;
            
        }
        
        echo json_encode($result_info);
        
    }
    
    
    public function del(){
        
        $model=M('Brand');
        $where['id']=I('post.id');
        $result=  $model->where($where)->delete();
        if($result!==false){
            $result_info['result']='success';
            $result_info['message']=  '删除成功';
        }else{
            $result_info['result']='error';
            $result_info['message']  ='删除失败';
        }
        echo json_encode($result_info);
        
    }
    
    public function edit(){
        
        $this -> assign('id',I('get.id'));
        $this -> display();
        
    }
    
    public function getOne(){
        
        $model=M('Brand');
        $where['id']=I('get.id');
        $result= $model->where($where)->find();
        
        
        if($result!==false){
            $result_info['result']='success';
            $result_info['message']=  $result;
        }else{
            $result_info['result']='error';
            $result_info['message']  =$result;
        }
        echo json_encode($result_info);
        
        
        
    }
    
    
}