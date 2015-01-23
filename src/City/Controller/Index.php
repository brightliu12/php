<?php

namespace City\Controller;

use Sys\Controller\Common as Controller;
use City\Model\City;

class Index extends Controller {
	public function actionSelect() {
		$city = new City ();
		$cityTree = $city->getTree ();
		$this->display ( 'City/Index/Select', array (
				'cityTree' => $cityTree
		) );
	}
}