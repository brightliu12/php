<?php

namespace Sys\Validator;

abstract class Common {
	/**
	 *
	 * @var Array String
	 */
	protected $messageTpl = '数据错误';
	/**
	 *
	 * @var NULL Boolean
	 */
	protected $isValid;
	/**
	 *
	 * @var NULL Array
	 */
	protected $messages;
	/**
	 *
	 * @var mixed 要验证的值
	 */
	protected $value;
	/**
	 *
	 * @return the $messages
	 */
	public function getMessages() {
		return $this->messages;
	}
	/**
	 *
	 * @return the $message
	 */
	public function getMessage() {
		return implode ( ',', $this->messages );
	}
	public function reset() {
		$this->isValid = NULL;
		$this->value = NULL;
		$this->messages = NULL;
	}
	/**
	 *
	 * @return the $isValid
	 */
	public function getIsValid() {
		return $this->isValid;
	}
	/**
	 * 生成错误信息
	 *
	 * @param string $tplKey        	
	 */
	protected function error($tplKey = NULL) {
		if (is_array ( $this->messageTpl )) {
			if ($tplKey && isset ( $this->messageTpl [$tplKey] )) {
				$message = $this->messageTpl [$tplKey];
			} else {
				$message = current ( $this->messageTpl );
			}
		} elseif ($this->messageTpl) {
			$message = $this->messageTpl;
		} else {
			$message = $tplKey;
		}
		
		if (strpos ( $message, '{$' ) !== false) {
			$message = str_replace ( '{$value}', ( string ) $this->value, $message );
			if (strpos ( $message, '{$' ) !== false) {
				foreach ( get_object_vars ( $this ) as $key => $val ) {
					$message = str_replace ( '{$' . $key . '}', ( string ) $val, $message );
				}
			}
		}
		
		$this->messages [] = $message;
		$this->isValid = false;
	}
	/**
	 * 设置错误信息模板
	 *
	 * @param string $tplKey        	
	 * @param string $messageTpl        	
	 */
	public function setMessageTpl($messageTpl, $tplKey = NULL) {
		if ($tplKey) {
			$this->messageTpl [$tplKey] = $messageTpl;
		} else {
			$this->messageTpl = $messageTpl;
		}
	}
	public function getValue() {
		return $this->value;
	}
	public function setValue($value) {
		$this->reset ();
		$this->value = $value;
	}
	public function __invoke($value) {
		return $this->isValid ( $value );
	}
	public function isValid(& $value) {
		$this->setValue ( $value );
		$this->isValid = true;
	}
}