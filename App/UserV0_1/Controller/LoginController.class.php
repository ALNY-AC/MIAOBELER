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
class LoginController extends Controller {

    /**
     * 验证用户登录信息
     * 需要参数：
     * user_id：用户账户
     * user_pwd：用户密码
     * user_code：用户验证码
     */
    public function login2() {

        if (IS_POST) {

            session('user_id', I('post.user_id'));
            return;

            $user_code = I('post.user_code');
            // 校验验证码（不需要传参）
            $verify = new \Think\Verify();
            // 验证
            $result = $verify -> check($user_code);

            if ($result) {
                // 如果验证码正确
                $post = I('post.');
                // 删除验证码
                unset($post['user_code']);

                // 创建用户表模型
                $model = M('User');
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
                            $token = md5($user_id . md5(time()) . md5(KEY) . md5(rand()));
                            $date['token'] = $token;
                            $date['user_id'] = $map['user_id'];
                            $date['add_time'] = time();
                            $date['edit_time'] = time();

                            $result = $model -> add($date);
                            $user_info['token'] = $data['token'];

                        } else {
                            $token = md5($user_id . md5(time()) . md5(KEY) . md5(rand()));
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
                        $return_info['message'] = 'user_pwd false';
                    }

                    if (I('get.debug') === 'true') {
                        dump($return_info);
                    } else {
                        echo json_encode($return_info);
                    }

                } else {
                    // 查无此人
                    $return_info['code'] = 'error';
                    $return_info['message'] = 'user_id null';
                    echo json_encode($return_info);
                }
            } else {
                // 验证码不正确
                $return_info['result'] = 'error';
                $return_info['message'] = 'user code false';
                echo json_encode($return_info);
            }
        }
    }

    public function getCode() {

        // 414022565
        // lifei1987219

        $code = rand(1000, 9999);
        $user_id = I('post.user_id');
        F($user_id . 'code', $code);

        // $result_info['result']='success';
        // $result_info['message']=$code;

        // echo json_encode($result_info);

        // $username = "test";         //帐号
        // $password = "111" ;         //密码
        // $mobiles  = "13939393939";  //号码
        $content = "验证码" . $code . "【妙贝尔】";
        //内容

        // $time=time('yyyy-MM-dd HH:mm:ss');
        $time = date('Y-m-d H:m:s');

        $username = urlencode(trim('414022565'));
        $password = urlencode(md5(trim('lifei1987219') . $time));
        $mobiles = trim($user_id);
        //$content=urlencode(iconv( "UTF-8", "gb2312//IGNORE" , trim($_REQUEST["contents"])));

        $content = urlencode(mb_convert_encoding(trim($content), "gb2312", "utf-8"));

        $time = urlencode($time);

        $fp = Fopen("http://api.sms1086.com/api/Send.aspx?username=$username&password=$password&mobiles=$mobiles&content=$content&timestamp=$time", "r");
        $ret = fgetss($fp, 255);

        echo '<p>' . urldecode($ret) . '</p>';
        echo '<p>' . $code . '</p>';
        echo '<p>如果result=20，请输入上面的验证码登录</p>';

        Fclose($fp);

    }

    public function login() {
        $user_id = I('post.user_id');
        $user_code = I('post.user_code');
        $code = F($user_id . 'code');

        if ($user_code == $code) {
            //验证码正确
            //  ==========
            //  = 这里开始获取令牌 =
            //  ==========

            //先看看有没，

            $map['user_id'] = $user_id;
            //先看看user有没有

            $m = M('user');
            $result = $m -> where($map) -> find();
            $token = md5($user_id . md5(time()) . md5(KEY) . md5(rand()));

            if ($result === null) {
                //没有用户，添加用户
                $add['user_id'] = $user_id;
                $add['user_name'] = $user_id;
                $add['token'] = $token;
                $add['add_time'] = time();
                $add['last_time'] = time();
                $result = $m -> add($add);
            } else {
                //有用户，更新字段
                $save['token'] = $token;
                $save['last_time'] = time();
                $result = $m -> where($map) -> save($save);
            }

            $result_info['result'] = 'success';
            $result_info['message'] = $token;

        } else {

            $result_info['result'] = 'error';
            $result_info['message'] = '验证码不正确';

        }

        // $code = F($user_id.'code',null);
        echo json_encode($result_info);

    }

    /**
     * 验证令牌
     */

    public function isLogin() {

        $token = I('post.token');

        $model = M('user');
        $where['token'] = $token;
        $result = $model -> where($where) -> find();

        if ($result !== null) {
            //有
            $result_info['result'] = 'success';
            $result_info['message'] = 'true';

        } else {
            //没有
            $result_info['result'] = 'error';
            $result_info['message'] = 'false';
        }
        echo json_encode($result_info);

    }

    public function sinOut() {

        session('user_id', null);

    }

}
