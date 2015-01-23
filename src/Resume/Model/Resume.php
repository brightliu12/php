<?php
namespace Resume\Model;

use Sys\Mongo\Collection;

class Resume {
	protected $collection;
	public function __construct() {
		$this->collection = new Collection('resume');
	}

	/*
	 * 根据用户id创建简历
	 * @param array $uid
	 * @return true
	 */
	public function add(\MongoId $uid) {
		$data = array('uid' => $uid);
		$this->collection->insert($data);
		return $data;
	}
	/**
	 * 根据用户id查找简历,返回整个简历信息
	 *
	 * @param \MongoId $uid        	
	 * @return array
	 */
	public function findByUid(\MongoId $uid) {
		$resume = $this->collection->findOne(array('uid' => $uid));
		if ($resume) {
			$rid = $resume['_id'];
			$mInfo = new Info();
			$resume ['info'] = $mInfo->findByRid($rid);
			$mContact = new Contact();
			$resume['contact'] = $mContact->findByRid($rid);
			$mJob = new Job();
			$resume['job'] = $mJob->findByRid($rid);
			$mEdu = new Edu();
			$resume['edu'] = $mEdu->findByRid($rid);
			$mExp = new Exp();
			$resume['exp'] = $mExp->findByRid($rid);
			return $resume;
		}
		return NULL;
	}
	/*
	 * 根据简历id更新简历最后修改时间
	 * @param \MongoId $_id
	 * 
	 */
	public function updateEditTime(\MongoId $_id, $editTime = NULL) {
		if ($editTime) {
			if (!is_subclass_of($editTime, '\MongoDate')) {
				throw new \Exception('The type of editTime is not a MongoDate type');
			}
			$data['editTime'] = $editTime;
		} else {
			$data['editTime'] = new \MongoDate();
		}
		return $this->collection->update(array('_id' => $_id), array('$set' => $data));
	}
}
