<?php
namespace Resume\Form;
use Sys\Form\Common; 

Class Edu extends Common{
	/**
	 * 设置表单字段
	 */
	protected $fields = array (
			'uid',
			'rid',
			'start_time',
			'end_time',
			'school',
			'major',
			'type',
			'describe'
	);
}