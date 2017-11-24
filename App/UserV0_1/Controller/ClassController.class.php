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
class ClassController extends Controller {
    
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
    public function getClass2All(){
        /**
        * 以class1为根据排序class2
        *
        */
        
        
        $model = M('class');
        $where['level'] = 2;
        $res = $model -> where($where) -> order('sort asc') -> select();
        
        
        $model = M('brand');
        $brand_res = $model  -> select();
        
        
        $arr=[];
        
        foreach ($res as $value) {
            $arr[$value['super_id']]['class2item'][]=$value;
            $arr[$value['super_id']]['brandInfo']=$brand_res;
        }
        
        $result_info['result'] = 'success';
        $result_info['message'] = $arr;
        echo json_encode($result_info);
        
    }
    
    public function isNew(){
        
        $updateArr= I('post.updateArr');
        $arrs=[];
        
        $m=M('Class');
        foreach ($updateArr as $key => $value) {
            $w['class_id']=$value['id'];
            $r=[];
            $r=$m->where($w)->find();
            
            if($r!==null){
                
                $c_edit_time=$value['edit_time'];
                $s_edit_time=$r['edit_time'];
                if($s_edit_time > $c_edit_time){
                    //如果服务器的最新修改时间大于本地的最新修改时间
                    $arrs[]=$r;
                }
            }else{
                //数据被删除
                $r['class_id']= $w['class_id'];
                $r['remove']=1;
                $arrs[]=$r;
            }
            
            
        }
        
        $res['res']=count($arrs);
        $res['msg']=$arrs;
        $res['updateArr']=$updateArr;
        echo json_encode($res);
        
    }
    
    
    
}