<?php


//���������
define('cmfCharset',		'UTF-8');


// �������� �������� �����
define('cmfIndexPrefix', cmfMainPath .'');
define('cmfAdminPrefix', cmfMainPath .'/admin');

// ������ �������� �����
$_b = array();
$_b['main'] = 'http://'. cmfDomen . cmfIndexPrefix;
$_b['admin'] = 'http://'. cmfDomen . cmfAdminPrefix;

// �������� ������ �����
switch(cmfPart) {
	case 'main':
	case 'cron':
	case 'controller':
		define('cmfMainPrefix', cmfIndexPrefix);
		break;

	case 'admin':
		define('cmfMainPrefix', cmfAdminPrefix);
		break;

	default:
		exit;
}
define('cmfProjectUrl', cmfDomen . cmfMainPrefix);

// ������������� ������ ��������
define('cmfBaseUrl', $_b['main']);
define('cmfAdminUrl', $_b['admin']);

// ������������� ������ ��� �������� ������� � ��������� �������
define('cmfProjectMain', cmfBaseUrl .'/');
define('cmfProjectAdmin', cmfAdminUrl .'/');
define('cmfBaseImg', cmfProjectMain);
define('cmfBaseImgOld', 'htpp://www.36-40.ru/');




// ��������� �����
define('cmfData',		cmfSourse .'.data/');

// ����� ��� ����
define('cmfCacheSite',	cmfWWW .'.cache/cache/');
define('cmfCachePage',	cmfData .'cache/page/');
define('cmfCacheSQLite',cmfData .'cache/SQLite/mydb.sq3');



// �����������, ������, �������������
define('cmfControllerUrl',	cmfProjectMain .'controller');

define('cmfController',		cmfSourse .'_mainController');
define('cmfModel',			cmfSourse .'_mainModel/');
define('cmfView',			cmfSourse .'_mainView/');
define('cmfTeplates',		cmfSourse .'_mainView/.templates/');


define('cmfAdminModel',		cmfSourse .'_mainAdminModel/');
define('cmfAdminView',		cmfSourse .'_mainAdminView/');
define('cmfAdminTeplates',	cmfSourse .'_mainAdminView/.templates/');



// ��������������� ���
define('cmfCompileLib',			cmfSourse .'.compile/lib/');
define('cmfCompileModel',		cmfSourse .'.compile/model/');
define('cmfCompileController',	cmfSourse .'.compile/controller/');




// ����� � upload �������
define('cmfFilePath', 'files/');


// ��������� ������
//unix
//setlocale (LC_ALL, array ('ru_RU.utf-8', 'rus_RUS.utf-8'));
//windows
setlocale(LC_ALL, "Russian_Russia.65001");

date_default_timezone_set('Europe/Moscow');

?>