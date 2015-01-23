<?php

namespace Sys\Validator;

class IsArray extends Common {
	protected $messageTpl = '请输入数组';
	public function isValid(& $value) {
		parent::isValid ( $value );
		if (! is_array ( $value )) {
			$this->error ();
		}
		return $this->isValid;
	}
}
