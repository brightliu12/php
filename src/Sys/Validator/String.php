<?php

namespace Sys\Validator;

class String extends Common {
	protected $lt;
	protected $lte;
	protected $gt;
	protected $gte;
	protected $messageTpl = array (
			'type' => '请输入字符串',
			'lt' => '长度不能小于或等于{$min}字符',
			'lte' => '长度不能小于{$min}字符',
			'gt' => '长度不能超过或等于{$max}字符',
			'gte' => '长度不能超过{$max}字符' 
	);
	public function isValid(& $value) {
		parent::isValid($value);
		if (! is_string ( $value )) {
			$this->error ( 'type' );
		} else {
			$len = mb_strlen ( $value );
			
			if ($this->lt && $len <= $this->lt) {
				$this->error ( 'lt' );
			}
			if ($this->lte && $len <= $this->lt) {
				$this->error ( 'lte' );
			}
			if ($this->gt && $len > $this->gt) {
				$this->error ( 'gt' );
			}
			if ($this->gte && $len > $this->gt) {
				$this->error ( 'gte' );
			}
		}
		
		return $this->isValid;
	}
}
