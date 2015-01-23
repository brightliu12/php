<?php

namespace Spider\Controller;

use Sys\Controller\Common as Controller;

abstract class Common extends Controller {
	protected $stopFile;
	public function __construct() {
		if (! IS_CLI) {
			echo 'Spider must be run in CLI';
			die ();
		}
		$this->stopFile = PATH_SCRIPT . 'spider/' . $this->stopFile;
		if (file_exists ( $this->stopFile )) {
			unlink ( $this->stopFile );
		}
	}
	protected function getModel($modelName) {
		$modelClass = 'Spider\\Model\\' . $this->task . '\\' . $modelName;
		if (! class_exists ( $modelClass, TRUE )) {
			echo 'invalid model name : "' . $modelName . '"';
			die ();
		}
		return new $modelClass ();
	}
	protected function checkRun() {
		if (file_exists ( $this->stopFile )) {
			echo "stop\n";
			exit ();
		}
	}
}