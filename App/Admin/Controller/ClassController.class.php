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
* 分类控制器
* @author 代马狮
*
*/
class ClassController extends CommonController {
    
    public function showList() {
        
        if (IS_POST) {
            
            $file = $_FILES['img'];
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
                    
                    $where['class_id'] = I('post.class_id');
                    $save['img'] = $img_url;
                    $model = M('Class');
                    $result = $model -> where($where) -> save($save);
                    
                }
                
            }
            
            $this -> display();
        } else {
            
            $this -> display();
            
        }
        
    }
    
    public function sortList() {
        
        $list = I('post.list');
        
        foreach ($list as $key => $value) {
            $list[$key]['edit_time']=time();
        }
        
        
        
        $model = M('Class');
        $result = $model -> addAll($list, null, true);
        
        if ($result !== false) {
            $result_info['result'] = 'success';
            $result_info['message'] = $result;
        } else {
            
            $result_info['result'] = 'error';
            $result_info['message'] = $sql;
        }
        echo json_encode($result_info);
        
    }
    
    public function edit() {
        $where['class_id'] = I('post.class_id');
        $save['title'] = I('post.title');
        $save['edit_time'] = time();
        $model = M('Class');
        $result = $model -> where($where) -> save($save);
        if ($result !== false) {
            $result_info['result'] = 'success';
            $result_info['message'] = $result;
        } else {
            
            $result_info['result'] = 'error';
            $result_info['message'] = $sql;
        }
        echo json_encode($result_info);
    }
    
    public function saveImg() {
        $where['class_id'] = I('post.class_id');
        $save['head_img'] = I('post.img');
        $save['edit_time'] = time();
        $model = M('Class');
        $result = $model -> where($where) -> save($save);
        if ($result !== false) {
            $result_info['result'] = 'success';
            $result_info['message'] = $result;
        } else {
            
            $result_info['result'] = 'error';
            $result_info['message'] = $sql;
        }
        echo json_encode($result_info);
    }
    
    public function add() {
        
        $date = I('post.addDate');
        $date['add_time'] = time();
        $date['edit_time'] = time();
        
        $model = M('Class');
        $result = $model -> add($date);
        if ($result !== false) {
            $result_info['result'] = 'success';
            $result_info['message'] = $result;
        } else {
            
            $result_info['result'] = 'error';
            $result_info['message'] = $sql;
        }
        echo json_encode($result_info);
    }
    
    /**
    * 获取分类列表1
    * */
    public function getClassList() {
        
        if (IS_GET) {
            
            $model = M('class');
            $result = $model -> order('sort asc') -> select();
            
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
    
    public function remove() {
        
        $where['class_id'] = I('post.class_id');
        
        $model = M('Class');
        $result = $model -> where($where) -> delete();
        
        if (I('post.level') == '1') {
            
            $where2['super_id'] = I('post.class_id');
            
            $result = $model -> where($where2) -> delete();
        }
        if ($result !== false) {
            $result_info['result'] = 'success';
            $result_info['message'] = $result;
        } else {
            
            $result_info['result'] = 'error';
            $result_info['message'] = $sql;
        }
        echo json_encode($result_info);
        
    }
    
    //删除图片
    public function deleteImg() {
        $where['class_id'] = I('get.class_id');
        $save['img'] = null;
        
        $model = M('Class');
        $result = $model -> where($where) -> save($save);
        
    }
    
}