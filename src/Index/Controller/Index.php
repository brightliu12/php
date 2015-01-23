<?php

namespace Index\Controller;

use Sys\Controller\Common as Controller;

class Index extends Controller {
	public function actionIndex() {
		$this->display('Index/Index/Index', array(
				'city' => @ $_COOKIE ['currentCityCode'],
				'city_name' => @ $_COOKIE ['currentCityName']
		));
	}
	
	public function actionTop() {
		$this->display('Index/Index/Top');
	}
}