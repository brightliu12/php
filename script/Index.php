<?php
require '../src/Sys/Init/Cli.php';

$cli = new Sys\Init\Web ();
$cli->init ( array (
		'debug' => true 
) )->run ();