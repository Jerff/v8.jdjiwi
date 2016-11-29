<?php

	require('_.core/load/functionMain.php');
	cmfLoad('system/function');
	cmfLoad('system/javascript');
	cmfLoad('system/cmfString');
	cmfLoad('system/match');
	cmfLoad('url/function');


	cmfLoad('configAdmin');
	cmfLoad('configSite');
	cmfLoad('sqlTableList');


	cmfLoad('register/cmfRegister');
	cmfLoad('request/cmfRequest');
	cmfLoad('session/cmfSession');
	cmfLoad('cookie/cmfCookie');
	cmfLoad('global/cmfGlobal');
	cmfLoad('config/cmfConfig');
	cmfLoad('command/cmfCommand');


	cmfLoad('debug/cmfDebug');
	cmfLoad('compile/cmfCompileFile');


	cmfLoad('file/cmfDir');
	cmfLoad('file/cmfFile');

	cmfLoad('pages/main/cmfMainPages');

	cmfLoad('cache/cmfCache');
	cmfLoad('cache/cmfCacheSite');
	cmfLoad('cache/cmfCacheUser');

	cmfLoad('user/cmfAdmin');

?>
