<?php

/**
 * 公共的系统启动父类
 *
 */
namespace Sys\Init;

require __DIR__ . '/../functions.php';

abstract class Common {
	protected $router;
	protected $dispatcher;
	
	/**
	 *
	 * @return the $router
	 */
	public function getRouter() {
		return $this->router;
	}
	
	/**
	 *
	 * @return the $dispatcher
	 */
	public function getDispatcher() {
		return $this->dispatcher;
	}
	
	/**
	 *
	 * @param field_type $router        	
	 */
	public function setRouter(\Sys\Router\ICommon $router) {
		$this->router = $router;
	}
	
	/**
	 *
	 * @param field_type $dispatcher        	
	 */
	public function setDispatcher(\Sys\Dispatcher\ICommon $dispatcher) {
		$this->dispatcher = $dispatcher;
	}
	
	/**
	 * 系统启动相关环境和配置
	 */
	public function init(array $params = array()) {
		$this->initPath ();
		$this->initPHP ();
		$this->initRun ();
		$this->initLoader ();
		$this->initCmp ();
		$this->initRouter ();
		$this->initDispatcher ();
		return $this;
	}
	
	/**
	 * 配置路径相关环境常量
	 */
	public function initPath() {
		define ( 'PATH_APP', realpath ( __DIR__ . '/../../../' ) . '/' );
		define ( 'PATH_SRC', PATH_APP . 'src/' );
		define ( 'PATH_SCRIPT', PATH_APP . 'script/' );
		define ( 'PATH_CACHE', PATH_APP . 'cache/' );
		define ( 'PATH_TEMP', PATH_APP . 'temp/' );
		define ( 'PATH_CONFIG', PATH_APP . 'config/' );
		define ( 'PATH_LOG', PATH_APP . 'log/' );
		define ( 'PATH_TEMPLATE', PATH_APP . 'template/' );
	}
	
	/**
	 * 配置PHP相关设定
	 */
	public function initPHP() {
		// php.ini
		// 设定时区
		// 错误显示
		
		// 设定mb_string默认字符
		mb_internal_encoding ( "UTF-8" );
	}
	
	/**
	 * 配置运行环境相关常量
	 */
	public function initRun() {
		define ( 'NOW_TIME', $_SERVER ['REQUEST_TIME'] );
		define ( 'REQUEST_METHOD', isset ( $_SERVER ['REQUEST_METHOD'] ) ? $_SERVER ['REQUEST_METHOD'] : NULL );
		define ( 'IS_GET', REQUEST_METHOD == 'GET' ? true : false );
		define ( 'IS_POST', REQUEST_METHOD == 'POST' ? true : false );
		define ( 'IS_PUT', REQUEST_METHOD == 'PUT' ? true : false );
		define ( 'IS_DELETE', REQUEST_METHOD == 'DELETE' ? true : false );
		define ( 'IS_AJAX', ((isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) && strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest') || ! empty ( $_POST ['is_ajax'] ) || ! empty ( $_GET ['is_ajax'] )) ? true : false );
		define ( 'IS_CGI', substr ( PHP_SAPI, 0, 3 ) == 'cgi' ? 1 : 0 );
		define ( 'IS_WIN', strstr ( PHP_OS, 'WIN' ) ? 1 : 0 );
		define ( 'IS_CLI', PHP_SAPI == 'cli' ? 1 : 0 );
	}
	
	/**
	 * 启动类加载器
	 */
	public function initLoader() {
		/**
		 * 后续根据模块配置修改
		 */
		require __DIR__ . '/../Loader/ClassFile.php';
		$loader = new \Sys\Loader\ClassFile ();
		// 注册类载入器
		spl_autoload_register ( array (
				$loader,
				'load' 
		) );
	}
	
	// 启动相关组件
	public function initCmp () {
		// cmp ( 'U', new \User\Model\U () );
	}
	
	/**
	 * 启动路由器
	 */
	public function initRouter() {
		/**
		 * 后续根据模块配置修改
		 */
		$this->setRouter ( new \Sys\Router\Query () );
	}
	
	/**
	 * 启动分发器
	 */
	public function initDispatcher() {
		/**
		 * 后续根据模块配置修改
		 */
		$this->setDispatcher ( new \Sys\Dispatcher\Standard () );
	}
	/**
	 * 系统开始执行
	 */
	public function run() {
		$this->runRoute ();
		$this->runDispatch ();
	}
	/**
	 * 系统开始路由
	 */
	public function runRoute() {
		$this->getRouter ()->route ();
	}
	/**
	 * 系统开始分发执行
	 */
	public function runDispatch() {
		$this->getDispatcher ()->dispatch ();
	}
}