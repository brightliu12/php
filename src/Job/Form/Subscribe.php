<?php

namespace Job\Form;

use Sys\Form\Common;

class Subscribe extends Common {
	/**
	 * 设置表单字段
	 */
	protected $fields = array (
			'title',
			'city_name',
			'city',
			'type',
			'experience',
			'salary',
			'name'
	);
}