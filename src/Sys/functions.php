<?php
/**
 * 系统常用函数
 */

/**
 * 获取配置参数
 */
function config ($pos, $file = 'Sys') {
	static $cache = array();
	if (! isset($cache [$file])) {
		$cache [$file] = require PATH_CONFIG . $file . '.php';
	}
	if (strpos($pos, '/') === FALSE) {
		return @ $cache [$file] [$pos];
	} else {
		$target = $cache [$file];
		foreach (explode('/', $pos) as $key) {
			if (isset($target [$key])) {
				$target = $target [$key];
			} else {
				break;
			}
		}
		return $target;
	}
}

/**
 * 全局组件
 */
function cmp($name, $object = NULL) {
	static $cache = array ();
	if ($object) {
		$cache [$name] = $object;
	}
	return @ $cache [$name];
}

/**
 * 获取模型,在跨模块调用模型的时候会比较方便
 *
 * 第一个参数为模型名	$module:$model
 *
 * 后面的参数实例参数
 */
function model() {
	$args = func_get_args ();
	if (empty ( $args )) {
		return NULL;
	}
	$modelName = array_shift ( $args );
	if (strpos ( $modelName, ':' )) {
		list ( $moduleName, $modelName ) = explode ( ':', $modelName );
		$class = $moduleName . '\\Model\\' . $modelName;
	} else {
		$class = $modelName;
	}
	if ($args) {
		$ref = new ReflectionClass ( $class );
		return $ref->newInstanceArgs ( $args );
	} else {
		return new $class ();
	}
}

/**
 * 组装URL
 */
function url($path = NULL, $params = NULL) {
	$domain = 'http://' . $_SERVER ['HTTP_HOST'] . dirname ( $_SERVER ['SCRIPT_NAME'] );
	if (! $path && ! $params) {
		return $domain;
	}

	if (! $params) {
		$params = array ();
	} elseif (is_string ( $params )) {
		$_params = array ();
		parse_str ( $params, $_params );
		$params = $_params;
	}
	$params = array_filter ( $params );
	
	if ($path) {
		$path = explode ( '/', $path );
		
		switch (count ( $path )) {
			case 1 :
				$params ['module'] = @ $_GET ['module'] ?: 'index';
				$params ['controller'] = @ $_GET ['controller'] ?: 'index';
				$params ['action'] = $path [0];
				break;
			case 2 :
				$params ['module'] = @ $_GET ['module'] ?: 'index';
				$params ['controller'] = $path [0];
				$params ['action'] = $path [1];
				break;
			case 3 :
				$params ['module'] = $path [0];
				$params ['controller'] = $path [1];
				$params ['action'] = $path [2];
				break;
		}
	} else {
		$params = array_merge ( $_GET, $params );
	}
	
	return $domain . 'index.php?' . http_build_query ( $params );
}

/**
 * 获取当前用户所在城市
 */
function getCurrentCity($ip) {
	if (! empty($_COOKIE ['currentCity'])) {
		return $_COOKIE ['currentCity'];
	}
	
	$ip = getIP();
	if ($ip) {
		$qqwry = new qqwry ( PATH_CACHE . 'qqwry.dat' );
		list ( $addr1, $addr2 ) = $qqwry->q ( $ip );
		$city = iconv ( 'GB2312', 'UTF-8', $addr1 );
		// $owner = iconv ( 'GB2312', 'UTF-8', $addr2 );				
	} else {
		$city = "上海市";
	}
	return $city;
}

/**
 * 设置当前用户所在城市
 */
function setCurrentCity ($city) {
	$_COOKIE ['currentCity'] = $city;
}

/**
 * 获取当前用户IP
 */
function getIP() {
	if (@$_SERVER["HTTP_X_FORWARDED_FOR"])
		$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	else if (@$_SERVER["HTTP_CLIENT_IP"])
		$ip = $_SERVER["HTTP_CLIENT_IP"];
	else if (@$_SERVER["REMOTE_ADDR"])
		$ip = $_SERVER["REMOTE_ADDR"];
	else if (@getenv("HTTP_X_FORWARDED_FOR"))
		$ip = getenv("HTTP_X_FORWARDED_FOR");
	else if (@getenv("HTTP_CLIENT_IP"))
		$ip = getenv("HTTP_CLIENT_IP");
	else if (@getenv("REMOTE_ADDR"))
		$ip = getenv("REMOTE_ADDR");
	else
		$ip = NULL;
	return $ip;
}