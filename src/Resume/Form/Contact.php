<?php
namespace Resume\Form;
use Sys\Form\Common; 

Class Contact extends Common{
	/**
	 * 设置表单字段
	 */
	protected $fields = array (
			'uid',
			'rid',
			'email',
			'phone'
	);
}