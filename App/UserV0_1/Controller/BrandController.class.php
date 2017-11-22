<?php

namespace UserV0_1\Controller;
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
class BrandController extends Controller {
    
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
    
    
    public function getOne(){
        
        $model=M('Brand');
        $where['id']=I('get.id');
        $brand_info= $model->where($where)->find();
        
        $model=M('goods');
        $where=[];
        $where['brand_id']=I('get.id');
        $goods_info= $model->where($where)->select();
        
        
        if($result!==false){
            $result_info['result']='success';
            $result_info['brand_info']=  $brand_info;
            $result_info['goods_info']=  $goods_info;
        }else{
            $result_info['result']='error';
            $result_info['message']  =$result;
        }
        echo json_encode($result_info);
        
    }
    
    
    
    
    
    
}
