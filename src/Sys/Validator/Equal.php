<?php

namespace Sys\Validator;

class Equal extends Common {
	protected $messageTpl = '重复输入不正确';
	protected $target;
	public function setTarget (& $target) {
		$this->target = $target;
	}
	public function isValid(& $value) {
		parent::isValid ( $value );
		$target = $this->target;
		if (is_array ( $target )) {
			foreach ( $target as $item ) {
				if ($value != $item) {
					$this->error ();
				}
			}
		} else {
			if ($value != $target) {
				$this->error ();
			}
		}
		return $this->isValid;
	}
}