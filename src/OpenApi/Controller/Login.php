<?php

namespace OpenApi\Controller;

use Sys\Controller\Common as Controller;
use User\Model\U;
use OpenApi\Renren;
use OpenApi\Weibo;
use OpenApi\Model\Bind;

class Login extends Controller {
	/*
	 * renren授权操作
	 */
	public function actionRenren() {
		$sourceUrl = @ $_GET ['s_url'];
		$code = @ $_GET ['code'];
		
		if (! $code || ! $sourceUrl)
			exit ();
		
		$_SESSION['openApi_access_renren'] = $accessInfo = Renren::getAccessInfo ( $code, $sourceUrl );
		$userInfo = $accessInfo ['user'];
		$openId = (string) $userInfo ['id'];
		$userInfo['nickname'] = $userInfo['name'];
		$this->handle ( $openId, 'renren', $userInfo );
	}
	/*
	 * weibo授权操作
	 */
	public function actionWeibo() {
		$sourceUrl = @ $_GET ['s_url'];
		$code = @ $_GET ['code'];
		
		if (! $code || ! $sourceUrl)
			exit ();
		$_SESSION['openApi_access_weibo'] = $accessInfo = Weibo::getAccessInfo ( $code, $sourceUrl );
		// 还是用字符串吧，放心一点
		$openId = (string) $accessInfo ['uid'];
		$accessToken = $accessInfo ['access_token'];
		$client = Weibo::getClient ( $accessToken );
		
		$userInfo = $client->show_user_by_id ( $openId );
		$userInfo['nickname'] = $userInfo['name'];
		$this->handle ( $openId, 'weibo', $userInfo );
	}

	/*
	 * 处理授权后的操作
	 */
	public function handle($openid, $type, $userInfo) {
		$U = new U ();
		$mBind = new Bind ();
		$bindInfo = $mBind->findByOpenId ( $openid, $type );
		if (! $bindInfo) { // 如果未绑定			
			// 生成用户名
			$username = $openid . '@' . $type;
			$password = substr ( NOW_TIME, - 6 );
			$data = array (
					'username' => $username,
					'password' => $password,
					'nickname' => @ $userInfo['nickname'] ?: ''
			);
			
			// 注册，如果注册失败会抛异常，所以这里不需要判断是否成功
			// 禁止掉自动登录
			$userInfo = $U->reg ( $data, FALSE );
			
			$uid = $userInfo ['_id'];
			$bindData = array (
				'uid' => $uid,
				'openid' => $openid,
				'type' => $type,
				'info' => $userInfo 
			);
			
			$bindInfo = $mBind->insert ( $bindData );
		}
		
		$U->loginByUid ( $bindInfo ['uid'] );
		
		$url = @ $_GET ['s_url'] ?: \url('index/index/index');
		$this->goBack($url);
	}
}
