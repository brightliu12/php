<?php
require '../../../src/Sys/Init.php';

$_GET = array (
		'module' => 'spider',
		'controller' => 'sogou',
		'action' => 'fetch'
);
Core\Init::init ( 'Cli' );