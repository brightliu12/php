<?php

/**
 * 基本信息表单
 */
namespace User\Form;

use Sys\Form\Common;
use Sys\Validator\Data as ValidatorData;

class Base extends Common {
	/**
	 * 设置表单字段
	 */
	protected $fields = array (
			'name',
			'sex',
			'education',
			'province',
			'salary'
	);
	public function getValidator() {
		$validator = new ValidatorData ( $this->fields );
		$validator->addRule ( '*', 'Required' );
		$validator->addRule ( '*', 'String');
		return $this->validator;
	}
}