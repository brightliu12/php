<?php

namespace City\Model;

use Sys\Mongo\Collection;
use Sys\Validator\Data;

class City {
	protected $collection;
	public function __construct() {
		$this->collection = new Collection ( 'city' );
	}
	public function findByName ($name) {
		$old = $new = array();
		$replace = '襄樊|襄阳
				湘西州|湘西土家族苗族自治州
				燕郊开发区|北京市
				黄南州|黄南藏族自治州
				迪庆州|迪庆藏族自治州
				海北州|海北藏族自治州
				甘孜州|甘孜藏族自治州
				甘南州|甘南藏族自治州
				黔西南州|黔西南布依族苗族自治州
				德宏州|德宏傣族景颇族自治州
				临夏州|临夏回族自治州
				甘南州|甘南藏族自治州
				楚雄州|楚雄彝族自治州
				大理州|大理白族自治州
				恩施州|恩施土家族苗族自治州
				怒江州|怒江傈僳族自治州
				红河州|红河哈尼族彝族自治州
				阿坝州|阿坝藏族羌族自治州
				黔南州|黔南布依族苗族自治州
				德宏州|德宏傣族景颇族自治州
				凉山州|凉山彝族自治州
				红河州|红河哈尼族彝族自治州
				临夏州|临夏回族自治州
				黄南州|黄南藏族自治州
				海西州|海西蒙古族藏族自治州
				玉树州|玉树藏族自治州
				甘南州|甘南藏族自治州';

		foreach (explode("\n", $replace) as $item) {
			list($itemOld, $itemNew) = explode('|', $item);
			$old [] = trim($itemOld);
			$new [] = trim($itemNew);
		}
		
		$name = str_replace($old, $new, $name);
		return $this->collection->findOne(
				array('name' => new \MongoRegex('/^' . $name . '/'))
		);
	}
	public function findByLevel($level = 1, $parentCode = NULL) {
		$and = array ();
		switch ($level) {
			case 1 :
				$and [] = array (
						'$where' => 'this.code % 10000 == 0' 
				);
				break;
			case 2 :
				$and [] = array (
						'$where' => 'this.code % 10000 != 0' 
				);
				$and [] = array (
						'$where' => 'this.code % 100 == 0' 
				);
				break;
			case 3 :
				$and [] = array (
						'$where' => 'this.code % 10000 != 0' 
				);
				$and [] = array (
						'$where' => 'this.code % 100 != 0' 
				);
				break;
			default :
				throw new \Exception ( 'wrong level params' );
		}
		
		if ($parentCode) {
			if ($parentCode % 10000 == 0) {
				$and [] = array (
						'$where' => 'this.code > ' . $parentCode . ' && this.code < ' . ($parentCode + 10000)
				);
			} elseif ($parentCode % 100 == 0) {
				$and [] = array (
						'$where' => 'this.code > ' . $parentCode . ' && this.code < ' . ($parentCode + 100)
				);
			} else {
				throw new \Exception ( 'invalid parent code' );
			}
		}

		return $cursor = $this->collection->find ( array (
				'$and' => $and 
		) );
	}
	public function getTree() {
		$tree = array();
		$cursor = $this->collection->find ( array (
				'$where' => 'this.code % 100 == 0'
		) );
		$cursor->sort(array('code' => 1));

		
		while ($cursor->hasNext()) {
			$row = $cursor->getNext();

			if ($row ['code'] % 10000 == 0) {
				// 省或直辖市
				$tree [ $row['code'] ] = $row;
				$p1 = & $tree [ $row['code'] ];
			} elseif ($row ['code'] % 100 == 0) {
				// 市级别
				$p1 ['child'] [ $row['code'] ] = $row;
			}
		}
		
		return $tree;
	}
	public function insert($data) {
		$validator = new Data ( 'code, name' );
		$validator->addRule ( '*', 'Required' );
		$validator->addRule ( 'code', 'Int' );
		if ($validator->isValid ( $data )) {
			$row = array (
					'code' => $data ['code'],
					'name' => $data ['name'] 
			);
			$this->collection->insert ( $row );
		}
	}
}