<?php

namespace User\Validator;

use Sys\Validator\Common;

class Password extends Common {
	protected $messageTpl = '请输入6-20位密码';
	public function isValid(& $value) {
		parent::isValid ( $value );
		
		$strLen = mb_strlen($value);
		if ( ! ($strLen >= 6 && $strLen <= 20) ) {
			$this->error ();
		}
		
		return $this->isValid;
	}
}
