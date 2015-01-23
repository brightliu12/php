<?php

namespace Sys\Filter;

class Trim extends Common {
	public function filter(& $value) {
		$value = trim ( $value );
	}
}