<?php

namespace OpenApi;

include_once (__DIR__ . '/renrenSdk/RenrenRestApiService.class.php');
use OpenApi\renrenSdk\RenrenRestApiService;

class Renren {
	static public function redirect_uri($sourceUrl = NULL) {
		if (! $sourceUrl) {
			$sourceUrl = NOW_URL;
		}
		return url ( 'openApi/Login/Renren', array (
				's_url' => $sourceUrl 
		) );
	}
	static public function loginUrl($sourceUrl = NULL, $isRedirectUrl = false) {
		if (! $isRedirectUrl) {
			$redirect_uri = self::redirect_uri ( $sourceUrl );
		} else {
			$redirect_uri = $sourceUrl;
		}
		$params = array (
				'client_id' => config ( 'renren/Key', 'OpenApi' ),
				'redirect_uri' => $redirect_uri,
				'response_type' => 'code' 
		);
		return 'https://graph.renren.com/oauth/authorize?' . http_build_query ( $params );
	}
	static public function getAccessInfo($code, $sourceUrl, $isRedirectUrl = false) {
		if (! $isRedirectUrl) {
			$redirect_uri = self::redirect_uri ( $sourceUrl );
		} else {
			$redirect_uri = $sourceUrl;
		}
		$params = array (
				'client_id' => config ( 'renren/Key', 'OpenApi' ),
				'client_secret' => config ( 'renren/Secret', 'OpenApi' ),
				'redirect_uri' => $redirect_uri,
				'grant_type' => 'authorization_code',
				'code' => $code 
		);
		
		$token_url = 'https://graph.renren.com/oauth/token?' . http_build_query ( $params );
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $token_url );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		$response = curl_exec ( $ch );
		curl_close ( $ch );
		
		$response = json_decode ( $response, true );
		if (@ $response ['error']) {
			throw new \Exception ( implode ( ':', $response ) );
		} else {
			return $response;
		}
	}
	static public function getClient() {
		$renrenConfig = config ( 'renren', 'OpenApi' );
		$client = new RenrenRestApiService ( $renrenConfig ['Key'], $renrenConfig ['Secret'] );
		return $client;
	}
}