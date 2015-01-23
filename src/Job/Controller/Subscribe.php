<?php

namespace Job\Controller;

use Sys\Controller\Common as Controller;
use Sys\Exception\Validate as ExceptionValidate;
use Content\Model\Subscribe as ModelSubscribe;
use User\Model\U;
use Job\Form\Subscribe as FormSubscribe;

class Subscribe extends Controller {
	public function actionResult() {
		$U = new U ();
		if (! $U->isLogin ()) {
			$this->json ( array (
					'isValid' => false,
					'errorType' => 'noLogin',
					'error' => '请先登录' 
			) );
			return false;
		}
		
		$id = @ $_GET ['id'];
		$data = array ();
		if ($id) {
			$subscribe = new ModelSubscribe ();
			$row = $subscribe->findById ( new \MongoId ( $id ) );
			if ($row ['uid'] == $U->getUserId ()) {
				$this->goBack ( \url ( 'job/index/search', $row['info'] ) );
			}
		}
	}
	public function actionDelete() {
		$U = new U ();
		if (! $U->isLogin ()) {
			$this->json ( array (
					'isValid' => false,
					'errorType' => 'noLogin',
					'error' => '请先登录' 
			) );
			return false;
		}
		
		$id = @ $_GET ['id'];
		$data = array ();
		if ($id) {
			$subscribe = new ModelSubscribe ();
			$_id = new \MongoId ( $id );
			$row = $subscribe->findById ( $_id );
			if ($row ['uid'] == $U->getUserId ()) {
				$subscribe->delete ( $_id );
			}
		}
		$this->goBack ();
	}
	public function actionSearch() {
		$U = new U ();
		if (! $U->isLogin ()) {
			$this->json ( array (
					'isValid' => false,
					'errorType' => 'noLogin',
					'error' => '请先登录' 
			) );
			return false;
		}
		$uid = $U->getUserId ();
		$page = ( int ) @ $_GET ['page'];
		
		$where = array (
				'uid' => $uid,
				'type' => 'jobSearch' 
		);
		$subscribe = new ModelSubscribe ();
		$result = $subscribe->search ( $where, $page );
		
		$this->display ( 'Job/Subscribe/Search', $result );
	}
	public function actionAdd() {
		$U = new U ();
		if (! $U->isLogin ()) {
			$this->json ( array (
					'isValid' => false,
					'errorType' => 'noLogin',
					'error' => '请先登录' 
			) );
			return false;
		}
		
		$subscribeForm = new FormSubscribe();
		if ($subscribeForm->collectData ()) {
			$uid = $U->getUserId ();
			$info = $subscribeForm->getData ();
			$name = $info ['name'];
			unset($info ['name']);
			$data = array(
					'uid' => $uid,
					'type' => 'jobSearch',
					'info' => $info,
					'name' => $name
			);
			
			try {
				$subscribe = new ModelSubscribe ();
				$subscribe->add ( $data );
				
				$this->json ( array (
						'isValid' => true 
				) );
			} catch ( ExceptionValidate $e ) {
				$this->json ( array (
						'isValid' => false,
						'error' => $e->getError () 
				) );
			}
		} else {
			$id = @ $_GET ['id'];
			$data = array ();
			$data ['city'] = @ $_COOKIE ['currentCityCode'];
			$data ['city_name'] = @ $_COOKIE ['currentCityName'];
			
			if ($id) {
				$subscribe = new ModelSubscribe ();
				$row = $subscribe->findById ( new \MongoId ( $id ) );
				if ($row ['uid'] == $U->getUserId ()) {
					$data = $row;
				}
			} else {
				$data = array_merge($data, $_GET);
			}

			$this->display ( 'Job/Subscribe/Add', $data );
		}
	}
}