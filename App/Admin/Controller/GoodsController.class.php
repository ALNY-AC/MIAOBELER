<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends CommonController {

    public function add() {

        if (!IS_POST) {
            $model = M('Class');
            $result = $model -> select();
            $typeList = json_encode($result);
            $this -> assign('typeList', $typeList);
            $this -> display();
        } else {

            $model = D('Goods');

            $result_info = $model -> addDate(I('post.'), $_FILES);

            echo json_encode($result_info);
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
            echo json_encode($result_info);

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

            dump($where);

            $model = M('GoodsInfo');
            $result = $model -> where($where) -> delete();
            dump($where);
            echo "删了";
        } else {
            echo "未传入id！";
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

}
