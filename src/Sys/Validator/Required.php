<?php

namespace Sys\Validator;

class Required extends Common {
	protected $messageTpl = '请输入参数';
	public function isValid(& $value) {
		parent::isValid ( $value );
		if (empty ( $value )) {
			$this->error ();
		}
		return $this->isValid;
	}
}