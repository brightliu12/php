<?php

namespace User\Controller;

use Sys\Controller\Common as Controller;
use Sys\Exception\Validate as ExceptionValidate;
use User\Model\User;
use User\Model\U;
use User\Form\Reg as FormReg;
use User\Form\Login as FormLogin;
use User\Form\Password as FormPassword;
use Org\PhpMailer\SendEmail;
use User\Model\Email;

class Index extends Controller {
	public function actionIndex() {
		$this->display('User/Index/Index');
	}

	/**
	 * 登陆
	 */
	public function actionLogin() {
		$loginForm = new FormLogin();
		if ($loginForm->collectData()) {
			try {
				$data = $loginForm->getData();
				$U = new U();
				$U->login($data);
				$this->json(array('isValid' => true));
			} catch (ExceptionValidate $e) {
				$this->json(array('isValid' => false, 'error' => $e->getError()));
			}
		}
	}

	/**
	 * 提交注册
	 */
	public function actionReg() {
		$regForm = new FormReg();
		if ($regForm->collectData()) {
			try {
				$data = $regForm->getData();
				if (empty($data['username'])) {
					$data['username'] = $data['email'];
				}
				$U = new U();
				$U->reg($data);
				$this->json(array('isValid' => true));
			} catch (ExceptionValidate $e) {
				$this->json(array('isValid' => false, 'error' => $e->getError()));
			}
		}
	}

	/**
	 * 异步判断邮箱是否注册过
	 */
	public function actionValidateEmail() {
		$email = @$_POST['value'];
		$isExisted = intval(@$_GET['isExisted']);
		if ($email) {
			$mUser = new User();
			if ((boolean) $mUser->findByEmail($email) == $isExisted) {
				$isValid = true;
			} else {
				$isValid = false;
			}
		} else {
			$isValid = false;
		}

		$this->json(array('isValid' => $isValid, 'value' => $email));
	}

	/**
	 * 忘记密码
	 */
	public function actionPassword() {
		$step = empty($_GET['step']) ? '' : $_GET['step'];
		switch ($step) {
		case '':
			if (IS_POST) {
				$email = $_POST['email'];
				if ($email) {
					//检查邮箱是否存在
					$mUser = new User();
					if ((boolean) $mUser->findByEmail($email) != 1) {
						exit('该邮箱不存在');
					}
					//保存要发的邮件入库
					$mMail = new Email();
					$data = array('email' => $email, 'date' => new \MongoDate());
					$res = $mMail->insert($data);
					$eid = $res['_id'];
					$mail = new SendEmail();
					if ($mail->send($email, $eid)) {
						$this->json(array('isValid' => true));
					} else {
						$this->json(array('isValid' => false));
					}
				}
			} else {
				$this->display('User/Index/Password');
			}
			break;
		case 'sendSuccess':
			$this->display('User/Index/Email.Send.Success');
			break;
		case 'update':
			$mMail = new Email();
			if (isset($_GET['id'])) {
				$_id = $_GET['id'];
				$_id = new \MongoId($_id);
				$data = $mMail->findById($_id);
				if (!$data) {
					exit('邮件已经过期了');
				}
				$this->display('User/Index/Password.Update', array('data' => $data)); //eid放在隐藏域里面
			}
			if (IS_POST) {
				$eid = $_POST['eid'];
				$eid = new \MongoId($eid);
				$res = $mMail->findById($eid);
				$email = $res['email'];
				$passwordForm = new FormPassword();
				if ($passwordForm->collectData()) {
					try {
						$data = $passwordForm->getData();
						$mUser = new User();
						$mUser->updatePassword($email, $data); // 更新密码
						$mail = new SendEmail(); //修改密码成功,发送第二封邮件
						if ($mail->send($email, $eid, 'changePasswordSuccess')) {
							$this->json(array('isValid' => true));
						} else {
							$this->json(array('isValid' => false,'error'=>'Sent email failure'));
						}
					} catch (ExceptionValidate $e) {
						$this->json(array('isValid' => false, 'error' => $e->getError()));
					}
				}
			} else {
				$this->display('User/Index/Password.Update');
			}
			break;
		case 'success':
			$this->display('User/Index/Password.Success');
			break;
		}
	}

	/**
	 * 退出登录
	 */
	public function actionLogout() {
		$U = new U();
		$U->logout();
		$this->goBack();
	}
}
