<?php

namespace Job\Controller;

use Sys\Controller\Common as Controller;
use Job\Model\Job;
use Sys\Validator\MongoId;
use User\Model\U;
use Job\Model\Apply as ModelApply;

class Apply extends Controller {
	public function actionSearch() {
		$U = new U ();
		if (!$U->isLogin()) {
			$this->json ( array (
					'isValid' => false,
					'errorType' => 'noLogin',
					'error' => '请先登录'
			) );
			return false;
		}
		$uid = $U->getUserId();
		$page = (int) @ $_GET['page'];

		$where = array('uid' => $uid);
		$apply = new ModelApply();
		$result = $apply->search($where, $page);

		if ($result ['count']) {
			$mJob = new Job();
			$jobList = array();
			foreach ($result ['data'] as $row) {
				$row['job'] = $mJob->findById($row ['jobId']);
				$jobList [] = $row;
			}
			$result ['data'] = $jobList;
		}

		$this->display('Job/Apply/Search', $result);
	}
	public function actionApply() {
		$id = @ $_GET['id'];
		$validator = new MongoId();
		if ($id && $validator->isValid($id)) {
			$mJob = new Job();
			$job = $mJob->findById($id);

			$U = new U();
			if ($U->isLogin()) {
				$uid = $U->getUserId();
				$apply = new ModelApply();
				$apply->apply($job['_id'], $uid);
			}

			$this->display('Job/Apply/Apply',$job);
// 			$this->goBack($job['joburl']);
//  			return ;
		}else{
		echo '参数错误！';
		}
	}
}
