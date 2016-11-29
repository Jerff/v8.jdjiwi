<?php

// компиляция
// 0 - режим отладки
// при режиме > 0 уже юзается общие скомпилированные файлы для морды и админа
// 1 - юзается общие скомпилированные файлы для морды и админа
// 2 - режим компиляции php файлов
define('cmfComplile', 0);

// определяем домен
//define('cmfDomen',		'www.dev.southmoon.ru');
define('cmfDomen',		'v8.jdjiwi.ru');
define('cmfMainPath',	'');

// драйвер для кеша
define('cmfCacheDriver', 'sql');
// конфигурация мемкеша
define('cmfMemcacheHost', 'localhost');
define('cmfMemcachePort', 11211);

define('cmfSphinxHost', 'localhost');
define('cmfSphinxPort', 3312);

// префикс к таблицам
define('cmfDbPefix', 's16_');


// концигурации базы данных
define('cmfMysqlHost', 		'localhost');
define('cmfMysqUser', 		'dev-southmoon-ru');
define('cmfMysqPassword',	'dev-southmoon-ru');
define('cmfMysqDb',			'dev-southmoon-ru');

// концигурации базы данных
define('cmfSQLiteDb', 		'mydb.sq3');


// концигурации базы данных
define('cmfSourse', cmfRoot .'dev.southmoon.ru.sourse/');
define('cmfWWW', cmfRoot .'public_html/');

// Соль
define('cmfSalt',		'6z3WBO4GN8');


//ImageMagick
define('isImageMagick', 1);
define('cImageMagickProg', '');
define('cImageMagickPath', '/usr/local/bin/');
setlocale(LC_ALL, array('ru_RU.utf-8', 'rus_RUS.utf-8'));

?>