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
        
        $dynamic_id=I('post.dynamic_id');
        $model=M('dynamic_good');
        $where=[];
        $where['dynamic_id']=$dynamic_id;
        $where['user_id']= session('user_id');
        $result=$model->where($where)->find();
        
        if($result==null){
            //没有就添加
            
            //=========添加数据区
            $add=[];
            $add['dynamic_id']=$dynamic_id;
            $add['user_id']= session('user_id');
            //=========sql区
            $result=$model->add($add);
            
            //查询数量
            $result=$model->where('dynamic_id = '.$dynamic_id)->count();
            
            //=========判断=========
            if($result){
                $res['res']=1;
                $res['msg']=$result;
            }else{
                $res['res']=-1;
                $res['msg']=$result;
            }
            //=========判断end=========
        }else{
            $res['res']=0;
        }
        
        echo json_encode($res);
        
    }
    
    
    /**
    * 发布动态
    * */
    public function add() {
        
        if (IS_POST) {
            
            //先保存基础的动态信息
            $add['user_id']         =   session('user_id');
            $add['content']         =   I('post.content');
            $add['add_time']        =   time();
            $add['edit_time']       =   time();
            $add['dynamic_id']      =   md5($date['user_id'] . $date['add_time'] . rand());
            $dynamic_id             =   $add['dynamic_id'];
            //保存
            $model                  =   M('Dynamic');
            $result                 =   $model -> add($add);
            if($result){
                
                //如果保存成功，就保存动态的信息，比如图片，商品号等
                
                $ids                =   I('post.ids');//商品号列表
                $imgs               =   I('post.imgs');//图片列表
                $add                =   [];//初始化
                $add['dynamic_id']  =   $dynamic_id;//id
                $add['goods_list']    =   count($ids)>0 ? json_encode($ids):'[]';//有就储存，
                $add['img_list']   =   count($imgs)>0 ? json_encode($imgs):'[]';//没有就不存储
                $add['add_time']    =   time();//添加时间
                $add['edit_time']   =   time();//修改时间
                
                $model              =   M('DynamicInfo');
                $result             =   $model -> add($add);//保存
                if($result){
                    $return_info['result'] = 'success';
                    $return_info['message'] = 'add true';
                }else{
                    $return_info['result'] = 'error';
                    $return_info['message'] = '动态信息插入错误';
                }
                
            }else{
                
                //发布错误
                $return_info['result'] = 'error';
                $return_info['message'] = '动态插入错误！';
                
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
            // $dynamic_info = $model -> where($where) -> find();
            $dynamic_info = $model
            -> field('t1.*,t2.*')
            -> table('mia_dynamic as t1,mia_user as t2')
            -> where('t1.user_id = t2.user_id AND t1.dynamic_id = "'. I('post.dynamic_id').'"')
            -> find();
            
            
            
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
            //联表找用户
            // $commentList = $model -> where($where) -> select();
            $commentList = $model
            -> field('t1.*,t1.add_time as t1_add_time,t2.*')
            -> table('mia_comment as t1,mia_user as t2')
            -> where('t1.user_id = t2.user_id AND t1.dynamic_id = "'. I('post.dynamic_id').'"')
            -> select();
            
            //  ==========
            //  = 找图片、找商品 =
            //  ==========
            $model          =   M('DynamicInfo');
            $list       =   $model->where($where)->find();//图片列表
            $dynamic_info['img_list']= json_decode($list['img_list'],true) ;
            $goods_id_list= json_decode($list['goods_list'],true) ;
            
            
            //找商品
            
            $goods_id_list=implode(",",$goods_id_list);//转换字符
            $where['goods_id']=array('in',$goods_id_list);//条件
            $model=M('goods');//模型
            $goods_list=$model->where($where)->select();//查询
            $dynamic_info['goods_list']=$goods_list;
            
            // ========================
            // ==== 找完了 ====
            // ========================
            
            
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
        $result = $model
        -> field('t1.*,t2.*')
        -> table('mia_dynamic as t1,mia_user as t2')
        -> where('t1.user_id = t2.user_id') -> select();
        
        
        //批量设置动态信息
        foreach ($result as $key => $value) {
            //动态信息表
            $model          =   M('DynamicInfo');
            //找图片
            $where=[];
            $where['dynamic_id'] = $value['dynamic_id'];
            $list       =   $model->where($where)->find();//图片列表
            $img_list= json_decode($list['img_list'],true) ;
            $goods_id_list= json_decode($list['goods_list'],true) ;
            //找商品
            $model          =   M('Order');
            $goods_id_list=implode(",",$goods_id_list);//转换字符
            
            if($goods_id_list){
                $where['goods_id']=array('in',$goods_id_list);//条件
                $model=M('goods');//模型
                $goods_list=$model->where($where)->select();//查询
            }
            //完
            $result[$key]['img_list']=$img_list?$img_list:[];
            $result[$key]['goods_list']=$goods_list?$goods_list:[];
            //如果大于1，宽度就不是100%了
            if(count($goods_list)>1){
                $result[$key]['is_width']=true;
            }else{
                $result[$key]['is_width']=false;
            }
            
            //完
            //找点赞数
            $model=M('dynamic_good');
            $where=[];
            $where['dynamic_id']=$where['dynamic_id'];//动态id
            //取点赞数
            $count=$model->where($where)->count();
            $result[$key]['good_count']=$count;
            
        }
        
        
        
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