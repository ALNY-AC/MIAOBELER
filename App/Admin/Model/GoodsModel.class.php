<?php
namespace Admin\Model;
use Think\Model;

/**
* +----------------------------------------------------------------------
* 创建日期：2017年10月27日
* +----------------------------------------------------------------------
* https：//github.com/ALNY-AC
* +----------------------------------------------------------------------
* weixin：AJS0314
* +----------------------------------------------------------------------
* 用户获取商品列表
* @author 代马狮
*
*/

class GoodsModel extends Model {
    
    public function addDate($post, $file) {
        $date = $post;
        
        if ($file != null) {
            //定义配置
            $cfg = array(
            //配置上传路径
            'rootPath' => WORKING_PATH . UPLOAD_ROOT_PATH);
            //实例化上传类
            $upload = new \Think\Upload($cfg);
            //开始上传
            $info = $upload -> upload($file);
            //判断是否上传成功
            if ($info) {
                
                //array(1) {
                //["head_img"] => array(9) {
                //  ["name"] => string(41) "TB2BV_2dXXXXXaTXpXXXXXXXXXX-880734502.jpg"
                //  ["type"] => string(10) "image/jpeg"
                //  ["size"] => int(216001)
                //  ["key"] => string(8) "head_img"
                //  ["ext"] => string(3) "jpg"
                //  ["md5"] => string(32) "4a642a355c09d3f25c67ecf83b8e4e3b"
                //  ["sha1"] => string(40) "61913b265af478f8d518891f0595293259732acf"
                //  ["savename"] => string(17) "59f499bdde307.jpg"
                //  ["savepath"] => string(11) "2017-10-28/"
                //}
                //}
                
                $head_img = $info['head_img'];
                $head_lg_img = $info['head_lg_img'];
                
                $date['head_img'] = UPLOAD_ROOT_PATH . $head_img['savepath'] . $head_img['savename'];
                $date['head_lg_img'] = UPLOAD_ROOT_PATH . $head_lg_img['savepath'] . $head_lg_img['savename'];
                
            }
            
        }
        
        $date['add_time'] = time();
        $date['edit_time'] = $date['add_time'];
        $date['is_show'] = 1;
        $date['goods_id'] = md5($date['add_time'] . rand());
        
        $content = I('post.content');
        
        $GoodInfo['add_time'] = time();
        $GoodInfo['edit_time'] = $GoodInfo['add_time'];
        $GoodInfo['goods_id'] = $date['goods_id'];
        $GoodInfo['content'] = $content;
        $GoodInfo['goods_info_id'] = md5($GoodInfo['goods_id'] . $GoodInfo['add_time'] . rand());
        
        $date['info_id'] = $GoodInfo['goods_info_id'];
        $result = $this -> add($date);
        
        if ($result) {
            $model = M('GoodsInfo');
            $result = $model -> add($GoodInfo);
            
            if ($result) {
                //添加了
                $result_info['result'] = 'success';
                $result_info['message'] = 'add goods true';
            } else {
                //失败了
                $result_info['result'] = 'error';
                $result_info['message'] = "no add goods";
            }
            
        } else {
            //失败了
            $result_info['result'] = 'error';
            $result_info['message'] = "no add goods";
        }
        
        if ($result) {
            //添加了
            $result_info['result'] = 'success';
            $result_info['message'] = 'add goods true';
        } else {
            //失败了
            $result_info['result'] = 'error';
            $result_info['message'] = "no add goods";
        }
        
        return $result_info;
    }
    
    public function saveDate($post, $file) {
        
        $date = $post;
        $content = $date['content'];
        unset($date['content']);
        
        if ($file != null) {
            //定义配置
            $cfg = array(
            //配置上传路径
            'rootPath' => WORKING_PATH . UPLOAD_ROOT_PATH);
            //实例化上传类
            $upload = new \Think\Upload($cfg);
            //开始上传
            $info = $upload -> upload($file);
            //判断是否上传成功
            if ($info) {
                
                if ($file['head_img']['error'] != 4) {
                    $head_img = $info['head_img'];
                    $date['head_img'] = UPLOAD_ROOT_PATH . $head_img['savepath'] . $head_img['savename'];
                }
                if ($file['head_lg_img']['error'] != 4) {
                    $head_lg_img = $info['head_lg_img'];
                    $date['head_lg_img'] = UPLOAD_ROOT_PATH . $head_lg_img['savepath'] . $head_lg_img['savename'];
                }
                
            }
        }
        
        $date['edit_time'] = time();
        $where['goods_id'] = $date['a_goods_id'];
        unset($date['a_goods_id']);
        $result = $this -> where($where) -> save($date);
        
        if ($result !== false) {
            //true
            
            $where['goods_info_id'] = $date['a_goods_info_id'];
            unset($date['a_goods_info_id']);
            
            $GoodInfo['content'] = $content;
            $model = M('GoodsInfo');
            $result = $model -> where($where) -> save($GoodInfo);
            
            if ($result !== false) {
                $result_info['result'] = 'success';
                $result_info['message'] = 'edit goods true';
            } else {
                
                //false
                $result_info['result'] = 'error';
                $result_info['message'] = "no edit goods";
                
            }
            
        } else {
            //false
            $result_info['result'] = 'error';
            $result_info['message'] = "no edit goods";
        }
        
        return $result_info;
    }
    
}
?>