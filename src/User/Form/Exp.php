<?php

/**
 * 工作经历表单
 */
namespace User\Form;

use Sys\Form\Common;
use Sys\Validator\Data as ValidatorData;

class Exp extends Common {
	/**
	 * 设置表单字段
	 */
	protected $fields = array (
			'startYear',
			'startMonth',
			'leftYear',
			'leftMonth',
			'type',
			'company',
			'position',
			'content'
	);
	public function getValidator() {
		$validator = new ValidatorData ( $this->fields );
		$validator->addRule ( '*', 'Required' );
		$validator->addRule ( '*', 'String');
		return $this->validator;
	}
}