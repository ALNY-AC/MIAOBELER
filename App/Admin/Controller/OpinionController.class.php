<?php

namespace Admin\Controller;
use Think\Controller;

/**
 * +----------------------------------------------------------------------
 * 创建日期：2017年10月30日
 * +----------------------------------------------------------------------
 * https：//github.com/ALNY-AC
 * +----------------------------------------------------------------------
 * weixin：AJS0314
 * +----------------------------------------------------------------------
 * 用户反馈管理控制器
 * @author 代马狮
 *
 */
class OpinionController extends CommonController {

    /**
     * 显示列表
     */
    public function showList() {
        $where;
        $model = M('Opinion');

        if (!empty(I('get.where'))) {

            $where['state'] = I('get.where');
            $result = $model -> where($where) -> select();
            $this -> assign('isWhere', true);
        } else {
            $result = $model -> select();

        }

        $this -> assign('OpinionList', $result);
        $this -> display();

    }

    public function up() {

        $model = M('Opinion');
        $where['opinion_id'] = I('get.opinion_id');
        $save['state'] = I('get.state');
        $result = $model -> where($where) -> save($save);

        //  ==========
        //  = Banner =
        //  ==========
        $result = $model -> select();
        $this -> assign('OpinionList', $result);

        $this -> display('showList');

    }

}
