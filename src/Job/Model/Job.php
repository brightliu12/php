<?php

namespace Job\Model;

use Sys\Mongo\Collection;
use Sys\Filter\Data as FilterData;
use Sys\Validator\Data as ValidatorData;
use Sys\Exception\Validate as ExceptionValidate;

class Job {
	protected $collection;
	public function __construct() {
		$this->collection = new Collection ( 'job' );
	}

	public function insert(array $data) {
		$this->collection->insert($data);
	}
	/*
	 * 按照_id查找职位信息
	 */
	public function findById(\MongoId $_id) {
		return $this->collection->findOne ( array (
				'_id' => $_id 
		) );
	}
	/*
	 * 搜索职位
	 */
	public function search($where, $page = 1, $pageSize = 20) {
		if (! empty ( $where ['title'] )) {
			$keywords = $this->splitWord ( $where ['title'] );
			$where ['keyword'] = array (
					'$all' => $keywords 
			);
			unset ( $where ['title'] );
		}
		
		$where = array_filter ( $where );
		if (@ $where ['city']) {
			$where ['cityCode'] = (int) $where ['city'];
			unset($where ['city']);
		}
		
		if (empty ( $where )) {
			$cursor = $this->collection->find ();
		} else {
			$cursor = $this->collection->find ( $where );
		}
		
		if ($cursor) {
			$page = intval ( $page );
			$page = max ( 1, $page );
			$count = $cursor->count ();
			$pageCount = ceil ( $count / $pageSize );

			if ($page > 1) {
				$skip = ($page - 1) * $pageSize;
				$cursor->skip ( $skip );
			}
			$cursor->limit ( $pageSize );
			
			return array (
				'count' => $count,
				'page' => $page,
				'pageSize' => $pageSize,
				'pageCount' => $pageCount,
				'data' => $cursor
			);
		} else {
			return array (
				'count' => 0,
				'page' => $page,
				'pageSize' => 0,
				'pageCount' => 0,
				'data' => array()
			);
		}
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
	public function find($where = array(), $fields = array()) {
		return $this->collection->find($where, $fields);
	}
	public function updateById(\MongoId $_id,$data){
		$this->collection->update(array('_id'=>$_id), array('$set'=>$data));
	}
	public function findByTag($where){
		return $this->collection->find($where,array('salary'=>true));
	}
}
