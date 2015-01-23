<?php
namespace Resume\Form;
use Sys\Form\Common; 

Class Exp extends Common{
	/**
	 * 设置表单字段
	 */
	protected $fields = array (
			'uid',
			'rid',
			'start_time',
			'end_time',
			'company',
			'describe'
	);
}