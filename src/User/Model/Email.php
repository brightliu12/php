<?php
namespace User\Model;
use Sys\Mongo\Collection;
class Email{
	protected $collection;
	public function __construct(){
		$this->collection = new Collection('user.sendEmail');
	}
	//插入要发的邮件数据
	public function insert($data){
		//设置20分钟数据消失
		$this->collection->ensureIndex(array('date'=>1),array('expireAfterSeconds'=>1200));
		$this->collection->insert($data);
		return $data;
	}
	/*
	 * 按照_id查找数据
	 */
	public function findById(\MongoId $_id){
		return $this->collection->findOne(array('_id'=>$_id),array('email'=>true));
	}
}