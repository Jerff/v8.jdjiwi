<?php

cmfLoad('pages/cmfPagesDriver');
cmfLoad('pages/main/function');
class cmfPages extends cmfPagesDriver {

	public static function select(&$_p, &$_n, &$_pr, &$t) {
		self::setPage($_p);
		self::setTemplates($t);
		if(cmfPart!=='main') {
            return;
		}

		$url = parse_url('http://'. $_SERVER['HTTP_HOST'] . substr($_SERVER['REQUEST_URI'], strlen(cmfMainPrefix)), PHP_URL_PATH);
		$url = urldecode($url);

		$page = '/404/';
		$_param = null;
		if(isset($_n[cmfPart][$url])) {
			$page = $_n[cmfPart][$url];
			unset($_n);
		} else if(isset($_pr[cmfPart])) {
			unset($_n);
			while(list($k, $v) = each($_pr[cmfPart])) {
				foreach($v as $p)
					if(preg_match($p, $url, $pr)) {
						$page = $k;
						$_param = $pr;
						break;
					}
		        if(!is_null($_param)) break;
			}
		}
		if($page==='/404/') {
			header("HTTP/1.0 404 Not Found");
		}
		if($_param) array_shift($_param);
		self::setMain($page);
		self::setParam($_param);
	}

}

?>
