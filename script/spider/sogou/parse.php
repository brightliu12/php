<?php
require '../../../src/Sys/Init.php';

$_GET = array (
		'module' => 'spider',
		'controller' => 'Sogou',
		'action' => 'parse'
);
Core\Init::init ( 'Cli' );