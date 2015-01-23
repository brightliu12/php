<?php

namespace User\Model;

use Sys\Mongo\Collection;
use Sys\Validator\Data as ValidatorData;
use Sys\Exception\Validate as ExceptionValidate;

class User {
	protected $collection;
	public function __construct() {
		$this->collection = new Collection ( 'user' );
	}
	/**
	 * 插入用户数据
	 *
	 * @param array $data        	
	 */
	public function insert(array $data) {
		$validator = new ValidatorData ( 'username, password, email' );
		$validator->addRule ( 'username, password', 'Required' );
		$validator->addRule ( 'username', 'User:UserName' );
		$validator->addRule ( 'username', array ( // 检测用户名是否唯一
				'validator' => 'MongoField',
				'collection' => 'user',
				'field' => 'username',
				'isExists' => false,
				'messageTpl' => '该用户名已被注册'
		) );
		$validator->addRule ( 'email', 'Email' );
		$validator->addRule ( 'email', array ( // 检测用户名是否唯一
				'validator' => 'MongoField',
				'collection' => 'user',
				'field' => 'email',
				'isExists' => false,
				'messageTpl' => '该邮件地址已被注册'
		) );
		$validator->addRule ( 'password', 'User:Password' );
		
		if ($validator->isValid ( $data )) {
			$row = array (
					'username' => $data ['username'],
					'password' => md5 ( $data ['password'] ),
					'email' => @ $data ['email'],
					'nickname' => @ $data ['nickname'],
					'regTime' => new \MongoDate () 
			);
			$this->collection->insert ( $row );
			return $row;
		} else {
			throw new ExceptionValidate ( $validator->getMessages (), $data );
		}
	}
	
	/**
	 * 根据ID查找数据
	 *
	 * @param MongoId $_id        	
	 */
	public function findById(\MongoId $_id) {
		return $this->collection->findOne ( array (
				'_id' => $_id 
		) );
	}
	
	/**
	 * 根据Email查找数据
	 *
	 * @param string $email        	
	 */
	public function findByEmail($email) {
		return $this->collection->findOne ( array (
				'email' => ( string ) $email 
		) );
	}
	
	/**
	 * 更新登录时间
	 *
	 * @param \MongoId $_id        	
	 */
	public function updateLoginTime(\MongoId $_id) {
		$this->collection->update ( array (
				'_id' => $_id 
		), array (
				'$set' => array (
						'loginTime' => new \MongoDate () 
				) 
		) );
	}
	/*
	 * 按照email更新密码
	 */
	public function updatePassword($email,array $data){
		unset($data['comfirm_password']);
		$data['password'] = md5($data['password']);
		$where = array('$set'=>$data);
		$this->collection->update(array('email'=>$email), $where);
		return true;
	}
}