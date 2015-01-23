<?php

namespace User\Filter;

use Sys\Filter\Common;
use User\Model\Sex as ModelSex;

class Sex extends Common {
	/**
	 * 过滤方式
	 */
	protected $type = 'name2val';
	/**
	 * @return the $type
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @param string $type
	 */
	public function setType($type) {
		$this->type = $type;
	}

	public function filter(& $value) {
		$sex = new ModelSex ();
		if ($this->type == 'name2val') {
			$value = $sex->getValue ( $value );
		} elseif ($this->type == 'val2name') {
			$value = $sex->getName ( $value );
		}
	}
}