<?php

namespace Sys\Init;

require 'Common.php';
class Web extends Common {
	public function init(array $params = array()) {
		$debug = @ $params ['debug'] ? true : false;
		if ($debug) {
			set_exception_handler ( function ($e) {
				echo "<pre>{$e}</pre>\n";
				var_dump($e);
			} );
		}
		return parent::init ( $params );
	}
	public function initRun() {
		parent::initRun ();
		define ( 'NOW_URL', 'http://' . $_SERVER ['HTTP_HOST'] . $_SERVER ['REQUEST_URI']);
		header ( "Content-type: text/html; charset=utf-8" );
		session_start ();
	}
}