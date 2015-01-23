<?php

namespace User\Model;

use Sys\Mongo\Collection;


class Bind {
	protected $cBind;
	public function __construct() {
		$this->cBind = new Collection ( 'user.bind' );
	}
	/*
	 * 绑定uid和openid
	 */
	public function insert($data) {
		$this->cBind->insert ( $data );
		return $data;
	}
	/*
	 * 通过openid查找用户uid
	 */
	public function findByOpenId($openid,$type) {
		return $this->cBind->findOne ( array (
				'openid' => $openid,'type'=>$type 
		), array (
				'uid' => true 
		) );
	}
}
