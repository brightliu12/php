<?php

namespace OpenApi\Model;

use Sys\Mongo\Collection;
use Sys\Exception\Validate as ExceptionValidate;
use Sys\Validator\Data as ValidatorData;

class Bind {
	protected $collection;
	public function __construct() {
		$this->collection = new Collection ( 'user.bind' );
	}
	
	/**
	 * 绑定uid和openid
	 */
	public function insert(array $data) {
		if (empty ( $data ['insertTime'] )) {
			$data ['insertTime'] = new \MongoDate ();
		}
		$validator = new ValidatorData ( 'uid, openid, type, info' );
		$validator->addRule ( '*', 'Required' );
		$validator->addRule ( 'uid', 'MongoId' );
		$validator->addRule ( 'openid, type', 'String' );
		$validator->addRule ( 'info', 'IsArray' );
		if ($validator->isValid ( $data )) {
			$this->collection->insert ( $data );
			return $data;
		} else {
			throw new ExceptionValidate ( $validator->getMessages (), $data );
		}
	}
	
	/**
	 * 通过openid查找用户uid
	 */
	public function findByOpenId($openId, $type) {
		return $this->collection->findOne ( array (
				'openid' => $openId,
				'type' => $type 
		), array (
				'uid' => true 
		) );
	}
}
