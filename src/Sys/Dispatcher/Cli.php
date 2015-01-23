<?php

namespace Sys\Dispatcher;

class Cli implements ICommon {
	public function dispatch() {
		$ControllerClass = MODULE . '\\Cli\\' . CONTROLLER;
		if (\class_exists ( $ControllerClass )) {
			if (is_subclass_of ( $ControllerClass, 'Sys\\Controller\\Common' )) {
				$Cli = new $ControllerClass ();
				$Cli->dispatch ();
				return true;
			} else {
				throw new \Exception ( 'Cli Class InValid' );
			}
		}
		throw new \Exception ( 'Cli NOT FOUND' );
	}
}