<?php

namespace Sys\Filter;

class Html extends Common {
	public function filter(& $value) {
		$value = htmlentities ( $value, ENT_QUOTES, "UTF-8" );
	}
}