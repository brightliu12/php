<?php

namespace Sys\Mongo;

class Collection extends \MongoCollection {
	public function __construct($name) {
		static $db = NULL;
		if (! $db) {
			$mongo = new \MongoClient (); // connect
			$db = $mongo->selectDB ( "youhuo" );
		}
		parent::__construct ( $db, $name );
	}
}