<?php

/**
 * 基本信息表单
 */
namespace User\Form;

use Sys\Form\Common;
use Sys\Validator\Data as ValidatorData;

class Password extends Common {
	/**
	 * 设置表单字段
	 */
	protected $fields = array (
			'email',
			'password',
			'comfirm_password'
	);
	public function getValidator() {
		$validator = new ValidatorData ( $this->fields );
		$validator->addRule ( '*', 'Required' );
		$validator->addRule ( 'password', array (
				'validator' => 'Equal',
				'target' => $this->formData ['comfirm_password'] 
		) );
		return $this->validator;
	}
}