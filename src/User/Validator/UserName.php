<?php

namespace User\Validator;

use Sys\Validator\Common;

class UserName extends Common {
	protected $messageTpl = '请输入3-100位字符';
	public function isValid(& $value) {
		parent::isValid ( $value );
		
		$strLen = mb_strlen($value);
		if ( ! ($strLen >= 3 && $strLen <= 100) ) {
			$this->error ();
		}
		
		return $this->isValid;
	}
}
