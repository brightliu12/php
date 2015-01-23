<?php

namespace Content\Model;

use Sys\Mongo\Collection;
use Sys\Exception\Validate as ExceptionValidate;
use Sys\Validator\Data as ValidatorData;

class Collect {
	protected $collection;
	public function __construct() {
		$this->collection = new Collection ( 'content.collect' );
	}
	public function search($where = array(), $page = 1, $pageSize = 20) {
		$where = array_filter ( $where );
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
			$page = min($pageCount, $page);
			
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
	/**
	 * 增加收藏
	 */
	public function add($data) {
		
		$validator = new ValidatorData ( 'uid, type, cid' );
		$validator->addRule ( '*', 'Required' );
		$validator->addRule ( 'uid', 'MongoId' );
		$validator->addRule ( 'type', 'String' );
		$validator->addRule ( 'cid', 'MongoId' );
		if ($validator->isValid ( $data )) {
			$row = $this->collection->findOne ( array (
					'uid' => $data ['uid'],
					'type' => $data ['type'],
					'cid' => $data ['cid'] 
			) );
			if (! $row) {
				$data ['insertTime'] = new \MongoDate ();
				$this->collection->insert ( $data );
				return $data;
			} else {
				return $row;
			}
		} else {
			throw new ExceptionValidate ( $validator->getMessages (), $data );
		}
	}
	
	/**
	 * 按照_id查找申请信息
	 */
	public function findById(\MongoId $_id) {
		return $this->collection->findOne ( array (
				'_id' => $_id 
		) );
	}
	
	/**
	 * 按照用户id查找收藏id
	 */
	public function findByUid(\MongoId $uid) {
		return $this->collection->find ( array (
				'uid' => $uid 
		) );
	}
	
	/**
	 * 删除
	 */
	public function delete(\MongoId $_id, \MongoId $uid) {
		$this->collection->remove ( array (
				'_id' => $_id,
				'uid' => $uid
		), array (
				"justOne" => true 
		) );
	}
}
