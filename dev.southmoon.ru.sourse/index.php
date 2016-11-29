<?php

if(!defined('cmfPart'))
	define('cmfPart', 'main');

chdir(dirname(__FILE__));
define('cmfRoot', realpath(dirname(__FILE__) .'/../') .'/');

// конфигурация
require('_.config/config.php');
require('_.config/configProject.php');


// системный кеш
if(cmfComplile)  {
	require(cmfCompileLib .'.includeMain.php');
} else {

    require('.includeMain.php');
}
//cmfLoadConfig('configSite');
cmfPages::setBase($_b);
unset($_b);


//cmfDebug::setError();
//cmfDebug::setSql();
//cmfDebug::setExplain();
cmfCache::setPages();
cmfCache::setData();



error_reporting(E_ALL);
set_error_handler(array('cmfDebug', 'errorHandler'));
register_shutdown_function(array('cmfDebug', 'end'));


if(stripos($_SERVER['HTTP_HOST'], 'www.')===0) {
    cmfRedirectSeo('http://'. substr($_SERVER['HTTP_HOST'], 4) . $_SERVER['REQUEST_URI']);
}


// get_magic_quotes_gpc
cmfStripSlashesPost();

$admin = cmfRegister::getAdmin();
//pre($admin);
//exit;
if($admin->is()) {
	if($admin->debugError==='yes')	cmfDebug::setError();
	if($admin->debugSql==='yes')	cmfDebug::setSql();
	if($admin->debugExplain==='yes')cmfDebug::setExplain();
	//if($admin->debugCache==='yes')	cmfCache::setPages();
	//cmfCache::setData($admin->debugCache==='yes');
} else {
    cmfRedirect('/admin/');
    //echo 'Для просмотра нужна авторизация';
    //exit;
}
unset($admin);



cmfDebug::getMemory();

$controler = new cmfTemplateMain();
echo $controler->main();

cmfDebug::getMemory();

?>