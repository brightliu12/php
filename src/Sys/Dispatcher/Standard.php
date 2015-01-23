<?php

namespace Sys\Dispatcher;

class Standard implements ICommon {
	public function dispatch() {
		$controllerClass = MODULE . '\\Controller\\' . CONTROLLER;
		if (\class_exists ( $controllerClass )) {
			if (is_subclass_of ( $controllerClass, 'Sys\\Controller\\Common' )) {
				$controller = new $controllerClass ();
				$controller->dispatch ();
				return true;
			} else {
				throw new \Exception ( 'Controller Class InValid' );
			}
		}
		throw new \Exception ( 'HTTP NOT FOUND' );
	}
}