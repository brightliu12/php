<?php

namespace Index\Cli;

use Sys\Controller\Common as Controller;
use Sys\Mongo\Collection;

class Init extends Controller {
	public function actionIndex() {
		$collection = new Collection ( 'city' );
		$collection->ensureIndex ( array (
				'code' => 1 
		), array (
				"unique" => true 
		) );
	}
}