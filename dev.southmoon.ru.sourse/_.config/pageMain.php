<?php

$p = array();
// --------- служебные ---------
$p['/404/']=array(
't'=>0,
'part'=>'main',
'path'=>'404',
'noUrl'=>true
);

$p['/header/']=array(
'part'=>'main',
'path'=>'header',
'isMain'=>true
);

$p['/footer/']=array(
'part'=>'main',
'path'=>'footer',
'isMain'=>true,
'noUrl'=>true
);

$p['/index/footer/']=array(
'part'=>'main',
'path'=>'index.footer',
'noUrl'=>true
);

$p['/info/header/']=array(
'part'=>'main',
'path'=>'info.header',
'isMain'=>true
);

$p['/info/footer/']=array(
'part'=>'main',
'path'=>'info.footer',
'noUrl'=>true
);

$p['/catalog/header/']=array(
'part'=>'main',
'path'=>'catalog.header',
'isMain'=>true
);

$p['/catalog/footer/']=array(
'part'=>'main',
'path'=>'catalog.footer'
);

$p['/order/header/']=array(
'part'=>'main',
'path'=>'order.header',
'isMain'=>true
);
// --------- /служебные ---------

// --------- Главная ---------
$p['/index/']=array(
't'=>1,
'part'=>'main',
'url'=>'/',
'path'=>'main/index',
'noUrl'=>true
);

$p['/info/']=array(
't'=>0,
'part'=>'main',
'url'=>'/(1)/',
'path'=>'main/info'
);

$p['/info/fancybox/']=array(
'part'=>'main',
'path'=>'main/info.fancybox'
);

$p['/content/']=array(
't'=>0,
'part'=>'main',
'url'=>'/(1)/',
'path'=>'main/content'
);

$p['/call-back/']=array(
't'=>0,
'part'=>'main',
'url'=>'/call-back/',
'path'=>'main/call-back',
'noUrl'=>true
);

$p['/call-back/fancybox/']=array(
'part'=>'main',
'path'=>'main/call-back.fancybox',
'noUrl'=>true
);
// --------- /Главная ---------

// --------- Новости ---------
$p['/news/all/']=array(
't'=>0,
'part'=>'main',
'url'=>'/news/',
'path'=>'news/list'
);

$p['/news/page/']=array(
't'=>0,
'part'=>'main',
'url'=>'/news/page_(1)/',
'path'=>'news/list'
);

$p['/news/year/all/']=array(
't'=>0,
'part'=>'main',
'url'=>'/news/year/',
'path'=>'news/year'
);

$p['/news/year/all/page/']=array(
't'=>0,
'part'=>'main',
'url'=>'/news/year/page_(1)/',
'path'=>'news/year'
);

$p['/news/year/']=array(
't'=>0,
'part'=>'main',
'url'=>'/news/year/(1)/',
'path'=>'news/year'
);

$p['/news/year/page/']=array(
't'=>0,
'part'=>'main',
'url'=>'/news/year/(1)/page_(2)/',
'path'=>'news/year'
);

$p['/news/']=array(
't'=>0,
'part'=>'main',
'url'=>'/news/(1)/',
'path'=>'news/news'
);
// --------- /Новости ---------

// --------- Статьи ---------
$p['/article/all/']=array(
't'=>0,
'part'=>'main',
'url'=>'/article/',
'path'=>'article/list'
);

$p['/article/page/']=array(
't'=>0,
'part'=>'main',
'url'=>'/article/page_(1)/',
'path'=>'article/list'
);

$p['/article/']=array(
't'=>0,
'part'=>'main',
'url'=>'/article/(1)/',
'path'=>'article/article'
);
// --------- /Статьи ---------

// --------- Фоторепортажи ---------
$p['/photo/all/']=array(
't'=>0,
'part'=>'main',
'url'=>'/photo/',
'path'=>'photo/list'
);

$p['/photo/page/']=array(
't'=>0,
'part'=>'main',
'url'=>'/photo/page_(1)/',
'path'=>'photo/list'
);

$p['/photo/']=array(
't'=>0,
'part'=>'main',
'url'=>'/photo/(1)/',
'path'=>'photo/photo'
);
// --------- /Фоторепортажи ---------

// --------- Личный кабинет ---------
$p['/user/register/']=array(
't'=>4,
'part'=>'main',
'url'=>'/user/register/',
'path'=>'user/register',
'noUrl'=>true
);

$p['/user/register/fancybox/']=array(
'part'=>'main',
'path'=>'user/register.fancybox',
'noUrl'=>true
);

$p['/user/enter/']=array(
't'=>4,
'part'=>'main',
'url'=>'/user/enter/',
'path'=>'user/enter',
'noUrl'=>true
);

$p['/user/enter/fancybox/']=array(
'part'=>'main',
'path'=>'user/enter.fancybox',
'noUrl'=>true
);

$p['/user/']=array(
't'=>4,
'part'=>'main',
'url'=>'/user/',
'path'=>'user/user',
'brousers'=>false,
'!cache'=>true,
'noUrl'=>true
);

$p['/user/page/']=array(
't'=>4,
'part'=>'main',
'url'=>'/user/page_(1)/',
'path'=>'user/user',
'brousers'=>false,
'!cache'=>true,
'noUrl'=>true
);

$p['/user/info/']=array(
't'=>4,
'part'=>'main',
'url'=>'/user/info/',
'path'=>'user/info',
'brousers'=>false,
'!cache'=>true,
'noUrl'=>true
);

$p['/user/info/password/']=array(
't'=>4,
'part'=>'main',
'url'=>'/user/info/password/',
'path'=>'user/info.password',
'brousers'=>false,
'!cache'=>true,
'noUrl'=>true
);

$p['/user/info/subscribe/']=array(
't'=>4,
'part'=>'main',
'url'=>'/user/info/subscribe/',
'path'=>'user/info.subscribe',
'brousers'=>false,
'!cache'=>true,
'noUrl'=>true
);

$p['/user/exit/']=array(
't'=>4,
'part'=>'main',
'url'=>'/user/exit/',
'path'=>'user/exit',
'brousers'=>false,
'!cache'=>true,
'noUrl'=>true
);

$p['/user/command/']=array(
't'=>4,
'part'=>'main',
'url'=>'/user/command/(1)/',
'path'=>'user/command'
);

$p['/user/password/']=array(
't'=>4,
'part'=>'main',
'url'=>'/user/password/',
'path'=>'user/password',
'noUrl'=>true
);


// --------- Заказы ---------
$p['/user/order/']=array(
't'=>4,
'part'=>'main',
'url'=>'/user/order/',
'path'=>'user/order/list',
'brousers'=>false,
'!cache'=>true,
'noUrl'=>true
);

$p['/user/order/page/']=array(
't'=>4,
'part'=>'main',
'url'=>'/user/order/page_(1)/',
'path'=>'user/order/list',
'brousers'=>false,
'!cache'=>true,
'noUrl'=>true
);

$p['/user/order/one/']=array(
't'=>5,
'part'=>'main',
'url'=>'/user/order/(1)/',
'path'=>'user/order/order',
'brousers'=>false,
'!cache'=>true,
'noUrl'=>true
);

$p['/user/order/pay/']=array(
't'=>4,
'part'=>'main',
'url'=>'/user/order/(1)/pay/',
'path'=>'user/order/pay',
'brousers'=>false,
'!cache'=>true,
'noUrl'=>true
);

$p['/user/order/pay/run/']=array(
't'=>6,
'part'=>'main',
'url'=>'/user/order/(1)/(2)/',
'path'=>'user/order/pay_run',
'brousers'=>false,
'!cache'=>true,
'noUrl'=>true
);

$p['/user/order/pay/send/']=array(
't'=>6,
'part'=>'main',
'url'=>'/user/order/(1)/(2)/send/',
'path'=>'user/order/pay_run',
'brousers'=>false,
'!cache'=>true,
'noUrl'=>true
);

$p['/user/order/result/']=array(
'part'=>'main',
'url'=>'/user/order/(1)/result/',
'path'=>'user/order/result',
'brousers'=>false,
'!cache'=>true,
'noUrl'=>true
);

$p['/user/order/success/']=array(
'part'=>'main',
'url'=>'/user/order/(1)/success/',
'path'=>'user/order/success',
'brousers'=>false,
'!cache'=>true,
'noUrl'=>true
);

$p['/user/order/fail/']=array(
'part'=>'main',
'url'=>'/user/order/(1)/fail/',
'path'=>'user/order/fail',
'brousers'=>false,
'!cache'=>true,
'noUrl'=>true
);
// --------- /Заказы ---------
// --------- /Личный кабинет ---------

// --------- Поиск ---------
$p['/search/']=array(
't'=>2,
'part'=>'main',
'url'=>'/search/',
'path'=>'product/section',
'noUrl'=>true
);

$p['/section/search/']=array(
't'=>2,
'part'=>'main',
'url'=>'/search/(1)/',
'path'=>'product/section'
);
// --------- /Поиск ---------

// --------- Карзина заказов ---------
$p['/basket/']=array(
't'=>3,
'part'=>'main',
'url'=>'/basket/',
'path'=>'basket/basket',
'brousers'=>false,
'!cache'=>true,
'noUrl'=>true
);

$p['/basket/delivery/']=array(
't'=>3,
'part'=>'main',
'url'=>'/basket/delivery/',
'path'=>'basket/delivery',
'brousers'=>false,
'!cache'=>true,
'noUrl'=>true
);

$p['/basket/adress/']=array(
't'=>3,
'part'=>'main',
'url'=>'/basket/adress/',
'path'=>'basket/adress',
'brousers'=>false,
'!cache'=>true,
'noUrl'=>true
);

$p['/basket/subscribe/']=array(
't'=>3,
'part'=>'main',
'url'=>'/basket/subscribe/',
'path'=>'basket/subscribe',
'brousers'=>false,
'!cache'=>true,
'noUrl'=>true
);

$p['/basket/pay/']=array(
't'=>3,
'part'=>'main',
'url'=>'/basket/pay/',
'path'=>'basket/pay',
'brousers'=>false,
'!cache'=>true,
'noUrl'=>true
);

$p['/basket/confirmation/']=array(
't'=>3,
'part'=>'main',
'url'=>'/basket/confirmation/',
'path'=>'basket/confirmation',
'brousers'=>false,
'!cache'=>true,
'noUrl'=>true
);

$p['/basket/ok/']=array(
't'=>3,
'part'=>'main',
'url'=>'/basket/ok/',
'path'=>'basket/basket_ok',
'noUrl'=>true
);

$p['/basket/none/']=array(
't'=>0,
'part'=>'main',
'path'=>'basket/none',
'brousers'=>false,
'!cache'=>true,
'noUrl'=>true
);
// --------- /Карзина заказов ---------

// --------- Рассылка ---------
$p['/subscribe/']=array(
't'=>0,
'part'=>'main',
'url'=>'/subscribe/',
'path'=>'subscribe/subscribe',
'brousers'=>false,
'noUrl'=>true
);

$p['/subscribe/command/']=array(
't'=>0,
'part'=>'main',
'url'=>'/subscribe/command/(1)/',
'path'=>'subscribe/command'
);
// --------- /Рассылка ---------

// --------- Размеры ---------
$p['/info/size/']=array(
't'=>0,
'part'=>'main',
'url'=>'/info/size/',
'path'=>'size/info',
'noUrl'=>true
);

$p['/info/size/fancybox/']=array(
'part'=>'main',
'path'=>'size/info.fancybox',
'noUrl'=>true
);
// --------- /Размеры ---------

// --------- Товары ---------
$p['/catalog/url/']=array(
't'=>2,
'part'=>'main',
'path'=>'product/catalog_url',
'brousers'=>false,
'!cache'=>true,
'noUrl'=>true
);

$p['/catalog/']=array(
't'=>2,
'part'=>'main',
'url'=>'/(1)/',
'path'=>'product/section'
);

$p['/section/main/']=array(
't'=>2,
'part'=>'main',
'url'=>'/(1)/',
'path'=>'product/main'
);

$p['/section/']=array(
't'=>2,
'part'=>'main',
'url'=>'/(1)/',
'path'=>'product/section'
);

$p['/brand/']=array(
't'=>2,
'part'=>'main',
'url'=>'/(1)/',
'path'=>'product/section'
);

$p['/brand/section/']=array(
't'=>2,
'part'=>'main',
'url'=>'/(1)/(2)/',
'path'=>'product/section'
);

$p['/product/']=array(
't'=>7,
'part'=>'main',
'url'=>'/(1)/',
'path'=>'product/product'
);
// --------- /Товары ---------

$n = array();
$n['main']['/']='/index/';
$n['main']['/call-back/']='/call-back/';
$n['main']['/news/']='/news/all/';
$n['main']['/news/year/']='/news/year/all/';
$n['main']['/article/']='/article/all/';
$n['main']['/photo/']='/photo/all/';
$n['main']['/user/register/']='/user/register/';
$n['main']['/user/enter/']='/user/enter/';
$n['main']['/user/']='/user/';
$n['main']['/user/info/']='/user/info/';
$n['main']['/user/info/password/']='/user/info/password/';
$n['main']['/user/info/subscribe/']='/user/info/subscribe/';
$n['main']['/user/exit/']='/user/exit/';
$n['main']['/user/password/']='/user/password/';

$n['main']['/user/order/']='/user/order/';
$n['main']['/search/']='/search/';
$n['main']['/basket/']='/basket/';
$n['main']['/basket/delivery/']='/basket/delivery/';
$n['main']['/basket/adress/']='/basket/adress/';
$n['main']['/basket/subscribe/']='/basket/subscribe/';
$n['main']['/basket/pay/']='/basket/pay/';
$n['main']['/basket/confirmation/']='/basket/confirmation/';
$n['main']['/basket/ok/']='/basket/ok/';
$n['main']['/subscribe/']='/subscribe/';
$n['main']['/info/size/']='/info/size/';
$pr = array();
$pr['main']['/news/all/']=array('#^/news/page_([0-9]+)/$#');
$pr['main']['/news/year/all/']=array('#^/news/year/(([0-9]+)/)?(page_([0-9]+)/)?$#');
$pr['main']['/news/']=array('#^/news/([^/]+)/$#');
$pr['main']['/article/all/']=array('#^/article/page_([0-9]+)/$#');
$pr['main']['/article/']=array('#^/article/([^/]+)/$#');
$pr['main']['/photo/all/']=array('#^/photo/page_([0-9]+)/$#');
$pr['main']['/photo/']=array('#^/photo/([^/]+)/$#');
$pr['main']['/user/']=array('#^/user/page_([0-9]+)/$#');
$pr['main']['/user/command/']=array('#^/user/(command/.*)/$#');

$pr['main']['/user/order/']=array('#^/user/order/page_([0-9]+)/$#');
$pr['main']['/user/order/one/']=array('#^/user/order/([0-9]+)/$#');
$pr['main']['/user/order/pay/']=array('#^/user/order/([0-9]+)/pay/$#');
$pr['main']['/user/order/pay/run/']=array('#^/user/order/([0-9]+)/([^/]+)/(([^/]+)/)?$#');
$pr['main']['/user/order/result/']=array('#^/user/order/([^/]+)/result/$#');
$pr['main']['/user/order/success/']=array('#^/user/order/([^/]+)/success/$#');
$pr['main']['/user/order/fail/']=array('#^/user/order/([^/]+)/fail/$#');
$pr['main']['/subscribe/command/']=array('#^/subscribe/(command/.*)/$#');
$pr['main']['/catalog/url/']=array('#^(/((search)/)?((.*?)/)?(name/(.*?)/)?(param/([0-9-]+)/)?((sale|new)/)?(sort/(desc|asc|new|old)/)?(page_([0-9]+)/)?(limit/([0-9]+|all)/)?)$#');

$t = array();
$t[0] = 'main.info.php';
$t[1] = 'main.index.php';
$t[2] = 'main.catalog.php';
$t[3] = 'basket.index.php';
$t[4] = 'user.index.php';
$t[5] = 'user.order.php';
$t[6] = 'print.index.php';
$t[7] = 'main.product.php';
cmfPages::select($p, $n, $pr, $t);

?>