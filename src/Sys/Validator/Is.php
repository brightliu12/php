<?php

namespace Sys\Validator;

class Is extends Common {
	protected $messageTpl = '数据类型不正确';
	protected $type;
	public function setType ($type) {
		$this->type = $type;
	}
	public function isValid(& $value) {
		parent::isValid ( $value );
		if (!is_a($value, $this->type)) {
			$this->error();
		}
		return $this->isValid;
	}
}