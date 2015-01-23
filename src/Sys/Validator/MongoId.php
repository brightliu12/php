<?php

namespace Sys\Validator;

class MongoId extends Common {
	protected $messageTpl = 'MongoId字段类型错误';
	public function isValid(& $value) {
		parent::isValid ( $value );
		
		if (! is_a ( $value, 'MongoId' )) {
			if (is_string ( $value ) && strlen ( $value ) == 24) {
				$value = new \MongoId ( $value );
			} else {
				$this->error ();
			}
		}
		return $this->isValid;
	}
}