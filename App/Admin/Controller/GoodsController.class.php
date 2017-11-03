<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends CommonController {

    public function getOne() {

        $where['goods_id'] = I('get.goods_id');

        $model = M('Goods');
        $result_info = $model -> where($where) -> find();

        echo json_encode($result_info);

    }

    public function add() {
        if (!IS_POST) {
            //显示
            $model = M('Class');
            $result = $model -> select();
            $typeList = json_encode($result);

            $this -> assign('typeList', $typeList);
            $this -> display();

        } else {
            //添加
            $model = D('Goods');

            $result_info = $model -> addDate(I('post.'), $_FILES);

            if ($result_info['result'] != 'error') {
                $this -> assign('go_url', U('add'));
                $this -> assign('isgo', '添加');
                $this -> assign('info', '添加成功');
                $this -> display('j');
            } else {
                echo '添加出错';
            }

        }

    }

    public function showList() {

        if (IS_POST) {

        } else {

            $model = M('Goods');

            //          SELECT t1.*,t2.title FROM mia_goods as t1,mia_class as t2 WHERE (t1.class_id = t2.class_id)

            $result = $model -> field('t1.*,t2.title as class_title') -> table('mia_goods as t1,mia_class as t2') -> where('t1.class_id = t2.class_id') -> select();

            $this -> assign('goodsList', $result);
            $this -> assign('count', 1);
            $this -> display();

        }
    }

    public function edit() {

        if (IS_POST) {

            $model = D('Goods');
            $result_info = $model -> saveDate(I('post.'), $_FILES);

            if ($result_info['result'] != 'error') {

                $this -> assign('go_url', U('edit', array('goods_id' => I('post.a_goods_id'))));
                $this -> assign('isgo', '修改');
                $this -> assign('info', '修改成功');
                $this -> display('j');
            } else {
                echo '修改出错';
            }

        } else {

            if (!empty(I('get.goods_id'))) {

                //SELECT t1.*,t2.content FROM mia_goods as t1,mia_goods_info as t2 WHERE (t1.info_id = t2.goods_info_id)
                $model = M('Goods');
                $goods_id = I('get.goods_id');
                $result = $model -> field('t1.*,t2.content') -> table('mia_goods as t1,mia_goods_info as t2') -> where("t1.info_id = t2.goods_info_id AND t1.goods_id = '$goods_id' ") -> find();
                $this -> assign('date', $result);

                //SELECT t1.*,t2.title as super_title  FROM mia_class as t1,mia_class as t2 WHERE (t1.super_id = t2.class_id AND t1.class_id='ghi')
                $model = M('Class');
                $where['class_id'] = $result['class_id'];
                $result = $model -> where($where) -> find();
                $this -> assign('class', $result);

                $this -> assign('goods_id', $goods_id);
                $this -> display();

            } else {
                echo "未传入id！";
            }
        }
    }

    public function remove() {

        if (!empty(I('get.goods_id'))) {

            $model = M('Goods');
            $where['goods_id'] = I('get.goods_id');
            $result = $model -> where($where) -> delete();

            $model = M('GoodsInfo');
            $result = $model -> where($where) -> delete();
            echo "删了";
        } else {
            echo "未传入id！";
        }

    }

    public function removes() {

        if (!empty(I('post.goods_id'))) {

            $goods_id = I('post.goods_id');
            $where = "goods_id in($goods_id)";
            $model = M('Goods');
            $result = $model -> where($where) -> delete();
            //  ==========
            //  = 删除详情页 =
            //  ==========
            $model = M('GoodsInfo');
            $result = $model -> where($where) -> delete();

            $result_info['result'] = 'success';
            $result_info['message'] = "删了{$result}条数据";
            echo json_encode($result_info);
        } else {
            $result_info['result'] = 'error';
            echo json_encode($result_info);

        }

    }

    public function show() {

        $model = M('Goods');
        $where['goods_id'] = I('get.goods_id');
        $date['is_show'] = '1';
        $result = $model -> where($where) -> save($date);
        echo 'show';

    }

    public function hide() {

        $model = M('Goods');
        $where['goods_id'] = I('get.goods_id');
        $date['is_show'] = '0';
        $result = $model -> where($where) -> save($date);
        echo 'hide';

    }

    public function shows() {


        if (!empty(I('post.goods_id'))) {

            $goods_id = I('post.goods_id');
            $where = "goods_id in($goods_id) AND is_show = 0";
            $model = M('Goods');

            $date['is_show'] = '1';
            $result = $model -> where($where) -> save($date);

            $result_info['result'] = 'success';
            $result_info['message'] = "$result";
            echo json_encode($result_info);

        } else {

            $result_info['result'] = 'error';
            echo json_encode($result_info);

        }

    }

    public function hides() {

        if (!empty(I('post.goods_id'))) {

            $goods_id = I('post.goods_id');
            $where = "goods_id in($goods_id) AND is_show = 1";
            $model = M('Goods');

            $date['is_show'] = '0';
            $result = $model -> where($where) -> save($date);

            $result_info['result'] = 'success';
            $result_info['message'] = "$result";
            echo json_encode($result_info);

        } else {

            $result_info['result'] = 'error';
            echo json_encode($result_info);

        }

    }

}
