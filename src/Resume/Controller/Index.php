<?php

namespace Resume\Controller;

use Sys\Controller\Common as Controller;
use Resume\Model\Resume;
use Resume\Model\Info;
use User\Model\U;
use Resume\Model\Contact;
use Resume\Model\Job;
use Resume\Model\Edu;
use Resume\Model\Exp;
use Resume\Form\Info as FormInfo;
use Resume\Form\Edu as FromEdu;
use Resume\Form\Exp as FromExp;
use Resume\Form\Contact as FromContact;
use Resume\Form\Job as FromJob;
use Sys\Exception\Validate as ExceptionValidate;

class Index extends Controller {
	public function actionIndex() {
		$data = NULL;
		if (isset($_POST['submit'])) {
			$data = array();
			$data['city'] = empty($_POST['city']) ? NULL : $_POST['city'];
			$data['education'] = empty($_POST['education']) ? NULL : $_POST['education'];
			$data['sex'] = empty($_POST['sex']) ? NULL : $_POST['sex'];
			$data['type'] = empty($_POST['type']) ? NULL : $_POST['type'];
			$data['intent'] = empty($_POST['title']) ? NULL : $_POST['title'];
			$data['salary'] = empty($_POST['salary']) ? NULL : $_POST['salary'];
			if ($data) {
				$mResume = new Resume();
				$data = $mResume->search($data, 1);
			}
		}
		$this->display('Resume/Index/Index', array('data' => $data));
	}
	public function actionShow() {
		$U = new U();
		$isLogin = $U->isLogin();
		if (!$isLogin) {
			exit('请先登录');
		}
		$uid = $U->getUserId();
		$mResume = new Resume();
		$data = $mResume->findByUid($uid);
		if (!$data) {
			$data = $mResume->add($uid);
		}
		$this->display('Resume/Index/Show', array('data' => $data));
	}
	public function actionSubscribe() {
		$this->display('Resume/Index/Subscribe');
	}
	/*
	 * 更新简历数据
	 */
	public function actionUpdate() {
		
		$type = @ $_GET['form-type'];
		if ($type) {
			$U = new U();
			$uid = $U->getUserId();
			
			// 获取当前用户的简历ID
			if (empty($_POST['rid'])) {
				$mResume = new Resume();
				$data = $mResume->findByUid($uid);
				if (!$data) {
					$data = $mResume->add($uid);
				}
				$_POST['rid'] = (string) $data['_id'];
			}
			
			switch ($type) {
				case 'info':
					$infoForm = new FormInfo();
					if ($infoForm->collectData()) {
						try {
							$data = $infoForm->getData();
							//数据后续处理
							$data['rid'] = new \MongoId($data['rid']);	
							$rid = $data['rid'];
							$data['uid'] = $uid;
							//更新数据
							$mInfo = new Info();
							$mInfo->updateByRid($rid, $uid, $data);
							$this->json(array('isValid' => true));
						} catch (ExceptionValidate $e) {
							$this->json(array('isValid' => false, 'error' => $e->getError()));
						}
					}
					break;
				case 'contact':
					$contactForm = new FromContact();
					if ($contactForm->collectData()) {
						try {
							$data = $contactForm->getData();
							//数据后续处理
							$data['rid'] = new \MongoId($data['rid']);
							$rid = $data['rid'];
							$data['uid'] = $uid;
							//更新数据
							$mContact = new Contact();
							$mContact->updateByRid($rid, $uid, $data);
							$this->json(array('isValid' => true));
						} catch (ExceptionValidate $e) {
							$this->json(array('isValid' => false, 'error' => $e->getError()));
						}
					}
					break;
				case 'job':
					$contactJob = new FromJob();
					if ($contactJob->collectData()) {
						try {
							$data = $contactJob->getData();
							//数据后续处理
							$data['rid'] = new \MongoId($data['rid']);
							$rid = $data['rid'];
							$data['uid'] = $uid;
							//更新数据
							$mJob = new Job();
							$mJob->updateByRid($rid, $uid, $data);
							$this->json(array('isValid' => true));
						} catch (ExceptionValidate $e) {
							$this->json(array('isValid' => false, 'error' => $e->getError()));
						}
					}
					break;
				case 'edu':
					$contactEdu = new FromEdu();
					if ($contactEdu->collectData()) {
						try {
							$data = $contactEdu->getData();
							//数据后续处理
							if (array_key_exists('start_time', $data)) {
								$data['start_time'] = new \MongoDate(strtotime($data['start_time']));
							}
							if (array_key_exists('end_time', $data)) {
								$data['end_time'] = new \MongoDate(strtotime($data['end_time']));//var_dump($data);die();
							}
							$data['rid'] = new \MongoId($data['rid']);
							$rid = $data['rid'];
							$data['uid'] = $uid;
							//更新数据
							$mEdu = new Edu();
							$mEdu->updateByRid($rid, $uid, $data);
							$this->json(array('isValid' => true));
						} catch (ExceptionValidate $e) {
							$this->json(array('isValid' => false, 'error' => $e->getError()));
						}
					}
					break;
				case 'exp':
					$contactExp = new FromExp();
					if ($contactExp->collectData()) {
						try {
							$data = $contactExp->getData();
							//数据后续处理
							if (array_key_exists('start_time', $data)) {
								$data['start_time'] = new \MongoDate(strtotime($data['start_time']));
							}
							if (array_key_exists('end_time', $data)) {
								$data['end_time'] = new \MongoDate(strtotime($data['end_time']));//var_dump($data);die();
							}
							$data['rid'] = new \MongoId($data['rid']);
							$rid = $data['rid'];
							$data['uid'] = $uid;
							//更新数据
							$mExp = new Exp();
							$mExp->updateByRid($rid, $uid, $data);
							$this->json(array('isValid' => true));
						} catch (ExceptionValidate $e) {
							$this->json(array('isValid' => false, 'error' => $e->getError()));
						}
					}
					break;
				default:
					$this->json(array('isValid' => false, 'error' => 'null type'));
					break;
			}
		} else {
				throw new \Exception('The type value is null');
		}
	}
}
