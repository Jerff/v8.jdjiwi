<?php


class cmfCacheSite {


	static public function readMainPage($file) {
        if(file_exists($file)) {
			readfile($file);
			//echo file_get_contents($file);
			exit;
		}
	}

	static public function readPage($file) {
        if(file_exists($file)) {
			return file_get_contents($file);
		}
		return false;
	}

	static public function savePage($file, &$c) {
        $base = dirname($file);
        if(!is_dir($base)) {
        	if(!cmfDir::mkdir($base)) return;
        }
        file_put_contents($file, $c);
	}

	static public function clearPage($main, $url=false) {
        if($url) {
            $url = str_replace(cmfBaseUrl, '', $url);

        } else {
            cmfDir::clear(cmfCachePage . self::hash($main) .'/');
        }
	}

	static public function clearUrl($url, $isSub=true) {
        $url = substr(str_replace(cmfBaseUrl, '', $url), 1);
        if($isSub) {
	        cmfDir::clear(cmfCache . $url, true);
        } else {
	        cmfDir::clear(cmfCache . $url .'5_qwerty/', true);
        }
	}


	// хеш
	static private function hash($n) {
		return cmfCrc32($n) . sha1($n);
	}

	// sub директории
	static private function folder($n) {
		return substr($n, 0, 2) .'/'. substr($n, 2, 2);
	}

	static public function getFileMain() {
		$file =  cmfCacheSite . substr($_SERVER['REQUEST_URI'], 1) .'5_qwerty/_'. cmfCacheUser::getCacheId() .'.html';
		$file = str_replace(array('/../', '/./', '?'), array('', '', '=+=/=+='), $file);
		return $file;
	}

	static public function getFilePageOfMain($main, $page) {
		$file = self::hash($main . $page);
		return cmfCachePage . self::hash($main) .'/'. self::folder($page) .'/'. self::folder($file) .'/'. $file;
	}
	static public function getFilePage($page) {
		$file = self::hash($page);
		return cmfCachePage . self::hash($page) .'/'. self::folder($file) .'/'. $file;
	}


	static public function getFilePageUrlOfMain($main, $page, $url) {
		$file = self::hash($main . $page. $url);
		return cmfCachePage . self::hash($main) .'/'. self::hash($url) .'/'. self::folder($page) .'/'. self::folder($file) .'/'. $file;
	}
	static public function getFilePageUrl($page, $url) {
		$file = self::hash($page . $url);
		return cmfCachePage . self::hash($page) .'/'. self::hash($url) .'/'. self::folder($file) .'/'. $file;
	}

}

?>