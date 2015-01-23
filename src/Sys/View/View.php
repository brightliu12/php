<?php

namespace Sys\View;

class View {
	protected $childHtml;
	protected $wrap;
	protected $wrapTpl;
	protected $wrapData;
	protected $tplVar = array ();
	protected $tpl;
	public function assign($name, $value = '') {
		if (is_array ( $name )) {
			$this->tplVar = array_merge ( $this->tplVar, $name );
		} else {
			$this->tplVar [$name] = $value;
		}
	}
	public function setTpl($tpl) {
		$tpl = PATH_TEMPLATE . $tpl . '.php';
		if (file_exists ( $tpl )) {
			$this->tpl = $tpl;
			return true;
		} else {
			throw new \Exception ( 'The tpl ' . $tpl . ' is not found' );
		}
	}
	public function setWrap($tpl, $tplVar = array()) {
		$this->wrap = NULL;
		$this->wrapTpl = $tpl;
		$this->wrapData = $tplVar;
	}
	public function getWrap() {
		if (empty ( $this->wrap ) && $this->wrapTpl) {
			$wrap = new self ();
			$wrap->setTpl ( $this->wrapTpl );
			if ($this->wrapData) {
				$wrap->assign ( $this->wrapData );
			}
			$this->wrap = $wrap;
		}
		return $this->wrap;
	}
	public function setChildHtml($childHtml) {
		$this->childHtml = $childHtml;
	}
	public function importOut($tpl, $tplVar = array()) {
		echo $this->import ( $tpl, $tplVar );
	}
	public function import($tpl, $tplVar = array()) {
		$view = new self ();
		$view->setTpl ( $tpl );
		if ($tplVar) {
			$view->assign ( $tplVar );
		}
		return $view->render ();
	}
	public function renderOut() {
		echo $this->render ();
	}
	public function render() {
		if (empty ( $this->tpl )) {
			throw new \Exception ( 'Miss view tpl' );
		}

		ob_start ();
		extract ( $this->tplVar, EXTR_SKIP );
		require $this->tpl;
		$html = ob_get_clean ();
		
		$wrap = $this->getWrap ();
		if ($wrap) {
			$wrap->setChildHtml ( $html );
			$html = $wrap->render ();
		}
		return $html;
	}
	public function url($path = NULL, $params = array()) {
		echo url ( $path, $params );
	}
}