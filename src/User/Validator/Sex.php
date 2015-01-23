<?php

namespace User\Validator;

use User\Model\Sex as ModelSex;
use Sys\Validator\Common;

class Sex extends Common {
	protected $messageTpl = '请输入正确的性别名';
	public function isValid(& $value) {
		parent::isValid ( $value );
		
		$sexName = $value;
		$sex = new ModelSex ();
		$sexValue = $sex->getValue ( $sexName );
		if ($sexValue === NULL) {
			$this->error ();
		} else {
			$value = $sexValue;
		}
		
		return $this->isValid;
	}
}
