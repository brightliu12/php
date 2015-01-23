<?php

namespace Spider\Model\sogou;

use Sys\Mongo\Collection;
use Sys\Validate;
use Sys\Filter;

class Fetch {
	protected $collection;
	protected $vRuleInsert = array (
			array (
					'keyword, url, page',
					'required' 
			) 
	);
	public function __construct() {
		$this->colContent = new Collection ( 'spider.sogou.content' );
		$this->colContent->ensureIndex ( array (
				'url' => 1 
		), array (
				"unique" => true 
		) );
	}
	public function init() {
		if (! $this->colContent->count ()) {
			/**
			 * 添加热门职位
			 */
			echo "添加热门职位\n";
			$mKeyword = new Keyword ();
			$mKeyword->add ( '司机' );
			$mKeyword->add ( '兼职' );
			$mKeyword->add ( '会计' );
			$mKeyword->add ( '销售' );
			$mKeyword->add ( '工程师' );
		}
	}
	public function insert($keyword, $page) {
		$data = array (
				'keyword' => $keyword,
				'page' => $page,
				'url' => 'http://job.vr.sogou.com/job?&ie=utf8&page=' . $page . '&query=' . urlencode ( $keyword ) . '&rnd=1365758745484000604' 
		);
		
		if (Validate::all ( $data, $this->vRuleInsert )) {
			$data = array_merge ( $data, array (
					'isFetch' => false,
					'isParse' => false,
					'insertTime' => time () 
			) );
			try {
				$this->colContent->insert ( $data );
			} catch ( \MongoException $e ) {
				throw $e;
			}
		} else {
			echo "数据验证错误";
			echo Validate::$errorField . "\n";
			var_dump ( $data );
			die ();
		}
	}
	public function run() {
		$row = $this->colContent->findOne ( array (
				'isFetch' => false 
		) );
		if ($row) {
			$row ['content'] = $this->curl ( $row ['url'] );
			$row ['isFetch'] = true;
			$this->colContent->save ( $row );
		}
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
			$sContent = iconv ( 'GB2312', 'UTF-8//IGNORE', $sContent );
			return $sContent;
		}
	}
}