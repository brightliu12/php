<?php

namespace Spider\Cli;

use Sys\Controller\Common;
use Sys\Mongo\Collection;

class Sogou extends Common {
	protected $task = 'sogou';
	protected $stopFile = 'sogou/stop';
	
	
	public function actionCheck () {
		$cData = new Collection('spider.sogou.data');
		$ccData = new Collection('spider.sogou.data_copy');
		$cursor = $ccData->find();
		
		while ($cursor->hasNext()) {
			$row = $cursor->getNext();
			if (! $cData->findOne(array('docid' => $row ['data'] ['docid']))) {
				$row ['docid'] = $row ['data'] ['docid'];
				$cData->insert($row);
			}
		}
	}
	
	public function actionParse() {
		$model = $this->getModel ( 'Parse' );
		while ( 1 ) {
			$this->checkRun ();
			$model->run ();
			sleep ( 1 );
		}
	}
	public function actionFetch() {
		echo "fetch action \n";
		$model = $this->getModel ( 'Fetch' );
		$model->init ();
		while ( 1 ) {
			$this->checkRun ();
			$model->run ();
			sleep ( 1 );
		}
	}
	public function actionData() {
		$model = $this->getModel ( 'Data' );
		$model->run ();
		return ;
		
		$model = $this->getModel ( 'Data' );
		while ( 1 ) {
			$this->checkRun ();
			$model->run ();
			break;
			sleep ( 1 );
		}
	}
	protected function getModel($modelName) {
		$modelClass = 'Spider\\Model\\' . $this->task . '\\' . $modelName;
		if (! class_exists ( $modelClass, TRUE )) {
			echo 'invalid model name : "' . $modelName . '"';
			die ();
		}
		return new $modelClass ();
	}
}