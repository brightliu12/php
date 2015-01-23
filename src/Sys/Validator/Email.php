<?php

namespace Sys\Validator;

class Email extends Common {
	protected $messageTpl = '请输入正确的邮箱地址';
	public function isValid(& $value) {
		parent::isValid ( $value );
		$reg = '/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/';
		
		if (preg_match ( $reg, ( string ) $value ) !== 1) {
			$this->error ();
		}
		return $this->isValid;
	}
}