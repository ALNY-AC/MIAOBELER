<?php

namespace Admin\Controller;
use Think\Controller;

/**
 * +----------------------------------------------------------------------
 * 创建日期：2017年11月4日
 * +----------------------------------------------------------------------
 * https：//github.com/ALNY-AC
 * +----------------------------------------------------------------------
 * weixin：AJS0314
 * +----------------------------------------------------------------------
 * 首页推荐控制器
 * @author 代码狮
 *
 */
class RecommendController extends CommonController {

    /**获得首页推荐列表*/
    public function get() {

        $model = M();

        $model = M();
        $result = $model -> field('t1.*,t2.goods_id,t2.title,t2.price,t2.str_price,t2.head_img') -> table('mia_recommend as t1,mia_goods as t2') -> where('t1.goods_id = t2.goods_id') -> order('t1.sort asc') -> select();

        $sql = $model -> _sql();

        if ($result !== false) {
            $result_info['result'] = 'success';
            $result_info['message'] = $result;
            $result_info['sql'] = $sql;
        } else {

            $result_info['result'] = 'error';
            $result_info['message'] = $sql;
        }
        echo json_encode($result_info);

    }

    /**添加一个首页推荐*/
    public function add() {

        if (IS_POST) {
            $model = M('Goods');

            $where['goods_id'] = I('post.goods_id');

            /**
             * 先查找商品
             *
             * */

            $result = $model -> where($where) -> find();
            if ($result !== null) {
                /**
                 * 再找找推荐里面有没有
                 * 要是有就不添加了
                 * */

                $model = M('Recommend');

                $result = $model -> where($where) -> find();

                if ($result === null) {

                    $result = $model -> add($where);
                    if ($result !== false) {
                        $result_info['result'] = 'success';
                        $result_info['message'] = 'add true';
                    } else {
                        $result_info['result'] = 'error';
                        $result_info['message'] = 'add false';
                    }

                } else {
                    $result_info['result'] = 'error';
                    $result_info['message'] = 'goods not null';
                }

            } else {
                $result_info['result'] = 'error';
                $result_info['message'] = 'goods_id false';
            }

        } else {
            $result_info['result'] = 'error';
            $result_info['message'] = '请用post！';
        }
        echo json_encode($result_info);

    }

    /**修改一个首页推荐*/
    public function edit() {

        if (IS_POST) {
            $model = M('Recommend');
            $add['goods_id'] = I('post.goods_id');
            $add['sort'] = I('post.sort');
            $add['id'] = I('post.id');
            $result = $model -> where($where) -> save($save);

            if ($result !== false) {
                $result_info['result'] = 'success';
                $result_info['message'] = $result;
            } else {
                $result_info['result'] = 'error';
                $result_info['message'] = '上传失败！';
            }

        } else {
            $result_info['result'] = 'error';
            $result_info['message'] = '请用post！';
        }
        echo json_encode($result_info);

    }

    /**对首页推荐排序*/
    public function sortList() {

        $list = I('post.list');

        $model = M('Recommend');
        $result = $model -> addAll($list, null, true);

        if ($result !== false) {
            $result_info['result'] = 'success';
            $result_info['message'] = $result;
        } else {

            $result_info['result'] = 'error';
            $result_info['message'] = $result;

        }

        echo json_encode($result_info);

    }

    /**删除一个首页推荐*/
    public function del() {

        $model = M('Recommend');
        $where['id'] = I('post.id');

        $result = $model -> where($where) -> delete();

        if ($result !== false) {
            $result_info['result'] = 'success';
            $result_info['message'] = $result;
        } else {

            $result_info['result'] = 'error';
            $result_info['message'] = $result;

        }
        echo json_encode($result_info);

    }

}
