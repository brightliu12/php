<?php

namespace Job\Model;

use Sys\Mongo\Collection;
use Sys\Filter\Data as FilterData;
use Sys\Validator\Data as ValidatorData;

class Collect {
	protected $collection;
	public function __construct() {
		$this->collection = new Collection('collect');
	}
	
	/*
	 * 增加收藏
	 */
	public function add($data) {
		$filter = new FilterData();
		$filter->addRule('type,typeId', 'Trim');
		$filter->filter($data);
		$validator = new ValidatorData('type,typeId');
		$validator->addRule('type,typeId', 'String');
		if ($validator->isValid($data)) {
			$data['typeId'] = new \MongoId($data['typeId']);
			$data['modifyDate'] = new \MongoDate();
			return $this->collection->insert($data);
		} else {
			return $validator->getMessages();
		}
	}
	/*
	 * 按照uid查找job_id
	 */
	public function findByUid(\MongoId $uid){
		return $this->collection->find(array('uid' => $uid),array('typeId'=>1));
	}
	/*
	 * 删除收藏
	 */
	public function delete($type,\MongoId $typeId){
		return $this->collection->remove(array('type'=>$type,'typeId'=>$typeId));
	}
	
}
