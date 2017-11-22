<?php

namespace UserV0_1\Controller;
use Think\Controller;

/**
* +----------------------------------------------------------------------
* 创建日期：2017年10月30日
* +----------------------------------------------------------------------
* https：//github.com/ALNY-AC
* +----------------------------------------------------------------------
* weixin：AJS0314
* +----------------------------------------------------------------------
* 动态控制器
* @author 代马狮
*
*/
class DynamicController extends CommonController {
    
    
    //点赞
    public function z(){
        
        // $where['user_id']=I('post.user_id');
        $where['dynamic_id']=I('post.dynamic_id');
        $model=M('Dynamic');
        $model->where($where)->setInc('good_count'); // 用户的加1
        
        $result_info['result']='success';
        $result_info['sql']=$model->_sql();
        $result_info['dynamic_id']=    $where['dynamic_id'];
        echo json_encode($result_info);
        
    }
    
    
    /**
    * 发布动态
    * */
    public function add() {
        
        if (IS_POST) {
            
            
            
            
            $date['add_time'] = time();
            $date['edit_time'] = $date['add_time'];
            $date['user_id'] = session('user_id');
            
            
            // $date['title'] = I('post.title');
            $date['content'] = I('post.content');
            $date['dynamic_id'] = md5($date['user_id'] . $date['title'] . $date['add_time'] . rand());
            
            
            
            $imgs=I('post.imgs');
            
            for($i=0;$i<count($imgs);$i++){
                $date['img'.($i+1)] =$imgs[$i]['img'];
            }
            
            
            
            $model = M('Dynamic');
            $result = $model -> add($date);
            
            
            if ($result) {
                $return_info['result'] = 'success';
                $return_info['message'] = 'add true';
            } else {
                $return_info['result'] = 'error';
                $return_info['message'] = 'add false';
            }
            echo json_encode($return_info);
            
        } else {
            
            //错误，请使用post提交
            $return_info['result'] = 'error';
            $return_info['message'] = 'post false';
            echo json_encode($return_info);
        }
        
    }
    
    /**
    * 转发动态
    * */
    public function forward() {
        
        if (IS_POST) {
            //  ==========
            //  = 先取出目标动态 =
            //  ==========
            $where['dynamic_id'] = I('post.forward_user_id');
            $model = M('Dynamic');
            
            $dynamic_info = $model -> where($where) -> find();
            
            //  ==========
            //  = 然后创建转发动态 =
            //  ==========
            
            $date['title'] = $dynamic_info['title'];
            $date['content'] = $dynamic_info['content'];
            $date['add_time'] = time();
            $date['user_id'] = session('user_id');
            //这个是必须的，指向了转发的id
            $date['forward_user_id'] = I('post.forward_user_id');
            $date['dynamic_id'] = md5($date['user_id'] . $date['title'] . $date['add_time'] . rand());
            $result = $model -> add($date);
            
            if ($result) {
                $return_info['result'] = 'success';
                $return_info['message'] = 'add true';
            } else {
                $return_info['result'] = 'error';
                $return_info['message'] = 'add false';
            }
            
        } else {
            
            //错误，请使用post提交
            $return_info['result'] = 'error';
            $return_info['message'] = 'post false';
            echo json_encode($return_info);
        }
        
    }
    
    /**
    * 回复动态
    * */
    public function reply() {
        if (IS_POST) {
            
            if (!empty(I('post.dynamic_id'))) {
                //comment_id
                
                $date['dynamic_id'] = I('post.dynamic_id');
                $date['content'] = I('post.content');
                $date['user_id'] = session('user_id');
                $date['add_time'] = time();
                $date['comment_id'] = md5($date['dynamic_id'] . $date['user_id'] . $date['add_time'] . rand());
                
                $model = M('Comment');
                $result = $model -> add($date);
                
                if ($result) {
                    $return_info['result'] = 'success';
                    $return_info['message'] = 'reply true';
                } else {
                    $return_info['result'] = 'error';
                    $return_info['message'] = 'reply false';
                }
                echo json_encode($return_info);
            }
        }
    }
    
    /**
    * 获得单个动态
    * 包括回复
    *
    * */
    public function getOne() {
        
        if (!empty(I('post.dynamic_id'))) {
            
            //  ==========
            //  = 找动态 =
            //  ==========
            $where['dynamic_id'] = I('post.dynamic_id');
            $model = M('Dynamic');
            $dynamic_info = $model -> where($where) -> find();
            
            if (!$dynamic_info) {
                
                $return_info['result'] = 'error';
                $return_info['message'] = 'dynamic_info null id:' . $where['dynamic_id'];
                echo json_encode($return_info);
                exit ;
                
            }
            
            //  ==========
            //  = 找回复 =
            //  ==========
            
            $model = M('Comment');
            $commentList = $model -> where($where) -> select();
            
            $date['dynamic_info'] = $dynamic_info;
            $date['commentList'] = $commentList;
            $return_info = array();
            $return_info['result'] = 'success';
            $return_info['message'] = $date;
            echo json_encode($return_info);
        } else {
            $return_info['result'] = 'error';
            $return_info['message'] = 'dynamic_id null';
            echo json_encode($return_info);
        }
        
    }
    
    /**
    * 获得动态列表
    * */
    public function getList() {
        
        
        $model = M('');
        $result = $model -> field('t1.*,t2.*') -> table('mia_dynamic as t1,mia_user as t2') -> where('t1.user_id = t2.user_id') -> select();
        
        if ($result!==false) {
            $return_info['result'] = 'success';
            $return_info['message'] = $result;
            
        } else {
            $return_info['result'] = 'error';
            $return_info['message'] = 'upload img false';
            
        }
        echo json_encode($return_info);
        
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
                
                $result['code'] = 0;
                $result['msg'] = '成功';
                $result['data'] = array();
                $result['data']['src'] = $img_url;
                echo json_encode($result);
            }
            
        }
        
    }
    
}