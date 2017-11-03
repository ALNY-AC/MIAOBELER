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
        echo json_encode($result);
    }

    public function update() {

        $model = M('Tag');
        $id = I('post.id');
        $title = I('post.title');
        $add['id'] = $id;
        $add['title'] = $title;
        $result = $model -> add($add, null, true);
        echo json_encode($result);

    }

}
