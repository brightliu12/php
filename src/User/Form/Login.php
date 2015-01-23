<?php

/**
 * 登录表单
 */
namespace User\Form;

use Sys\Form\Common;

class Login extends Common {
	/**
	 * 设置表单字段
	 */
	protected $fields = array (
			'email',
			'password',
			'setCookie'
	);
}