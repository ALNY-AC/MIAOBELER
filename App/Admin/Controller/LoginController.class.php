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
 * 登录控制器
 * @author 代马狮
 *
 */
class LoginController extends Controller {

    public function login() {

        if (IS_POST) {

            $post = I('post.');
            //校验验证码（不需要传参）
            $verify = new \Think\Verify();
            //验证
            $result = $verify -> check($post['captcha']);

            if ($result) {

                $where['admin_id'] = I('post.user_id');
                $model = M('admin');
                $result = $model -> where($where) -> find();

                if ($result['admin_pwd'] === I('post.user_pwd')) {

                    session('admin_id', $result['admin_id']);
                    $result_info['result'] = 'success';

                } else {
                    $result_info['result'] = 'error';
                    $result_info['message'] = '密码不正确！';
                }
            } else {
                $result_info['result'] = 'error';
                $result_info['message'] = '验证码不正确！';
            }
            echo json_encode($result_info);

        } else {
            $this -> display();

        }

    }

    public function captcha() {

        //验证码配置
        $cfg = array('fontSize' => 12, // 验证码字体大小(px)
        'useCurve' => false, // 是否画混淆曲线
        'useNoise' => false,
        // 是否添加杂点
        'length' => 4, // 验证码位数
        'fontttf' => '4.ttf', // 验证码字体，不设置随机获取
        );
        //实例化验证码类
        $verify = new \Think\Verify($cfg);
        //输出验证码
        $verify -> entry();

    }

}
