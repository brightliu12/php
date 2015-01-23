<?php
namespace Resume\Form;
use Sys\Form\Common; 

Class Job extends Common{
	/**
	 * 设置表单字段
	 */
	protected $fields = array (
			'uid',
			'rid',
			'type',
			'status',
			'expect_industry',
			'expect_salary'
	);
}