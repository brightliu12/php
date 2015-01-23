<?php

namespace Sys\Init;

require 'Common.php';
class Web extends Common {
	/**
	 * 启动分发器
	 */
	public function initDispatcher() {
		/**
		 * 后续根据模块配置修改
		 */
		$this->setDispatcher ( new \Sys\Dispatcher\Cli () );
	}
		
	public function initRun() {
		parent::initRun ();
		
		$argv = $_SERVER ['argv'];
		if (count ( $argv ) > 1) {
			$path = $argv [1];
			$pathArr = explode ( '/', $path );
			
			if (empty ( $_GET )) {
				$_GET ['module'] = array_shift ( $pathArr );
				$_GET ['controller'] = array_shift ( $pathArr );
				$_GET ['action'] = array_shift ( $pathArr );
			}
			
			while ( $pathArr ) {
				$key = array_shift ( $pathArr );
				$value = array_shift ( $pathArr );
				$_GET [$key] = $value;
			}
		} elseif (empty ( $_GET )) {
			echo 'need cli params' . "\n";
			die ();
		}
	}
}