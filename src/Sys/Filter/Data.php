<?php

namespace Sys\Filter;

class Data extends Common {
	protected $ruleList = array ();
	public function addRule($field, $filter) {
		$this->chainList [] = array (
				'field' => $field,
				'filter' => $filter 
		);
	}
	protected function generateChainList(array $dataFields) {
		$chainList = array ();
		
		foreach ( $this->ruleList as $rule ) {
			if ($rule ['field'] == '*') {
				$fields = $dataFields;
			} elseif (strpos ( $rule ['field'], '~' ) === 0) {
				$exFields = explode ( ',', substr ( $rule ['field'], 1 ) );
				$fields = array_diff ( $dataFields, $exFields );
			} elseif (strpos ( $rule ['field'], ',' ) !== FALSE) {
				$fields = explode ( ',', $rule ['field'] );
			}
			
			foreach ( ( array ) $fields as $field ) {
				if (! isset ( $chainList [$field] )) {
					$chainList [$field] = new \Sys\Filter\Chain ();
				}
				$chainList [$field]->addFilter ( $rule ['filter'] );
			}
		}
		
		return $chainList;
	}
	public function filter(& $data) {
		$data = ( array ) $data;
		$chainList = $this->generateChainList ( array_keys ( $data ) );
		foreach ( $chainList as $field => $filterChain ) {
			$filterChain->filter ( & $data [$field] );
		}
	}
}