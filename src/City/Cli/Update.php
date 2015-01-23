<?php

namespace City\Cli;

use Sys\Controller\Common as Controller;
use City\Model\City as ModelCity;
use Sys\Mongo\Collection;

class Update extends Controller {
	public function __construct() {
	}
	public function actionImport() {
		$mCity = new ModelCity ();
		
		$cityListTxt = file_get_contents ( PATH_TEMP . 'cityList.txt' );
		$cityListArray = explode ( "\n", $cityListTxt );
		
		$skipCityName = array (
				'市辖区',
				'县',
				'晋城市市辖区',
				'省直辖县级行政区划' 
		);
		
		while ( $cityListArray ) {
			$code = array_shift ( $cityListArray );
			$name = array_shift ( $cityListArray );
			
			if (in_array ( $name, $skipCityName ))
				continue;
			
			$mCity->insert ( array (
					'code' => ( int ) $code,
					'name' => $name 
			) );
		}
	}
	public function actionPinyin() {
		$xxx = require PATH_CACHE . 'city_export.php';
		$cityCollection = new Collection ( 'city' );
		foreach ( $xxx as $item ) {
			$cityName = $item ['name'];
			$row = $cityCollection->findOne ( array (
					'name' => new \MongoRegex ( "/$cityName/i" ) 
			) );
			if (! $row) {
				echo $cityName . "\n";
			} else {
				$row ['pinyin'] = $item ['pinyin'];
				$row ['letter'] = $item ['letter'];
				$cityCollection->save ( $row );
			}
		}
	}
}