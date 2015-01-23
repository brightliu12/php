<?php

namespace Sys\Filter;

class Chain extends Common {
	protected $filterList = array ();
	public function addFilter($filter, $key = NULL) {
		if (is_string($filter) || is_array ( $filter ) || is_subclass_of ( $filter, \Sys\Filter\Common )) {
			if ($key) {
				$this->filterList [$key] = $filter;
			} else {
				$this->filterList [] = $filter;
			}
		} else {
			throw new \Exception ( 'inValid filter type' );
		}
	}
	public function filter(& $value) {
		foreach ( $this->filterList as $key => $filter ) {
			if (is_string( $filter )) {
				$filter = array('filter' => $filter);
			}
			if (is_array ( $filter )) {
				$this->filterList [$key] = $filter = $this->createFilter ( $filter );
			}
			$filter->filter ( $value );
		}
	}
	public function createFilter(array $filterOption) {
		$filterName = $filterOption ['filter'];
		if (strpos ( $filterName, ':' ) !== FALSE) {
			list ( $module, $filterName ) = explode ( ':', $filterName );
		}
		$module = empty ( $module ) ? 'Sys' : $module;
		$class = '\\' . $module . '\\Filter\\' . $filterName;
		$validator = new $class ();
		unset ( $filterOption ['filter'] );
		foreach ( $filterOption as $key => $option ) {
			$method = 'set' . ucfirst ( $key );
			if (method_exists ( $validator, $method )) {
				$validator->$method ( $option );
			}
		}
		return $validator;
	}
}