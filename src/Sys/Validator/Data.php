<?php

namespace Sys\Validator;

class Data extends Common {
	protected $ruleList = array ();
	protected $fields = array ();
	protected $chainList = array ();
	protected $breakOnFailure = false;
	
	// TODO::allowUnknowData
	public function __construct($fields) {
		if ($fields) {
			if (is_string ( $fields )) {
				$fields = explode ( ',', $fields );
				$fields = array_map ( 'trim', $fields );
			}
			$this->fields = ( array ) $fields;
		}
	}
	public function setThrowException($throwException) {
		$this->throwException = $throwException;
	}
	public function getFields() {
		return $this->fields;
	}
	public function setFields(array $fields) {
		$this->fields = $fields;
		$this->chainList = array ();
	}
	public function getBreakOnFailure() {
		return $this->breakOnFailure;
	}
	public function setBreakOnFailure($breakOnFailure) {
		$this->breakOnFailure = ( boolean ) $breakOnFailure;
	}
	protected function error($message, $field) {
		$this->isValid = FALSE;
		$this->messages [$field] = $message;
	}
	public function addRule($field, $validator, array $params = array()) {
		if (is_string($validator)) {
			$validator = array('validator' => $validator);
		}
		$this->ruleList [] = array (
				'field' => $field,
				'validator' => array_merge($validator, $params) 
		);
	}
	protected function generateChainList() {
		if ($this->chainList) {
			return $this->chainList;
		}
		
		if (empty ( $this->fields )) {
			throw new \Exception ( 'must set the fields property for data validator' );
		}
		
		$dataFields = $this->fields;
		$chainList = array ();
		
		foreach ( $this->ruleList as $rule ) {
			if ($rule ['field'] == '*') {
				$fields = $dataFields;
			} elseif (strpos ( $rule ['field'], '~' ) === 0) {
				$exFields = explode ( ',', substr ( $rule ['field'], 1 ) );
				$exFields = array_map('trim', $exFields);
				$fields = array_diff ( $dataFields, $exFields );
			} elseif (strpos ( $rule ['field'], ',' ) !== FALSE) {
				$fields = explode ( ',', $rule ['field'] );
				$fields = array_map('trim', $fields);
			} else {
				$fields = ( array ) $rule ['field'];
			}
			
			foreach ( $fields as $field ) {
				if (! isset ( $chainList [$field] )) {
					$chainList [$field] = new \Sys\Validator\Chain ();
				}
				$chainList [$field]->addValidator ( $rule ['validator'] );
			}
		}
		
		$this->chainList = $chainList;
		return $chainList;
	}
	public function isValid(array & $data) {
		parent::isValid ( $data );
		$chainList = $this->generateChainList ();
		foreach ( $chainList as $field => $validatorChain ) {
			if (! $validatorChain->isValid ( & $data [$field] )) {
				$this->error ( $validatorChain->getMessage (), $field );
				if ($this->breakOnFailure) {
					break;
				}
			}
		}
		return $this->isValid;
	}
}