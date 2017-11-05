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
 * 标签控制器
 * @author 代马狮
 *
 */
class TagController extends CommonController {

    public function showList() {

        $this -> display();

    }

    public function getList() {
        $model = M('Tag');
        $result = $model -> select();

        if ($result !== false) {
            $result_info['result'] = 'success';
            $result_info['message'] = $result;
        } else {

            $result_info['result'] = 'error';
            $result_info['message'] = '';
        }
        echo json_encode($result_info);
    }

    public function add() {

        $model = M('Tag');
        $id = I('post.id');
        $title = I('post.title');
        $add['id'] = $id;
        $add['title'] = $title;
        $result = $model -> add($add);

        if ($result !== false) {
            $result_info['result'] = 'success';
            $result_info['message'] = $result;
        } else {

            $result_info['result'] = 'error';
            $result_info['message'] = '';
        }
        echo json_encode($result_info);
    }

    public function del() {

        $where['id'] = I('post.id');

        $model = M('Tag');
        $result = $model -> where($where) -> delete();

        if ($result !== false) {
            $result_info['result'] = 'success';
            $result_info['message'] = $result;
        } else {
            $result_info['result'] = 'error';
            $result_info['message'] = $sql;
        }
        echo json_encode($result_info);

    }

    public function save() {

        $model = M('Tag');
        $id = I('post.id');
        $title = I('post.title');
        $where['id'] = $id;
        $save['title'] = $title;
        $result = $model -> where($where) -> save($save);

        if ($result !== false) {
            $result_info['result'] = 'success';
            $result_info['message'] = $result;
        } else {

            $result_info['result'] = 'error';
            $result_info['message'] = '';
        }
        echo json_encode($result_info);
    }

}
