<?php

namespace Sys\Router;

class Query implements ICommon {
	public function route() {
		/**
		 * 后续根据配置调整
		 */
		$module = @ $_GET ['module'] ?  : 'index';
		$controller = @ $_GET ['controller'] ?  : 'index';
		$action = @ $_GET ['action'] ?  : 'index';
		
		$module = ucfirst ( $module );
		$controller = ucfirst ( $controller );
		$action = ucfirst ( $action );
		
		define ( 'MODULE', $module );
		define ( 'CONTROLLER', $controller );
		define ( 'ACTION', $action );
	}
}