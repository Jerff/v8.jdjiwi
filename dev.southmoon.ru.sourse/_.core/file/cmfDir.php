<?php


class cmfDir {

	const mode  = 0777;

	static public function isDir($dir) {
		return is_dir($dir);
	}

	static public function mkdir($dir, $mode=self::mode) {
		return !is_dir($dir) ? mkdir($dir, $mode, true) : true;
	}


	static public function clear($dir, $del=false) {
		if(!is_dir($dir)) return;
		foreach(scandir($dir) as $file) {
			if(is_dir($dir . $file)  and $file{0}!=='.') {
				self::clear($dir . $file .'/');
				rmdir($dir . $file .'/');
			} else {
				if(is_file($dir . $file) and $file{0}!=='.') {
					unlink($dir . $file);
				}
			}
		}
		sleep(1);
		if($del) {
			rmdir($dir);
		}
	}


	static public function getList($dir) {
        $_file = array();
        if(!is_dir($dir)) return $_file;
		foreach(scandir($dir) as $file) {
			if(is_file($dir . $file) and $file{0}!=='.') {
                $_file[] = $file;
			}
		}
		//ksort($_file);
		return $_file;
	}

	static public function getListDir($dir) {
        $_file = array();
        if(!is_dir($dir)) return $_file;
		foreach(scandir($dir) as $file) {
			if(is_dir($dir . $file) and $file{0}!=='.') {
                $_file[] = $file .'/';
			}
		}
		return $_file;
	}

}

?>
