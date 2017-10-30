<?php

namespace UserV0_1\Controller;
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
class GoodsController extends CommonController {

    /*通过关键字查找获取商品列表*/
    public function queryGoods() {

        if (IS_GET) {

            $goods_name_list = I('post.goods_name_list');

            $result_info = D('Goods') -> getGoodsLists('link', $goods_name_list);

            if (I('get.debug') === 'true') {
                dump($result_info);
            } else {
                echo json_encode($result_info);
            }

        } else {
            $result_info['code'] = 'error';
            $result_info['message'] = 'post false';
            echo json_encode($result_info);
        }

    }

    /*通过类别查找商品*/
    public function classGoods() {

        if (IS_GET) {

            $class_id = I('post.class_id');
            $result_info = D('Goods') -> getGoodsLists('class', $class_id);

            if (I('get.debug') === 'true') {
                dump($result_info);
            } else {
                echo json_encode($result_info);
            }

        } else {
            $result_info['code'] = 'error';
            $result_info['message'] = 'post false';
            echo json_encode($result_info);
        }

    }

    /*现价*/
    public function getGoddsPrice() {

        if (IS_POST) {

            $goods_id = I('post.goods_id');

            $result_info = D('Goods') -> getGoodsfield('price', $goods_id);

            if (I('get.debug') === 'true') {
                dump($result_info);
            } else {
                echo json_encode($result_info);
            }

        } else {
            $result_info['code'] = 'error';
            $result_info['message'] = 'post false';
            echo json_encode($result_info);
        }

    }

    /*原价*/
    public function getGoddsStrPrice() {

        if (IS_POST) {

            $goods_id = I('post.goods_id');

            $result_info = D('Goods') -> getGoodsfield('str_price', $goods_id);

            if (I('get.debug') === 'true') {
                dump($result_info);
            } else {
                echo json_encode($result_info);
            }

        } else {
            $result_info['code'] = 'error';
            $result_info['message'] = 'post false';
            echo json_encode($result_info);
        }

    }

    /*通过id获得商品积分*/
    public function getGoodsIntegral() {

        if (IS_POST) {

            $goods_id = I('post.goods_id');

            $result_info = D('Goods') -> getGoodsfield('integral', $goods_id);

            if (I('get.debug') === 'true') {
                dump($result_info);
            } else {
                echo json_encode($result_info);
            }

        } else {
            $result_info['code'] = 'error';
            $result_info['message'] = 'post false';
            echo json_encode($result_info);
        }

    }

    /**通过id获得商品*/
    public function getGoods() {

        if (IS_POST) {

            $goods_id = I('post.goods_id');

            $result_info = D('Goods') -> getGoods($goods_id);

            if (I('get.debug') === 'true') {
                dump($result_info);
            } else {
                echo json_encode($result_info);
            }

        } else {
            $result_info['code'] = 'error';
            $result_info['message'] = 'post false';
            echo json_encode($result_info);
        }

    }

}
