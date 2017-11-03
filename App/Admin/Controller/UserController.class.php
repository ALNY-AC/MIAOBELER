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
 * 用户控制器
 * @author 代马狮
 *
 */
class UserController extends CommonController {

    /**
     * 显示用户列表
     * */
    public function showList() {

        $model = M('user');
        $result = $model -> select();
        $this -> assign('user_info', $result);
        $this -> display();

    }

    public function getList() {

        $model = M('user');
        $result = $model -> select();

        $date['status'] = 200;
        $date['hint'] = '';
        $date['total'] = 1000;
        $date['rows'] = $result;

        echo json_encode($date);

    }

    public function eidt() {

        echo 'edit';
    }

    /**
     * 添加用户
     * */
    public function add() {

        echo 'add';

    }

    /**
     * 删除多个
     * */
    public function delAll() {

    }

    /**修改某个字段*/
    public function update() {

        $model = D('Currency');
        dump($model);
        die ;
        $model -> u('user', I('post.data'));

        //      $model = M('User');
        //      $where['user_id'] = I('post.user_id');
        //      $save = I('post.save');
        //      $result = $model -> where($where) -> save($save);
    }

    /**
     * 删除单个
     * */
    public function del() {

        if (!empty(I('post.user_id'))) {

            $model = M('User');
            $where['user_id'] = I('post.user_id');
            $result = $model -> where($where) -> delete();

            //收藏表删除：
            //          $model = M('GoodsInfo');
            //          $result = $model -> where($where) -> delete();
            echo "删了";
        } else {
            echo "未传入id！";
        }

    }

    /**
     * 修改用户的数据，可以多个，也可以单个,但必须是数组
     * */
    public function updateAll() {

    }

    /**切换*/
    public function toggleBan() {
        $model = M('user');
        $where['user_id'] = I('get.user_id');
        $result = $model -> field('is_ban') -> where($where) -> find();
        $is_ban = $result['is_ban'];

        $result = $model -> where($where) -> setField('is_ban', !$is_ban);
    }

    /**切换*/
    public function toggleBanAll() {

        $user_ids = I('post.user_id');

        $where = "user_id in($user_ids)";
        $model = M('User');
        $save['is_ban'] = I('post.is_ban');
        $result = $model -> where($where) -> save($save);

        $result_info['result'] = 'success';
        $result_info['message'] = "$result";
        echo json_encode($result_info);
    }

}
