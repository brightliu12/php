<?php
require '../src/Sys/Init/Web.php';

$web = new Sys\Init\Web ();
$web->init ( array (
		'debug' => true 
) )->run ();
