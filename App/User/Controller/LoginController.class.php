<?php

namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller {

	public function login() {
	
	}

	/**
	 * 验证用户登录信息
	 * 需要参数：
	 * user_id：用户账户
	 * user_pwd：用户密码
	 * user_code：用户验证码
	 */
	public function validate() {
		$user_id = I ( 'post.user_id' );
		$user_pwd = I ( 'post.user_pwd' );
		$user_code = I ( 'post.user_code' );
		
		if ($user_code) {
			
		}
	
	}

}