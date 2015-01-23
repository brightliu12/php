<?php

namespace Content\Controller;

use Sys\Controller\Common as Controller;
use Sys\Exception\Validate as ExceptionValidate;
use Content\Model\Collect as ModelCollect;
use User\Model\U;
use Job\Model\Job;
use Sys\Validator\MongoId;

class Collect extends Controller {
	protected $uid;
	public function dispatch() {
		$U = new U ();
		if (!$U->isLogin()) {
			$this->json ( array (
					'isValid' => false,
					'errorType' => 'noLogin',
					'error' => '请先登录'
			) );
			return false;
		}
		$this->uid = $U->getUserId();
		parent::dispatch();
	}
	public function actionSearch() {
		$type = @ $_GET['type'] ?: 'job';
		$page = (int) @ $_GET['page'];

		$where = array('uid' => $this->uid, 'type' => $type);
		$mCollect = new ModelCollect();
		$result = $mCollect->search($where, $page);

		if ($result ['count']) {
			// TODO::不同类型怎么处理？？？
			$mJob = new Job();
			$jobList = array();
			foreach ($result ['data'] as $row) {
				$row['content'] = $mJob->findById($row ['cid']);
				$jobList [] = $row;
			}
			$result ['data'] = $jobList;
		}


		$this->display('Content/Collect/Search', $result);
	}

	public function actionAdd() {
		$type = @ $_GET ['type'];
		$cid = @ $_GET ['cid'];

		try {
			$collect = new ModelCollect ();
			$collect->add ( array (
					'uid' => $this->uid,
					'type' => $type,
					'cid' => $cid
			) );

			$this->json ( array (
					'isValid' => true
			) );

		} catch ( ExceptionValidate $e ) {
			$this->json ( array (
					'isValid' => false,
					'error' => $e->getError ()
			) );
		}
	}

	public function actionDelete () {
		$id = @ $_GET['id'];
		$validator = new MongoId();
		if ($id && $validator->isValid($id)) {
			$collect = new ModelCollect();
			$collect->delete($id, $this->uid);
		}
		$this->goBack();
	}
}