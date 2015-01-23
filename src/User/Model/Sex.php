<?php

namespace User\Model;

class Sex {
	// TODO::单一列表，别搞这么负责
	protected $list = array (
			0 => 0,
			1 => 1,
			2 => 2,
			'男' => 0,
			'女' => 1,
			'man' => 0,
			'woman' => 1,
			'gg' => 0,
			'mm' => 1,
			'哥哥' => 0,
			'妹妹' => 1,
			'中性' => 2 
	);
	public function getValue($name) {
		$value = NULL;
		foreach ( $this->list as $key => $val ) {
			if (strcasecmp ( $key, $name ) == 0) {
				$value = $val;
				break;
			}
		}
		return $value;
	}
	public function getName($value) {
		$name = array_search ( $value, $this->list );
		if ($name === FALSE) {
			return NULL;
		} else {
			return $name;
		}
	}
}