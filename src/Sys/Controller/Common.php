<?php

namespace Sys\Controller;

class Common {
	public function dispatch() {
		$method = 'action' . ucfirst ( ACTION );
		if (\method_exists ( $this, $method )) {
			$this->$method ();
		} else {
			throw new \Exception ( 'HTTP NOT FOUND ACTION : ' . ACTION );
		}
	}
	public function display($tpl, $data = array()) {
		$view = $this->getView ();
		$view->setTpl ( $tpl );
		if ($data) $view->assign($data);
		$view->renderOut ();
	}
	public function getView() {
		static $view;
		if (! $view) {
			$view = new \Sys\View\View ();
			$view->setWrap ( '_Layout/Index' );
		}
		return $view;
	}
	public function json($data) {
		echo json_encode($data);
	}
	public function goBack($goto = NULL) {
		if (! $goto) {
			$goto = @ $_SERVER['HTTP_REFERER'] ?: url();
		}
		header("location: $goto");
	}
}