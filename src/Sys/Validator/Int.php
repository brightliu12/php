<?php

namespace Sys\Validator;

class Int extends Common {
	protected $lt;
	protected $lte;
	protected $gt;
	protected $gte;
	protected $messageTpl = array(
			'type' => '请输入正确的整数',
			'lt' => '不能小于或等于{$min}',
			'lte' => '不能小于{$min}',
			'gt' => '不能大于或等于{$max}',
			'gte' => '不能大于或等于{$max}'
	);
	public function isValid(& $value) {
		parent::isValid($value);
		$reg = '/\d/';
		if ( preg_match ( $reg, $value ) !== 1 ) {
			$this->error('type');
		} else {
			$value = intval($value);
			if ($this->lt && $value <= $this->lt) {
				$this->error('lt');
			}
			if ($this->lte && $value < $this->lte) {
				$this->error('lte');
			}
			if ($this->gt && $value >= $this->gt) {
				$this->error('gt');
			}
			if ($this->gte && $value > $this->gte) {
				$this->error('gte');
			}
		}
		return $this->isValid;
	}
}