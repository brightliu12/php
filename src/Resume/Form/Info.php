<?php
namespace Resume\Form;
use Sys\Form\Common; 

Class Info extends Common{
	/**
	 * 设置表单字段
	 */
	protected $fields = array (
			'uid',
			'rid',
			'name',
			'sex',
			'edu',
			'live_city',
			'work_exp'
	);
}