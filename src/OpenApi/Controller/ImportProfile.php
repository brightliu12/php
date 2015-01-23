<?php

namespace OpenApi\Controller;

use Sys\Controller\Common as Controller;
use User\Model\U;
use OpenApi\Renren;
use OpenApi\Weibo;
use Resume\Model\Resume;
use OpenApi\Model\Bind;

class ImportProfile extends Controller {
	public function actionRenren() {
		if (empty ( $_SESSION ['openApi_access_renren'] )) {
			$sourceUrl = \url('openApi/ImportProfile/renren');
			$code = @ $_GET ['code'];
			if ($code && $sourceUrl) {
				// 登录人人返回
				$_SESSION ['openApi_access_renren'] = $accessInfo = Renren::getAccessInfo ( $code, $sourceUrl, true);
			} else {
				$this->goBack ( Renren::loginUrl ($sourceUrl, true) );
				exit;
			}
		}
		
		$accessInfo = $_SESSION ['openApi_access_renren'];
		print_r($accessInfo);
		$openId = (string) $accessInfo ['user'] ['id'];

		$client = Renren::getClient();
		$fields = 'uid,name,sex,star,zidou,vip,birthday,hometown_location,work_info,university_info,hs_info';
		$fields = 'uid,name,sex,star,zidou,vip,birthday,tinyurl,headurl,mainurl,hometown_location,work_history,university_history';
		$params = array('uids'=>$openId,'fields'=>$fields,'access_token'=>$accessInfo['access_token']);//使用session_key调api的情况
		$userInfo = $client->rr_post_curl('users.getInfo', $params);
		echo '<pre>';
		print_r($userInfo);
		echo '</pre>';
		exit;
	}
	
	public function actionWeibo() {
		if (empty ( $_SESSION ['openApi_access_weibo'] )) {
			$sourceUrl = @ $_GET ['s_url'];
			$code = @ $_GET ['code'];
			if ($code && $sourceUrl) {
				$_SESSION ['openApi_access_weibo'] = $accessInfo = Weibo::getAccessInfo ( $code, $sourceUrl );
			} else {
				$this->goBack ( Weibo::loginUrl () );
			}
		} else {
			$client = Weibo::getClient ( $_SESSION ['openApi_access_weibo'] );
			$openId = $_SESSION ['openApi_access_weibo'] ['uid'];
			$userInfo = $client->show_user_by_id ( $openId );
			
			
// 			$cityList = $client->oauth->get('statuses/timeline_batch', array(
					
// 			));
			
			
			
			$U = new U ();
			$uid = $U->getUserId ();
			
			if (! $uid) {
				echo 'need uid';
				exit;
			}
			$mResume = new Resume ();
			$data = $mResume->findByUid ( $uid );
			if (! $data) {
				$data = $mResume->add ( $uid );
			}
			$rid = $data ['_id'];
			
			$info = array (
					'uid' => $uid,
					'rid' => $rid,
					'name' => $userInfo['name'],
					'sex' => $userInfo['gender'] == 'm' ? 'man' : 'woman',
					//'work_exp',
					'live_city' => $userInfo['location'],
					//'edu' 
			);
			$edu = array (
					'uid' => $uid,
					'rid' => $rid,
					'start_time',
					'end_time',
					'school',
					'major',
					'type',
					'describe' 
			);
			$exp = array (
					'uid' => $uid,
					'rid' => $rid,
					'start_time',
					'end_time',
					'company',
					'describe'
			);
		}
	}
}