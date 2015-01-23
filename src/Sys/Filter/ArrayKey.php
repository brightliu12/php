<?php

namespace Sys\Filter;

class ArrayKey extends Common {
	protected $keys;
	public function __construct($keys = NULL) {
		if ($keys) {
			$this->setKeys ( $keys );
		}
	}
	public function setKeys($keys) {
		if (is_string ( $keys ) && strpos ( $keys, ',' ) !== FALSE) {
			$keys = explode ( ',', $keys );
			$keys = array_map ( 'trim', $keys );
		}
		$this->keys = ( array ) $keys;
	}
	public function filter(array & $value) {
		$value = array_intersect_key ( $value, array_fill_keys ( $this->keys, 1 ) );
	}
}