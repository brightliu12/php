<?php

namespace Core;

class Filter {
	static public function all(array & $data, array $rule, $params = NULL) {
		foreach ( $rule as $ruleItem ) {
			$filterField = $ruleItem [0];
			if ($filterField == '*') {
				$filterField = array_keys($data);
			}
			$filterType = $ruleItem [1];
			$filterParam = isset ( $ruleItem [2] ) ? $ruleItem [2] : NULL; // 验证参数可能为空
			$defaultValue = isset ( $ruleItem [3] ) ? $ruleItem [3] : NULL; // 默认值可能为空
			
			if (is_string($filterField)) {
				$filterField = explode ( ',', $filterField );
			}
			foreach ( $filterField as $filterFieldItem ) {
				static::one ( $data [$filterFieldItem], $filterType, $filterParam, $defaultValue );
			}
		}
	}
	static public function one(& $value, $filterType, $filterParam = NULL, $defaultValue = NULL) {
		
		$filterType = ucfirst ( $filterType );
		if ($value === NULL) {
			if ($defaultValue !== NULL) {
				$value = $defaultValue;
			}
		} else {
			// 是否是核心内置的验证器
			if (strpos ( $filterType, '\\' ) === FALSE) {
				$filterClass = 'Core\\Filter\\' . $filterType;
			} else {
				$filterClass = $filterType;
			}
			$filterClass::filter ( $value, $filterParam );
		}
	}
}