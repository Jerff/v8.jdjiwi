<?php


class cmfUrl {


	static public function reform($uri, $param) {
	    if($param===null) return $uri;

        reset($param);
        while(list($k, $v) = each($param))
			$uri = str_replace('('.($k+1).')', $v, $uri);
        return $uri;
	}

}

?>