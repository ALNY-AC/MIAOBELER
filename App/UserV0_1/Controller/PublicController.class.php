<?php

namespace UserV0_1\Controller;

use Think\Controller;

/**
 * +----------------------------------------------------------------------
 * 创建日期：2017年10月25日
 * +----------------------------------------------------------------------
 * https：//github.com/ALNY-AC
 * +----------------------------------------------------------------------
 * weixin：AJS0314
 * +----------------------------------------------------------------------
 *
 * @author 代马狮
 *
 */
class PublicController extends Controller {

    public function test() {

        if (IS_POST) {
            $return_info['result'] = I('post.id');
            $return_info['message'] = 'login true';
            echo json_encode($return_info);

        } else {

            $return_info['result'] = 'success';
            $return_info['message'] = 'login true';
            echo json_encode($return_info);

        }

    }

    /**
     * 获取验证码
     */
    public function captcha() {

        // 验证码配置
        $cfg = array('fontSize' => 12, // 验证码字体大小(px)
        'useCurve' => false, // 是否画混淆曲线
        'useNoise' => false, // 是否添加杂点
        'length' => 2, // 验证码位数
        'fontttf' => '4.ttf', // 验证码字体，不设置随机获取
        );
        // 实例化验证码类
        $verify = new \Think\Verify($cfg);
        // 输出验证码
        $verify -> entry();

    }

}
