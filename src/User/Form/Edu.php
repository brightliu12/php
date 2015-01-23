<?php

/**
 * 教育经历表单
 */
namespace User\Form;

use Sys\Form\Common;
use Sys\Validator\Data as ValidatorData;

class Edu extends Common {
	/**
	 * 设置表单字段
	 */
	protected $fields = array (
			'startYear',
			'startMonth',
			'leftTime',
			'leftMonth',
			'school',
			'major',
			'type'
	);
	public function getValidator() {
		$validator = new ValidatorData ( $this->fields );
		$validator->addRule ( '*', 'Required' );
		$validator->addRule ( '*', 'String');
		return $this->validator;
	}
}