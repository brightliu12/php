<?php

namespace Spider\Controller;

use Sys\Mongo\Collection;

class City extends Common {
	protected $task = 'city';
	public function __construct() {
	}
	public function actionIndex() {
		$model = $this->getModel ( 'Fetch' );
		$model->run ();
	}
	public function actionCheckJob() {
		$jobData = new Collection ( 'spider.sogou.data' );
		$cityList = new Collection ( 'city' );
		$retval = $jobData->distinct ( 'data.city' );
		// print_r($retval);
		foreach ( $retval as $city ) {
			if (! $cityList->findOne ( array (
					'name' => $city 
			) )) {
				echo $city . "<br />";
			}
		}
	}
}