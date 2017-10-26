<?php

namespace User\Controller;

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
class LoginController extends Controller {

    /**
     * 验证用户登录信息
     * 需要参数：
     * user_id：用户账户
     * user_pwd：用户密码
     * user_code：用户验证码
     */
    public function checkLogin() {

        if (IS_POST) {
            $user_code = I('post.user_code');
            // 校验验证码（不需要传参）
            $verify = new \Think\Verify();
            // 验证
            $result = $verify -> check($user_code);
            if (!$result) {
                // 如果验证码正确
                $post = I('post.');
                // 删除验证码
                unset($post['user_code']);
                // 创建用户表模型
                $model = M('user');
                // 查查有没有这个人
                $map['user_id'] = $post['user_id'];
                // 判断是否存在用户
                $data = $model -> where($map) -> find();

                if ($data != null) {
                    // 这就存在了
                    // 存在后用session保存这人信息
                    //              session('id', $data['id']);
                    //              session('user_id', $data['user_id']);
                    //              session('user_name', $data['user_name']);
                    // 登录成功了，返回点什么，告诉前端都能成功了。
                    $user_info = array();
                    if ($data['user_pwd'] === $post['user_pwd']) {
                        //密码正确，登录成功

                        //头像
                        $user_info['head_img_url'] = $data['head_img_url'];
                        //个性签名
                        $user_info['user_info'] = $data['user_info'];
                        //昵称
                        $user_info['user_name'] = $data['user_name'];
                        //积分
                        $user_info['integral'] = $data['integral'];
                        //总消费
                        $user_info['consume_count'] = $data['consume_count'];

                        $date['last_time'] = time();
                        $result = $model -> where($map) -> save($date);

                        //  ==========
                        //  = 这里开始获取令牌 =
                        //  ==========

                        //先看看有没，
                        $model = M("token");
                        $result = $model -> where($map) -> find();
                        $date = array();

                        if ($result === null) {

                            /*
                             * 这里是没有令牌
                             * 就得add一个新的令牌
                             *
                             * 令牌生成算法：
                             *
                             * md5(user_id . md5(time()) . md5(KEY) . md5(rand()));
                             *
                             * */
                            $token = md5(user_id . md5(time()) . md5(KEY) . md5(rand()));
                            $date['token'] = $token;
                            $date['user_id'] = $map['user_id'];
                            $date['add_time'] = time();
                            $date['edit_time'] = time();

                            $result = $model -> add($date);
                            $user_info['token'] = $data['token'];

                        } else {
                            $token = md5(user_id . md5(time()) . md5(KEY) . md5(rand()));
                            $date['token'] = $token;
                            $date['edit_time'] = time();
                            $result = $model -> where($map) -> save($date);

                            $user_info['token'] = $token;

                        }
                        $return_info['result'] = 'success';
                        $return_info['message'] = $user_info;
                    } else {
                        //密码错误

                        $return_info['result'] = 'error';
                        $return_info['message'] = '-997';
                    }

                    if (I('get.test') === 'true') {
                        dump($return_info);
                    } else {
                        echo json_encode($return_info);
                    }

                } else {
                    // 查无此人
                    $return_info['code'] = 'error';
                    $return_info['message'] = '-998';
                    echo json_encode($return_info);
                }
            } else {
                // 验证码不正确
                $return_info['result'] = 'error';
                $return_info['message'] = '-999';
                echo json_encode($return_info);
            }
        }
    }

    /**
     * 注册*/
    public function register() {

        /*
         * 获取手机号
         * 发送验证码
         */
    }

}
