<?php
namespace Resume\Model;

use Sys\Mongo\Collection;
use Sys\Validator\Data as ValidatorData;
use Sys\Exception\Validate as ExceptionValidate;

/*
 * 联系资料模型
 */
class Contact {
	protected $collection;
	protected $fields;
	public function __construct() {
		$this->collection = new Collection('resume.contact');
		$this->fields = array('uid', 'rid', 'email', 'phone');
	}
	/**
	 * 根据简历id查找联系资料
	 *
	 * @param \MongoId $rid       	
	 * @return array
	 */
	public function findByRid(\MongoId $rid) {
		return $this->collection->findOne(array('rid' => $rid));
	}

	/**
	 * 按照简历id更新联系资料
	 *
	 * @param \MongoId $rid        	
	 * @param array $data        	
	 * @return true
	 */
	public function updateByRid(\MongoId $rid,\MongoId $uid, array $data) {
		$validator = new ValidatorData($this->fields);
		// FIXME:: $rid, $uid 必填的
		//$validator->addRule('*', 'Required');取消必须填
		$validator->addRule('email', 'Email');
		$validator->addRule('phone', 'String');
		$validator->addRule('uid,rid', 'MongoId');
		if ($validator->isValid($data)) {
			$this->collection->update(array('rid' => $rid,'uid'=>$uid), array('$set' => $data), array('upsert' => true));
			//更新简历的修改时间
			$mResume = new Resume();
			$mResume ->updateEditTime($rid);
			return true;
		} else {
			throw new ExceptionValidate($validator->getMessages(), $data);
		}
	}
}
