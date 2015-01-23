<?php

/**
 * 空余时间表单
 */
namespace User\Form;

use Sys\Form\Common;
use Sys\Validator\Data as ValidatorData;

class Work extends Common {
	/**
	 * 设置表单字段
	 */
	protected $fields = array (
			'spacetime',
			'workhome',
			'intention',
	);
	public function getValidator() {
		$validator = new ValidatorData ( $this->fields );
		$validator->addRule ( '*', 'Required' );
		$validator->addRule ( '*', 'String');
		return $this->validator;
	}
}