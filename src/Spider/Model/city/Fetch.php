<?php

namespace Spider\Model\city;

use Sys\Mongo\Collection;

class Fetch {
	protected $collection;
	public function __construct() {
		$this->collection = new Collection ( 'city' );
	}
	public function run() {
		//$this->fetchCharFromGanji ();die ();	//从赶集更新拼音
		
		$content = $this->curl ( 'http://www.sogou.com/quan?query=php&_asf=www.sogou.com&_ast=1366620736&w=01019900&qt=zhaopin&p=40040100#' );
		$fPosition = strpos ( $content, ';var O=[[' );
		$content = substr ( $content, $fPosition + 9 );
		$lPosition = strpos ( $content, ';var b;' );
		$content = substr ( $content, 0, $lPosition - 2 );
		$content = str_replace ( '"', '', $content ); // 去除“”
		$arr = explode ( '],[', $content );
		foreach ( $arr as $value ) {
			echo $value . '<br>';
			$strings = explode ( ',', $value );
			foreach ( $strings as $key => $string ) {
				if ($key == 0) {
					// echo $string;die();
					$this->getProvince ( $string );
					$fid = $this->findIdByName ( $string );
				} else {
					$this->getCity ( $string, $fid );
				}
			}
		}
	}
	protected function fetchCharFromGanji() {
		$content = $this->curl ( 'http://www.ganji.com/index.htm' );
		$strings = substr ( $content, strpos ( $content, '<dt>A</dt><dd>' ), strpos ( $content, '</dl>' ) - strpos ( $content, '<dt>A</dt><dd>' ) );
		preg_match_all ( "/<dd>(.*)<\/dd>/", $strings, $matches );
		$strings = $matches [0];
		// print_r($strings);
		foreach ( $strings as $key => $string ) {
			$arr = explode ( '> ', $string );
			foreach ( $arr as $val ) {
				$char = substr ( $val, strpos ( $val, '//' ) + 2, strpos ( $val, '.ganji' ) - strpos ( $val, '//' ) - 2 );
				$name = substr ( $val, strpos ( $val, '">' ) + 2, strpos ( $val, '</a' ) - strpos ( $val, '">' ) - 2 );
				//echo $char.$name.'<br>';
				$array = array (
						'$set' => array (
								'char' => $char 
						) 
				);
				$this->collection->update(array('name'=>$name), $array);//根据城市名更新拼音
			}
		}
	}
	protected function getProvince($name) { // 找到省份
		$data = array (
				'name' => ( string ) $name,
				'type' => 'province',
				'fid' => 0
		);
		$this->collection->insert ( $data );
	}
	protected function getCity($name, $fid) { // 找到城市
		$data = array (
				'name' => ( string ) $name,
				'type' => 'city',
				'fid' => $fid 
		);
		$this->collection->insert ( $data );
	}
	protected function findIdByName($name) { // 找到fid
		$res = $this->collection->findOne ( array (
				'name' => $name 
		) );
		return $res ['_id'];
	}
	protected function curl($url, $postData = array()) {
		// 启动CURL
		$hCURL = curl_init ( $url );
		// 设定HTTP链接超时时间
		curl_setopt ( $hCURL, CURLOPT_TIMEOUT, 120 );
		// 将HTTP返回的内容存到内存中，而不是直接输出
		curl_setopt ( $hCURL, CURLOPT_RETURNTRANSFER, TRUE );
		// 将HTTP访问的USERAGENT信息
		curl_setopt ( $hCURL, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0" );
		// 在HTTP请求头中"Referer: "的内容
		curl_setopt ( $hCURL, CURLOPT_REFERER, 'http://www.sogou.com/zhaopin' );
		// 根据Location，自动重定向访问
		curl_setopt ( $hCURL, CURLOPT_FOLLOWLOCATION, TRUE );
		// 根据Location:重定向时，自动设置header中的Referer:信息
		curl_setopt ( $hCURL, CURLOPT_AUTOREFERER, TRUE );
		// 设置GZIP压缩返回数据
		curl_setopt ( $hCURL, CURLOPT_ENCODING, "gzip,deflate" );
		if ($postData) {
			// 设置为POST方式
			curl_setopt ( $hCURL, CURLOPT_POST, 1 );
			// 设置为POST数据
			curl_setopt ( $hCURL, CURLOPT_POSTFIELDS, $postData );
		}
		
		// 设置cookies数据文件
		// $cookiefile = 'cookies.txt';
		// 请求链接时，将发送文件中的cookies数据
		// curl_setopt ( $hCURL, CURLOPT_COOKIEFILE, $cookiefile );
		// 结束链接时，将保存cookies数据到该文件
		// curl_setopt ( $hCURL, CURLOPT_COOKIEJAR, $cookiefile );
		
		// CURL执行访问，并返回服务器响应
		$sContent = curl_exec ( $hCURL );
		if ($sContent === FALSE) {
			$error = curl_error ( $hCURL );
			curl_close ( $hCURL );
			throw new \Exception ( $error . ' Url : ' . $url );
		} else {
			curl_close ( $hCURL );
			// $sContent = iconv ( 'GB2312', 'UTF-8//IGNORE', $sContent );
			return $sContent;
		}
	}
}