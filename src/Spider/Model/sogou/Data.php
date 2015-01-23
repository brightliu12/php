<?php

namespace Spider\Model\sogou;

use Sys\Mongo\Collection;
use Job\Model\Job;
use City\Model\City;

class Data {
	protected $cData;
	protected $mJob;
	public function __construct() {
		$this->cData = new Collection ( 'spider.sogou.data' );
		$this->mJob = new Job ();
	}
	public function run() {
		$cursor = $this->cData->find ( array (
				'isUpdate' => array('$exists' => false) 
		) );
		$mCity = new City();
		$cityMap = array();
		while ( $cursor->hasNext () ) {
			$row = $cursor->getNext ();
			$data = $row ['data'];
			$data = array_map ( array (
					$this,
					'clearEm' 
			), $data );

			$cityName = $data ['city'];
			if (isset($cityMap [$cityName])) {
				$cityInfo = $cityMap [$cityName];
			} else {
				$cityRow = $mCity->findByName($data ['city']);
				if (! $cityRow) {
					echo $cityName . "\n";
					continue;
				}
				$cityMap [$cityName] = $cityInfo = array('code' => $cityRow ['code'], 'name' => $cityRow ['name']);
			}

			$data ['cityCode'] = $cityInfo['code'];
			$data ['cityName'] = $cityInfo['name'];
			$data ['keyword'] = $this->splitWord($data['title']);
			$data ['sid'] = $row ['_id'];
			$this->mJob->insert ( $data );
			$row ['isUpdate'] = true;
			$this->cData->save ( $row );
		}
	}
	public function clearEm($string) {
		$string = str_replace ( array (
				'[em]',
				'[/em]' 
		), array (
				'',
				'' 
		), $string );
		return $string;
	}
	public function splitWord($text) {
		$sh = scws_open ();
		scws_send_text ( $sh, $text );
		$list = scws_get_words ( $sh, 'n' );
		scws_close ( $sh );
		$words = array ();
		foreach ( $list as $item ) {
			$item = $item ['word'];
			if (mb_strlen ( $item ) > 1) {
				$words [] = $item;
			}
		}
		return $words;
	}	
}