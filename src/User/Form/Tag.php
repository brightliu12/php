<?php

/**
 * 标签表单
 */
namespace User\Form;

use Sys\Form\Common;
use Sys\Validator\Data as ValidatorData;

class Tag extends Common {
	/**
	 * 设置表单字段
	 */
	protected $fields = array('tags', 'intro',);
	/*
	 * 重载方法，把tag放到数组中
	 */
	public function collectData() {
		$this->reset();
		if (IS_POST) {
			/*
			 * 把tag，tag1，tag2....放到数组里去
			 */
			$intro = $_POST['intro'];
			unset($_POST['intro']);
			$tags = $_POST;
			$data = array('tags' => $tags, 'intro' => $intro);
			$this->formData = array_intersect_key($data, array_fill_keys($this->fields, 1));
			/**
			 * 清除未填字段
			 */
			$this->formData = array_filter($this->formData);
			return $this->formData;
		} else {
			return false;
		}
	}

	public function getValidator() {
		$validator = new ValidatorData($this->fields);
		$validator->addRule('*', 'Required');
		$validator->addRule('intro', 'String');
		$validator->addRule('tag', 'IsArray');
		return $this->validator;
	}
}
