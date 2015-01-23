<?php

namespace OpenApi;

include_once (__DIR__ . '/weiboSdk/saetv2.ex.class.php');
use OpenApi\weiboSdk\SaeTOAuthV2;
use OpenApi\weiboSdk\SaeTClientV2;

class Weibo {
	static public function redirect_uri($sourceUrl = NULL) {
		if (! $sourceUrl) {
			$sourceUrl = NOW_URL;
		}
		return url ( 'openApi/Login/Weibo', array (
				's_url' => $sourceUrl 
		) );
	}
	static public function loginUrl($sourceUrl = NULL) {
		$redirect_uri = self::redirect_uri ( $sourceUrl );
		
		$params = array ();
		$params ['client_id'] = config ( 'weibo/AKey', 'OpenApi' );
		$params ['redirect_uri'] = $redirect_uri;
		$params ['response_type'] = 'code';
		$params ['state'] = NULL;
		$params ['display'] = NULL;
		return 'https://api.weibo.com/oauth2/authorize?' . http_build_query ( $params );
	}
	static public function getAuth() {
		$weiboConfig = config ( 'weibo', 'OpenApi' );
		$auth = new SaeTOAuthV2 ( $weiboConfig ['AKey'], $weiboConfig ['SKey'] );
		return $auth;
	}
	static public function getAccessInfo($code, $sourceUrl) {
		$accessToken = self::getAuth ()->getAccessToken ( 'code', array (
				'code' => $code,
				'redirect_uri' => self::redirect_uri ( $sourceUrl ) 
		) );
		return $accessToken;
	}
	static public function getClient($accessToken) {
		$weiboConfig = config ( 'weibo', 'OpenApi' );
		$client = new SaeTClientV2 ( $weiboConfig ['AKey'], $weiboConfig ['SKey'], $accessToken );
		return $client;
	}
}