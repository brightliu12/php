<?php

namespace Job\Controller;

use Sys\Controller\Common as Controller;
use Job\Model\Job;
use Sys\Validator\MongoId;

class Index extends Controller {
	public function actionSearch() {
		$where = array ();
		$where ['title'] = empty ( $_GET ['title'] ) ? NULL : $_GET ['title'];
		$where ['city'] = empty ( $_GET ['city'] ) ? NULL : $_GET ['city'];
		$where ['work_type'] = empty ( $_GET ['work_type'] ) ? NULL : $_GET ['work_type'];
		$where ['$and'] = array ();

		$salary = empty ( $_GET ['salary'] ) ? NULL : $_GET ['salary'];
		if ($salary) {
			$whereSalary = array ();
			switch ($salary) {
				case '低于1000' :
					$whereSalary = array (
							'salaryMin' => array (
									'$lt' => 1000
							),
							'salaryMax' => array (
									'$lte' => 1000
							)
					);
					break;
				case '1000-3000' :
					$whereSalary = array (
							'salaryMin' => array (
									'$gte' => 1000
							),
							'salaryMax' => array (
									'$lte' => 3000
							)
					);
					break;
				case '3000-6000' :
					$whereSalary = array (
							'salaryMin' => array (
									'$gte' => 3000
							),
							'salaryMax' => array (
									'$lte' => 6000
							)
					);
					break;
				case '6000-10000' :
					$whereSalary = array (
							'salaryMin' => array (
									'$gte' => 6000
							),
							'salaryMax' => array (
									'$lte' => 10000
							)
					);
					break;
				case '10000以上' :
					$whereSalary = array (
							'salaryMin' => array (
									'$gt' => 10000
							)
					);
					break;
			}
			if ($whereSalary) {
				$where ['$and'] [] = array(
						'$or' => array(
								// array('salaryMax' => 0),
								$whereSalary
						)
				);
			}
		}

		$experience = empty ( $_GET ['experience'] ) ? NULL : $_GET ['experience'];
		if ($experience) {
			switch ($experience) {
				case '应届生':
					$where ['experienceMin'] = array('$lt' => 1);
					break;
				case '1-3年':
					$where ['experienceMin'] = array('$gte' => 1);
					$where ['experienceMax'] = array('$lte' => 3);
					break;
				case '3-5年':
					$where ['experienceMin'] = array('$gte' => 3);
					$where ['experienceMax'] = array('$lte' => 5);
					break;
				case '5-10年':
					$where ['experienceMin'] = array('$gte' => 5);
					$where ['experienceMax'] = array('$lte' => 10);
					break;
				case '大于10年':
					$where ['experienceMin'] = array('$gte' => 10);
					break;
			}
		}

		$type = empty ( $_GET ['type'] ) ? NULL : $_GET ['type'];
		if ($type) {
			switch ($type) {
				case '全职':
					$where ['$and'] [] = array(
						'$or' => array(
							array('type' => '不限'),
							array('type' => '全职')
						)
					);
					break;
				case '兼职':
					$where ['$and'] [] = array(
							'$or' => array(
									array('type' => '不限'),
									array('type' => '兼职')
							)
					);
					break;
			}
		}

		$page = ( int ) @ $_GET ['page'];

		$mJob = new Job ();
		$result = $mJob->search ( $where, $page );

		$params = array_merge ( $result, $_GET );

		if (@ $_GET ['city_name']) {
			$expire = NOW_TIME + 3600 * 24 * 365;
			setcookie ( 'currentCityCode', $_GET ['city'], $expire );
			setcookie ( 'currentCityName', $_GET ['city_name'], $expire );
			$params ['city_name'] = empty ( $_GET ['city_name'] ) ? NULL : $_GET ['city_name'];
		} else {
			$params ['city'] = @ $_COOKIE ['currentCityCode'];
			$params ['city_name'] = @ $_COOKIE ['currentCityName'];
		}
		$this->display ( 'Job/Index/Search', $params );
	}
	public function actionShow() {
		$id = @ $_GET ['id'];
		$validator = new MongoId ();
		if ($id && $validator->isValid ( $id )) {
			$mJob = new Job ();
			$data = $mJob->findById ( $id );
			$this->display ( 'Job/Index/Show', $data );
		} else {
			echo '参数错误！';
		}
	}
	public function actionSubscribe() {
		$this->display ( 'Job/Index/Subscribe' );
	}
}
