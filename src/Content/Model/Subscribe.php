<?php

namespace Content\Model;

use Sys\Mongo\Collection;
use Sys\Exception\Validate as ExceptionValidate;
use Sys\Validator\Data as ValidatorData;

class Subscribe {
	protected $collection;
	public function __construct() {
		$this->collection = new Collection ( 'content.subscribe' );
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
			$page = min ( $pageCount, $page );
			
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
					'data' => array () 
			);
		}
	}
	
	/**
	 * 增加订阅
	 */
	public function add($data) {
		$validator = new ValidatorData ( 'uid, type, name' );
		$validator->addRule ( '*', 'Required' );
		$validator->addRule ( 'uid', 'MongoId' );
		$validator->addRule ( 'type', 'String' );
		$validator->addRule ( 'name', 'String' );
		if ($validator->isValid ( $data )) {
			$row = $this->collection->update ( array (
					'uid' => $data ['uid'],
					'type' => $data ['type'],
					'name' => $data ['name'] 
			), array (
					'$set' => $data 
			), array (
					'upsert' => true 
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
		) )->sort(array('_id' => -1));
	}
	
	/**
	 * 删除
	 */
	public function delete(\MongoId $_id) {
		$this->collection->remove ( array (
				'_id' => $_id 
		), array (
				"justOne" => true 
		) );
	}
	
	/**
	 * 修改
	 */
	public function update(\MongoId $_id, array $data) {
		$this->Subscribeion->update ( array (
				'_id' => $_id 
		), array (
				'$set' => $data 
		), array (
				"justOne" => true 
		) );
	}
}
