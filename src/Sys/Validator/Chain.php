<?php

namespace Sys\Validator;

class Chain extends Common {
	protected $messageTpl = NULL;
	protected $validatorList = array ();
	protected $breakOnFailure = false;
	/**
	 * @return the $breakOnFailure
	 */
	public function getBreakOnFailure() {
		return $this->breakOnFailure;
	}

	/**
	 * @param boolean $breakOnFailure
	 */
	public function setBreakOnFailure($breakOnFailure) {
		$this->breakOnFailure = (boolean) $breakOnFailure;
	}

	public function addValidator($validator, $key = NULL) {
		if (is_string($validator) || is_array ( $validator ) || is_subclass_of ( $validator, '\Sys\Validator\Common' )) {
			if ($key) {
				$this->validatorList [$key] = $validator;
			} else {
				$this->validatorList [] = $validator;
			}
		} else {
			throw new \Exception ( 'inValid validator type' );
		}
	}
	public function isValid(& $value) {
		parent::isValid ( $value );
		foreach ( $this->validatorList as $key => $validator ) {
			if (is_string( $validator )) {
				$validator = array('validator' => $validator);
			}
			if (is_array ( $validator )) {
				$this->validatorList [$key] = $validator = $this->createValidator ( $validator );
			}
			
			// 如果没有该数据，除了Required验证器，其它都跳过
			if ($value === NULL && !is_subclass_of($validator, '\Sys\Validator\Required')) {
				continue;
			}
			
			if (! $validator->isValid ( $value )) {
				$this->error ( $validator->getMessage () );
				if ($this->breakOnFailure) {
					break;
				}
			}
		}
		return $this->isValid;
	}
	/**
	 * 建立验证器
	 *
	 * @param array $validatorOption        	
	 * @return unknown
	 */
	protected function createValidator(array $validatorOption) {
		$validatorName = $validatorOption ['validator'];
		if (strpos ( $validatorName, ':' ) !== FALSE) {
			list ( $module, $validatorName ) = explode ( ':', $validatorName );
		}
		$module = empty ( $module ) ? 'Sys' : $module;
		$class = '\\' . $module . '\\Validator\\' . $validatorName;
		$validator = new $class ();
		unset ( $validatorOption ['validator'] );
		foreach ( $validatorOption as $key => $option ) {
			$method = 'set' . ucfirst ( $key );
			if (method_exists ( $validator, $method )) {
				$validator->$method ( $option );
			}
		}
		return $validator;
	}
}