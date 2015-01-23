<?php

namespace Resume\Controller;

use Sys\Controller\Common as Controller;

class Create extends Controller {
	/**
	 * 编辑资料1:基本资料
	 */
	public function actionBase() {
		$_SESSION ['regFrom'] = @ $_SERVER['HTTP_REFERER'] ?: url();
		$this->display('Resume/Create/Base');
	}
	/**
	 * 编辑资料2：教育经历
	 */
	public function actionEdu() {
		$this->display('Resume/Create/Edu');
	}
	/**
	 * 编辑资料3：工作经历
	 */
	public function actionExp() {
		$this->display('Resume/Create/Exp');
	}
}