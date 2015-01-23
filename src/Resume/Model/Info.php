<?php
namespace Resume\Model;
use Sys\Mongo\Collection;
use Sys\Validator\Data as ValidatorData;
use Sys\Exception\Validate as ExceptionValidate;
/*
 * 个人信息模型
 */
class Info {
	protected $fields;
	protected $collection;
	public function __construct() {
		$this->collection = new Collection('resume.info');
		$this->fields = array('uid','rid','name','sex','work_exp','live_city','edu');
	}
	/**
	 * 根据简历id查找个人信息
	 *
	 * @param \MongoId $rid       	
	 * @return array
	 */
	public function findByRid(\MongoId $rid) {
		return $this->collection->findOne(array('rid' => $rid));
	}
	/**
	 * 按照简历id更新个人信息
	 *
	 * @param \MongoId $rid        	
	 * @param array $data        	
	 * @return true
	 */
	public function updateByRid(\MongoId $rid,\MongoId $uid,array $data) {
		$validator = new ValidatorData($this->fields);
		// FIXME:: $rid, $uid 必填的		
		//$validator->addRule('*', 'Required');取消必须填
		$validator->addRule('name,sex,work_exp,live_city,edu', 'String');
		$validator->addRule('uid,rid', 'MongoId');
		if ($validator->isValid($data)) {
			$this->collection->update(array('rid' => $rid,'uid'=>$uid), array('$set' => $data), array('upsert' => true));
			//更新简历的修改时间
			$mResume = new Resume();
			$mResume ->updateEditTime($rid);
			return true;
		}else {
			throw new ExceptionValidate($validator->getMessages(), $data);
		}
	}
}
