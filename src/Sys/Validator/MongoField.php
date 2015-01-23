<?php

namespace Sys\Validator;

use Sys\Mongo\Collection;

class MongoField extends Common {
	protected $collection;
	protected $field;
	protected $isExists;
	protected $messageTpl = array (
			'exists' => '已存在，请换一个试试',
			'notExists' => '不存在，请换一个试试' 
	);
	public function getCollection() {
		return $this->collection;
	}
	public function getField() {
		return $this->field;
	}
	public function getIsExists() {
		return $this->isExists;
	}
	public function setCollection($collection) {
		$this->collection = $collection;
	}
	public function setField($field) {
		$this->field = $field;
	}
	public function setIsExists($isExists) {
		$this->isExists = $isExists;
	}
	public function isValid(& $value) {
		parent::isValid ( $value );
		
		$field = $this->field;
		$isExists = $this->isExists;
		$collection = new Collection ( $this->collection );
		
		$exists = $collection->findOne ( array (
				$field => $value 
		) );
		
		if ($isExists && ! $exists) {
			$this->error ( 'notExists' );
		} elseif ((! $isExists) && $exists) {
			$this->error ( 'exists' );
		}
		
		return $this->isValid;
	}
}