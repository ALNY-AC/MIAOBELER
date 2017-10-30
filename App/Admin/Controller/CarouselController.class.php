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

        if (IS_POST) {
            $id = I('post.id');
            $img_id = I('post.img_id');
            $a_url = I('post.a_url_' . $id);

            F("Carousel/a_url_$id", $a_url);

            $file = $_FILES[$img_id];
            $img_url;

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
                    F("Carousel/$img_id", $img_url);

                }

            }
            $this -> assign('img1', F("Carousel/img1"));
            $this -> assign('img2', F("Carousel/img2"));
            $this -> assign('img3', F("Carousel/img3"));
            $this -> assign('img4', F("Carousel/img4"));
            //  ==========
            //  = Banner =
            //  ==========
            $this -> assign('a_url_1', F("Carousel/a_url_1"));
            $this -> assign('a_url_2', F("Carousel/a_url_2"));
            $this -> assign('a_url_3', F("Carousel/a_url_3"));
            $this -> assign('a_url_4', F("Carousel/a_url_4"));

            $this -> display();

        } else {

            $this -> assign('img1', F("Carousel/img1"));
            $this -> assign('img2', F("Carousel/img2"));
            $this -> assign('img3', F("Carousel/img3"));
            $this -> assign('img4', F("Carousel/img4"));
            //  ==========
            //  = Banner =
            //  ==========
            $this -> assign('a_url_1', F("Carousel/a_url_1"));
            $this -> assign('a_url_2', F("Carousel/a_url_2"));
            $this -> assign('a_url_3', F("Carousel/a_url_3"));
            $this -> assign('a_url_4', F("Carousel/a_url_4"));
            $this -> display();
        }

    }

}
