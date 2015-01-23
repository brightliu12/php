<?php

namespace Job\Model;

use Sys\Mongo\Collection;

class Apply {
	protected $collection;
	public function __construct() {
		$this->collection = new Collection ( 'job.apply' );
	}
	
	/**
	 * 申请
	 */
	public function apply(\MongoId $jobId,\MongoId $uid) {
		$this->collection->update ( array (
				'uid' => $uid,
				'jobId' => $jobId 
		), array (
				'$set' => array (
						'uid' => $uid,
						'jobId' => $jobId,
						'applyTime' => new \MongoDate () 
				) 
		), array (
				'upsert' => true 
		) );
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
	 * 按照_id查找申请信息
	 */
	public function findById(\MongoId $_id) {
		return $this->collection->findOne ( array (
				'_id' => $_id 
		) );
	}
	
	/**
	 * 通过用户查找申请
	 */
	public function findByUid(\MongoId $uid) {
		return $this->collection->find ( array (
				'uid' => $uid 
		) );
	}
}