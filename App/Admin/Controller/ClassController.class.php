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

        } else {

            $this -> display();
        }

    }

    public function sortList() {

        $list = I('post.list');

        $model = M('Class');
        $result = $model -> addAll($list, null, true);
        dump($model -> _sql());
        dump($result);
    }

    public function edit() {
        $where['class_id'] = I('post.class_id');
        $save['title'] = I('post.title');
        $save['sort'] = I('post.sort');
        $model = M('Class');
        $result = $model -> where($where) -> save($save);
        dump($result);
    }

    public function add() {

        $date = I('post.addDate');
        $model = M('Class');
        $result = $model -> add($date);
        dump($result);
    }

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

    public function remove() {

        $where['class_id'] = I('get.class_id');

        $model = M('Class');
        $result = $model -> where($where) -> delete();

        if (I('get.level') == '1') {

            $where2['super_id'] = I('get.class_id');

            $result = $model -> where($where2) -> delete();

        }

    }

}
