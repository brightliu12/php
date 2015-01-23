<?php

/**
 * 当前访问者静态操作类
 */
namespace User\Model;

use Sys\Validator\Data as ValidatorData;
use Sys\Exception\Validate;

class U {
	
	/**
	 * 返回是否登录
	 */
	public function isLogin() {
		return ! empty ( $_SESSION ['user'] );
	}
	
	/**
	 * 注册
	 *
	 * @param array $user        	
	 */
	public function reg($data, $autoLogin = true) {
		$mUser = new User ();
		$user = $mUser->insert ( $data );
		if ($autoLogin) {
			$this->loginUser($user);
		}
		return $user;
	}
	
	/**
	 * 登录
	 *
	 * 查找User数据并放入SESSION中
	 *
	 * @param array $data        	
	 */
	public function login($data) {
		$validator = new ValidatorData ( 'email, password' );
		$validator->addRule ( '*', 'Required' );
		$validator->addRule ( 'email', 'Email' );
		$validator->addRule ( 'password', 'User:Password' );
		$validator->addRule ( 'email', 'MongoField', array ( // 检测用户名是否唯一
				'collection' => 'user',
				'field' => 'email',
				'isExists' => true,
				'messageTpl' => '该邮件不存在，请确认' 
		) );
		
		if ($validator->isValid ( $data )) {
			$email = $data ['email'];
			$password = $data ['password'];
			
			$mUser = new User ();
			$user = $mUser->findByEmail ( $email );
			
			if ($user ['password'] == md5 ( $password )) {
				$this->loginUser($user);
			} else {
				throw new Validate ( array (
						'password' => '密码错误，请重试' 
				), $data );
			}
		} else {
			throw new Validate ( $validator->getMessages (), $data );
		}
	}
	
	/**
	 * 登录操作
	 */
	protected function loginUser (array $user) {
		unset ( $user ['password'] );
		$_SESSION ['user'] = $user;
		$mUser = new User ();
		$mUser->updateLoginTime($user['_id']);
	}
	
	/*
	 * 通过uid登录
	 */
	public function loginByUid($uid) {
		$mUser = new User ();
		$user = $mUser->findById ( $uid );
		if ($user) {
			$this->loginUser($user);
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * 退出
	 *
	 * 只清除SESSION中的User数据，而不是清除整个SESSION。
	 * 因为可能需要在SESSION中存放一些用户操作的数据记录
	 */
	public function logout() {
		if ($this->isLogin ()) {
			unset ( $_SESSION ['user'] );
			unset ( $_SESSION ['userInfo'] );
			unset ( $_SESSION ['openApi_access_renren'] );
			unset ( $_SESSION ['openApi_access_weibo'] );
		}
	}
	
	/**
	 * 判断在登录状态下，返回SESSION中的用户信息
	 *
	 * @return array
	 */
	public function getUser() {
		return @$_SESSION ['user'];
	}
	/**
	 * 在用户登陆的情况下获取用户的id
	 */
	public function getUserId() {
		return @$_SESSION ['user'] ['_id'];
	}
	
	public function getNickName() {
		return @ $_SESSION ['user'] ['nickname'] ?: $_SESSION ['user'] ['email'];
	}
	/**
	 * 如果用户未登录返回NULL
	 *
	 * 如果用户登录了，查找返回用户资料数据，并缓存在SESSION中
	 */
// 	public function getUserInfo() {
// 		if (! empty ( $_SESSION ['userInfo'] )) {
// 			return $_SESSION ['userInfo'];
// 		}
		
// 		if ($this->isLogin ()) {
// 			$mUserInfo = new Info ();
// 			$userInfo = $mUserInfo->findByUid ( self::getUserId () );
// 			$_SESSION ['userInfo'] = $userInfo;
// 			return $_SESSION ['userInfo'];
// 		} else {
// 			return null;
// 		}
// 	}
}
