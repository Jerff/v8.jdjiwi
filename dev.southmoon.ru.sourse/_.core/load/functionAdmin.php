<?php

//Загрузка составных админки
// загрузка модулей
cmfLoad('cache/cmfCacheAdmin');
function cmfModul($n) {
	if(!class_exists($n)) {
		if($n{0}==='_') {
			$n = '_'. str_replace('_', '/', substr($n, 1));
		} else {
            $n = str_replace('_', '/', $n);
		}
		cmfLoadFile(cmfAdminModel. $n .'.php');
	}
}

function &cmfModulLoad($n) {
	cmfModul($n);
	$n = new $n();
	return $n;
}


// загрузка внешних библиотек
set_include_path(get_include_path() .
    PATH_SEPARATOR . cmfSourse .'_mainAdminModel/');

function __autoload($name) {
    if(strpos($name, 'driver_')===0 or strpos($name, '_interface_')===0) {
    	$type = preg_replace('~(driver_|_interface_)(interface|controller|modul|db).*~', '$2', $name);
    	switch($type) {
     		case 'interface':
    		case 'controller':
     		case 'modul':
     		case 'db':
    			cmfLoadFile(cmfAdminModel .'_.'. $type .'/'. $name .'.php');    			return;
    	}
    } else {
        $type = preg_replace('~^(.*)(controller|modul|db)(.*)$~', '$2', $name);
        if(defined('isDebug')) var_dump($type);
        switch($type) {
     		case 'interface':
    		case 'controller':
     		case 'modul':
     		case 'db':
    			cmfLoadFile(cmfAdminModel . substr($name, 0, 1) . str_replace('_', '/', substr($name, 1)) .'.php');
    			return;
    	}
    }

    if(strpos($name, 'view_')===0) {
    	cmfLoadFile(cmfAdminModel .'_.view/'. $name .'.php');
    	return;
    }

    if(strpos($name, 'model_')!==false) {
    	cmfLoadFile(cmfAdminModel. preg_replace('~(model_)([^_]+)(.*).*~', '$2/$1$2$3', $name) .'.php');
    	return;
    }

    // автоматическая загрузка классов
    if(substr($name, 0, 3)!=='cmf') return;
    if(!class_exists('cmfAdminAutoload')) return;

    cmfAdminAutoload::autoload($name);
}

?>