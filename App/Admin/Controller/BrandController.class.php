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
class BrandController extends CommonController {
    public function showList() {
        $this -> display();
    }

    public function upFile() {

        $file = $_FILES['file'];

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

                $result['code'] = 0;
                $result['msg'] = '成功';
                $result['data'] = array();
                $result['data']['src'] = $img_url;
                echo json_encode($result);
            }

        }

    }

}
