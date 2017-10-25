<?php

namespace User\Controller;

use Think\Controller;

/**
 * +----------------------------------------------------------------------
 * time：2017年10月25日
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
		echo 111;
	
	}

	/**
	 * 验证用户登录信息
	 * 需要参数：
	 * user_id：用户账户
	 * user_pwd：用户密码
	 * user_code：用户验证码
	 */
	public function checkLogin() {
		$user_code = I ( 'post.user_code' );
		// 校验验证码（不需要传参）
		$verify = new \Think\Verify ();
		// 验证
		$result = $verify->check ( $user_code );
		if ($result) {
			// 如果验证码正确
			$post = I ( 'post.' );
			// 删除验证码
			unset ( $post ['user_code'] );
			// 创建用户表模型
			$model = M ( 'user' );
			// 查查有没有这个人
			$data = $model->where ( $post )->find ();
			// 判断是否存在用户
			
			if ($data) {
				// 这就存在了
				// 存在后用session保存这人信息
				session ( 'id', $data ['id'] );
				session ( 'user_id', $data ['user_id'] );
				session ( 'user_name', $data ['user_name'] );
				// 登录成功了，返回点什么，告诉前端都能成功了。
				$return_info ['result'] = 'success';
				$return_info ['message'] = 'login true';
				echo json_encode ( $return_info );
			} else {
				// 查无此人
				$return_info ['code'] = '2002';
				$return_info ['message'] = 'user Undefined';
				echo json_encode ( $return_info );
			}
		} else {
			// 验证码不正确
			$return_info ['result'] = '"error';
			$return_info ['message'] = 'user_code wrong';
			echo json_encode ( $return_info );
		}
	
	}

	/**
	 * 注册
	 */
	public function register() {
	
		/*
		 * 获取手机号
		 * 发送验证码
		 */
	}

	/**
	 * 获取验证码
	 */
	public function captcha() {
		
		// 验证码配置
		$cfg = array (
				'fontSize' => 12, // 验证码字体大小(px)
				'useCurve' => false, // 是否画混淆曲线
				'useNoise' => false, // 是否添加杂点
				'length' => 4, // 验证码位数
				'fontttf' => '4.ttf'  // 验证码字体，不设置随机获取
		);
		// 实例化验证码类
		$verify = new \Think\Verify ( $cfg );
		// 输出验证码
		$verify->entry ();
	
	}

}