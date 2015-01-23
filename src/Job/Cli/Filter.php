<?php

namespace Job\Cli;

use Sys\Controller\Common as Controller;
use Job\Model\Job;

class Filter extends Controller {
	public function actionSalary() {
		$txt = '';
		
		$mJob = new Job ();
		$cursor = $mJob->find ();
		// $cursor->limit ( 100 );
		while ( $cursor->hasNext () ) {
			$row = $cursor->getNext ();
			$salary = $row ['salary'];
			
			list ( $salary ) = explode ( ',', $salary );
			$salaryFilter = $salary;
			$salaryFilter = preg_replace ( '/[^0-9]+/', ' ', $salaryFilter );
			$salaryFilter = trim ( $salaryFilter );
			$salaryFilter = preg_replace ( '/\s{2,}+/', ' ', $salaryFilter );
			
			if (strpos ( $salaryFilter, ' ' )) {
				list ( $min, $max ) = explode ( ' ', $salaryFilter );
			} else {
				$min = $max = $salary;
			}
			
			$min = ( int ) $min;
			$max = ( int ) $max;
			
			if ($min || $max) {
				if (strpos ( $salary, '万' ) || strpos ( $salary, '萬' )) {
					$min = $min * 10000;
					$max = $max * 10000;
				}
				
				if (strpos ( $salary, '天' ) || strpos ( $salary, '日' )) {
					$min *= 30;
					$max *= 30;
				} else if (strpos ( $salary, '星期' ) || strpos ( $salary, '周' )) {
					$min *= 4;
					$max *= 4;
				} else if (strpos ( $salary, '年' )) {
					$min = $min / 12;
					$max = $max / 12;
				}
				
				/*
				 * else if ($min <= 500 && $max <= 500) { // 工资低于500，默认为日薪 $min *= 30; $max *= 30; } else if ($min > 50000 && $max > 50000) { // 工资超过50000，默认为年薪 $min = $min / 12; $max = $max / 12; }
				 */
				
				$min = intval ( $min );
				$max = intval ( $max );
			}
			
			// $txt .= " $salary : $min : $max " . (string) $row['_id'] . "\n";
			
			$mJob->updateById ( $row ['_id'], array (
					'salaryMin' => $min,
					'salaryMax' => $max 
			) );
		}
		// file_put_contents(PATH_TEMP . 'salary.log', $txt);
	}
	
	public function actionExperience() {
		$txt = '';
		
		$cNum = array (
				'一',
				'二',
				'三',
				'四',
				'五',
				'六',
				'七',
				'八',
				'九',
				'十' 
		);
		$eNum = array (
				1,
				2,
				3,
				4,
				5,
				6,
				7,
				8,
				9,
				'*10+' 
		);
		
		$mJob = new Job ();
		$cursor = $mJob->find ();
		// $cursor->limit ( 100 );
		while ( $cursor->hasNext () ) {
			$row = $cursor->getNext ();
			$experience = $row ['experience'];
			
			$experience = str_replace ( $cNum, $eNum, $experience );
			$experience = preg_replace ( '/[^0-9\*\+]+/', ' ', $experience );
			$experience = trim ( $experience );
			$experience = preg_replace ( '/\s{2,}+/', ' ', $experience );
			
			if (strpos ( $experience, ' ' )) {
				list ( $min, $max ) = explode ( ' ', $experience );
			} else {
				$min = $max = $experience;
			}
			
			if (substr ( $min, 0, 3 ) == '*10') {
				$min = '1' . $min;
			}
			if (substr ( $min, - 4 ) == '*10+') {
				$min .= '0';
			}
			$min = (int) eval ( 'return ' . $min . ';' );
			
			if (substr ( $max, 0, 3 ) == '*10') {
				$max = '1' . $max;
			}
			if (substr ( $max, - 4 ) == '*10+') {
				$max .= '0';
			}
			$max = (int) eval ( 'return ' . $max . ';' );
			
			// $txt .= "{$row ['experience']} : $min : $max \n";
			
			$mJob->updateById ( $row ['_id'], array (
					'experienceMin' => $min,
					'experienceMax' => $max 
			) );
		}
		
		// file_put_contents(PATH_TEMP . 'experience.log', $txt);
	}
	
	public function actionType() {
		$txt = '';
		$mJob = new Job ();
		$cursor = $mJob->find ();
		while ( $cursor->hasNext () ) {
			$row = $cursor->getNext ();
			$type = $row ['type'];
			
			list ( $type ) = explode ( ',', $type );
			$type = strip_tags($type);

			// $txt .= $type . "\n";continue;
			
			$mJob->updateById ( $row ['_id'], array (
					'type' => $type
			) );
		}
		
		// file_put_contents(PATH_TEMP . 'type.log', $txt);
	}	
}