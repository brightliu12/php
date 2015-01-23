<?php

namespace Sys\Exception;

class Validate extends \Exception {
	protected $error;
	protected $data;
	public function getError() {
		return $this->error;
	}

	public function getData() {
		return $this->data;
	}

	public function __construct($error, $data) {
		$this->error = $error;
		$this->data = $data;
	}
	
	public function __toString() {
		$str = '';
		foreach ($this->error as $key => $err) {
			$str .= $key . ':' . $err . "\n";
		}
		return $str;
	}
}