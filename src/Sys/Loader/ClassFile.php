<?php

namespace Sys\Loader;

class ClassFile {
	public function load($className) {
		$path = PATH_SRC . str_replace ( '\\', DIRECTORY_SEPARATOR, $className ) . '.php';
		if (file_exists ( $path )) {
			require $path;
		}
	}
}