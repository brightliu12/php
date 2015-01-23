<?php

namespace Sys\Form;

use Sys\Filter\Data as FilterData;
use Sys\Exception\Validate;

class Common {
	/**
	 * 表单字段
	 */
	protected $fields = array ();
	protected $error;
	protected $isValid;
	protected $formData;
	protected $validData;
	protected $preFilter;
	protected $postFilter;
	protected $validator;
	
	/**
	 * 获取表单提交过来的原生数据
	 */
	public function getFormData() {
		return $this->formData;
	}
	
	/**
	 * 返回验证通过的数据，否则抛出异常
	 */
	public function getData() {
		if ($this->isValid ()) {
			return $this->validData;
		} else {
			throw new Validate ( $this->error, $this->formData );
		}
	}
	
	/**
	 * 返回表单数据验证错误
	 */
	public function getError() {
		return $this->error;
	}
	public function __construct() {
		if (empty ( $this->fields )) {
			throw new \Exception ( 'must set the form fields property' );
		}
	}
	
	public function reset() {
		$this->formData = NULL;
		$this->error = NULL;
		$this->isValid = NULL;
		$this->validData = NULL;
	}
	
	public function getPreFilter() {
		if (! $this->preFilter) {
			$filter = new FilterData ();
			$filter->addRule ( '*', 'trim' );
			$this->preFilter = $filter;			
		}
		return $this->preFilter;
	}
	public function getPostFilter () {
		return $this->postFilter;
	}
	public function getValidator() {
		return $this->validator;
	}
	/**
	 * 收集表单提交数据
	 *
	 * 如果提交了表单返回TRUE，否则返回FALSE
	 */
	public function collectData() {
		$this->reset ();
		if (IS_POST) {
			$this->formData = array_intersect_key ( $_POST, array_fill_keys ( $this->fields, 1 ) );
			
			/**
			 * 清除未填字段
			 */
			$this->formData = array_filter ( $this->formData );
			return $this->formData;
		} else {
			return false;
		}
	}
	public function isValid() {
		if ($this->error) {
			return false;
		}
		
		if ($this->validData) {
			return true;
		}
		
		$data = $this->formData;
		$preFilter = $this->getPreFilter();
		if ($preFilter) {
			$preFilter->filter ( $data );
		}

		$validator = $this->getValidator();
		if ($validator && ! $validator->isValid ( $data )) {
			$this->error = $validator->getMessage ();
			return false;
		}
		
		$postFilter = $this->getPostFilter();
		if ($postFilter) {
			$postFilter->filter ( $data );
		}
		
		$this->validData = $data;
		return true;
	}
}