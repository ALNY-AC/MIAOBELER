<?php

namespace User\Controller;

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
class GoodsController extends Controller {

    /*获取商品列表*/
    public function queryGoods() {

        $goods_name_list = I('post.goods_name_list');

        $map['title'] = array('like', $goods_name_list, 'OR');

        $model = M('goods');
        $result = $model -> where($map) -> select();

        if ($result) {
            //找到了
            $return_info['result'] = 'success';
            $return_info['message'] = $result;
            if (I('get.test') === 'true') {
                dump($model -> _sql());
                dump($return_info);
            } else {
                echo json_encode($return_info);
            }

        } else {
            //找不到
            $return_info['code'] = 'error';
            $return_info['message'] = '搜不到';
            echo json_encode($return_info);
        }

    }

    /*通过类别查找商品*/
    public function classGoods() {

        $class_id = I('post.class_id');

        $map['class_id'] = $class_id;

        $model = M('goods');
        $result = $model -> where($map) -> select();

        if ($result) {
            $return_info['result'] = 'success';
            $return_info['message'] = $result;
            if (I('get.test') === 'true') {
                dump($model -> _sql());
                dump($return_info);
            } else {
                echo json_encode($return_info);
            }

        } else {
            $return_info['code'] = 'error';
            $return_info['message'] = '没有此类型的商品';
            echo json_encode($return_info);
        }

    }

    /*详情页*/
    public function getGoodsInfo() {

        $goods_id = I('post.goods_id');

        $map['goods_id'] = $goods_id;

        $model = M('goods_info');
        $result = $model -> where($map) -> find();

        if ($result !== null) {
            $return_info['result'] = 'success';
            $return_info['message'] = $result;
            if (I('get.test') === 'true') {
                dump($model -> _sql());
                dump($return_info);
            } else {
                echo json_encode($return_info);
            }

        } else {
            $return_info['code'] = 'error';
            $return_info['message'] = '未添加详情页';
            echo json_encode($return_info);
        }

    }

    /*通过id获得商品积分*/
    public function getGoodsIntegral() {

        $goods_id = I('post.goods_id');

        $map['goods_id'] = $goods_id;

        $model = M('goods');
        $result = $model -> field('integral') -> where($map) -> find();

        if ($result) {
            //找到了
            $return_info['result'] = 'success';
            $return_info['message'] = $result;
            if (I('get.test') === 'true') {
                dump($model -> _sql());
                dump($return_info);
            } else {
                echo json_encode($return_info);
            }
`
        } else {
            //找不到
            $return_info['code'] = 'error';
            $return_info['message'] = '没有积分';
            echo json_encode($return_info);
        }

    }

}
