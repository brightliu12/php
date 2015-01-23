<?php

namespace Spider\Controller;

class Sogou extends Common {
	protected $task = 'sogou';
	protected $stopFile = 'sogou/stop';
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
		while ( 1 ) {
			$this->checkRun ();
			$model->run ();
			break;
			sleep ( 1 );
		}
	}
}