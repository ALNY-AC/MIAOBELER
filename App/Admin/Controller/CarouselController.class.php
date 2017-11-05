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
 * 轮播图控制器
 * @author 代马狮
 *
 */
class CarouselController extends CommonController {
    public function showList() {
        $model = M('Carousel');
        if (IS_POST) {
            $id = I('post.id');
            $a_url = I('post.a_url');

            $save['a_url'] = $a_url;

            if (empty($a_url)) {
                $save['a_url'] = null;

            } else {
                $save['a_url'] = $a_url;

            }

            $file = $_FILES['img'];

            if (!$file['error']) {
                //定义配置
                $cfg = array(
                    //配置上传路径
                    'rootPath' => WORKING_PATH . UPLOAD_ROOT_PATH);
                //实例化上传类
                $upload = new \Think\Upload($cfg);
                //开始上传
                $info = $upload -> uploadOne($file);
                //判断是否上传成功
                if ($info) {
                    //图片地址
                    $img_url = UPLOAD_ROOT_PATH . $info['savepath'] . $info['savename'];
                    $save['img'] = $img_url;
                }

            }
            //  ==========
            //  = 保存数据 =
            //  ==========
            $where['carousel_id'] = $id;
            $model -> where($where) -> save($save);
        }
        //  ==========
        //  = 显示 =
        //  ==========
        $result = $model -> select();
        $this -> assign('carousel', $result);
        $this -> display();

    }

    public function save() {

        if (IS_POST) {
            $model = M('Carousel');

            $where['carousel_id'] = I('post.carousel_id');
            $save['a_url'] = I('post.a_url');
            $save['img'] = I('post.img');
            $save['sort'] = I('post.sort');
            $result = $model -> where($where) -> save($save);

            if ($result !== false) {
                $result_info['result'] = 'success';
                $result_info['message'] = $result;
            } else {
                $result_info['result'] = 'error';
                $result_info['message'] = '保存失败！';
            }

        } else {
            $result_info['result'] = 'error';
            $result_info['message'] = '请用post！';
        }
        echo json_encode($result_info);

    }

    public function add() {

        if (IS_POST) {
            $model = M('Carousel');
            $add['a_url'] = I('post.a_url');
            $add['img'] = I('post.img');
            $add['sort'] = I('post.sort');
            $result = $model -> add($add);

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

    public function get() {
        $model = M('Carousel');
        $result = $model -> order('sort asc') -> select();
        if ($result !== false) {
            $result_info['result'] = 'success';
            $result_info['message'] = $result;
        } else {

            $result_info['result'] = 'error';
            $result_info['message'] = $result;

        }
        echo json_encode($result_info);

    }

    public function del() {

        $model = M('Carousel');
        $where['carousel_id'] = I('post.carousel_id');
        $result = $model -> where($where) -> find();
        $img = $result['img'];
        unlink($result['img']);

        $result = $model -> where($where) -> delete();

        if ($result !== false) {
            $result_info['result'] = 'success';
            $result_info['message'] = $img;
        } else {

            $result_info['result'] = 'error';
            $result_info['message'] = $result;

        }
        echo json_encode($result_info);

    }

    public function sortList() {

        $list = I('post.list');

        $model = M('Carousel');
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

}
