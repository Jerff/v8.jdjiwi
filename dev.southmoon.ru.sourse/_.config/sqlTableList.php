<?php

define('db_price_yandex',		cmfDbPefix.'price_yandex');

define('db_baner',				cmfDbPefix.'baner');
define('cmfPathBaner',			cmfFilePath.'baner/');

define('db_showcase',			cmfDbPefix.'showcase');
define('db_showcase_list',		cmfDbPefix.'showcase_list');
define('cmfPathShowcase',		cmfFilePath.'showcase/');

define('db_section',			cmfDbPefix.'catalog');
define('db_section_is_brand',	cmfDbPefix.'catalog_is_brand');
define('db_section_shop',		cmfDbPefix.'catalog_shop');
define('db_brand',				cmfDbPefix.'catalog_brand');
define('db_size',			    cmfDbPefix.'catalog_size');
define('cmfPathCatalog',		cmfFilePath.'catalog/');
define('cmfPathCatalogShop',	cmfFilePath.'catalog/shop/');


define('db_product',			cmfDbPefix.'product');
define('db_product_id',			cmfDbPefix.'product_id');
define('db_product_url',		cmfDbPefix.'product_url');
define('db_product_image',		cmfDbPefix.'product_image');
define('db_product_attach',		cmfDbPefix.'product_attach');
define('db_product_dump',		cmfDbPefix.'product_dump');
define('db_product_dump_log',	cmfDbPefix.'product_dump_log');
define('cmfPathProduct',		cmfFilePath.'product/');
define('cmfPathSpecial',		cmfFilePath.'product/special/');
define('cmfPathWatermark',		cmfFilePath.'watermark/');


define('db_param_group',		cmfDbPefix.'param_group');
define('db_param_group_select',	cmfDbPefix.'param_group_select');
define('db_param_group_notice',	cmfDbPefix.'param_group_notice');
define('db_color',				cmfDbPefix.'param_group_color');

define('db_param_discount',		cmfDbPefix.'param_group_discount');
define('cmfPathDiscount',		cmfFilePath.'discount/');

define('db_discount',		    cmfDbPefix.'basket_discount');

define('db_param',				cmfDbPefix.'param');
define('db_param_select',		cmfDbPefix.'param_select');
define('db_param_checkbox',		cmfDbPefix.'param_checkbox');


define('db_main',				cmfDbPefix.'main');
define('db_main_image',			cmfDbPefix.'main_image');
define('cmfPathImage',		    cmfFilePath.'image/');

define('db_menu',				cmfDbPefix.'menu');

define('db_content',			cmfDbPefix.'content');
define('db_content_pages',		cmfDbPefix.'content_pages');
define('db_content_info',		cmfDbPefix.'content_info');
define('db_content_static',		cmfDbPefix.'content_static');
define('db_content_url',		cmfDbPefix.'content_url');


define('db_news',				cmfDbPefix.'news');
define('cmfPathNews',			cmfFilePath.'news/');

define('db_article',				cmfDbPefix.'article');
define('db_article_attach',			cmfDbPefix.'article_attach');
define('cmfPathArticle',			cmfFilePath.'article/');

define('db_photo',				cmfDbPefix.'photo');
define('db_photo_image',		cmfDbPefix.'photo_image');
define('cmfPathPhoto',			cmfFilePath.'photo/');

define('db_search',				cmfDbPefix.'search');


// кoрзина
define('db_basket',				cmfDbPefix.'basket');
define('db_basket_order',		cmfDbPefix.'basket_order');
define('db_basket_status',		cmfDbPefix.'basket_status');

define('db_payment',			    cmfDbPefix.'payment');
define('cmfPathPayment',		    cmfFilePath.'pay/');
define('db_payment_log',		    cmfDbPefix.'payment_log');
define('db_payment_transactions',   cmfDbPefix.'payment_transactions');

define('db_delivery',	        cmfDbPefix.'delivery');

define('db_sms_inform',	        cmfDbPefix.'sms_inform');
define('db_delivery_region',	cmfDbPefix.'delivery_region');


// Рассылка
define('db_subscribe',			cmfDbPefix.'subscribe');
define('db_subscribe_history',	cmfDbPefix.'subscribe_history');
define('db_subscribe_mail',		cmfDbPefix.'subscribe_mail');
define('db_subscribe_status',	cmfDbPefix.'subscribe_status');

define('db_subscribe_user',			cmfDbPefix.'subscribe_user');
define('db_subscribe_user_status',	cmfDbPefix.'subscribe_user_status');


// Визауальный редактор
define('cmfFileWysiwyng',	    cmfFilePath.'wysiwyng/');
define('cmfRootWysiwyng',	    cmfFilePath.'wysiwyng/');


// Почта
define('db_mail_templates',		cmfDbPefix.'mail_templates');
define('db_mail_var',			cmfDbPefix.'mail_var');
define('db_mail_list',			cmfDbPefix.'mail_list');
define('db_mail_config',		cmfDbPefix.'mail_config');



//seo
define('db_seo_title',			cmfDbPefix.'seo_title');
define('db_seo_counters',		cmfDbPefix.'seo_counters');
define('db_seo_sitemap',		cmfDbPefix.'seo_sitemap');


//user
define('db_user',				cmfDbPefix.'user');
define('db_user_ses',			cmfDbPefix.'user_ses');
define('db_user_data',			cmfDbPefix.'user_data');
define('db_user_group_admin',	cmfDbPefix.'user_group_admin');;


// система
define('db_sys_limit',			cmfDbPefix.'sys_limit');
define('db_backup_site',		cmfDbPefix.'sys_backup');
define('db_sys_config',			cmfDbPefix.'sys_config');
define('cmfPathConfig',		    cmfFilePath.'config/');
define('db_sys_cron',			cmfDbPefix.'sys_cron');

// страницы
define('db_pages_admin',		cmfDbPefix.'sys_pages_admin');
define('db_pages_main',			cmfDbPefix.'sys_pages_main');
define('db_access_read',		cmfDbPefix.'sys_access_read');
define('db_access_write',		cmfDbPefix.'sys_access_write');
define('db_access_delete',		cmfDbPefix.'sys_access_delete');


// кеш меню админки
define('db_admin_cache',		cmfDbPefix.'sys_cache_admin');
// кеш данных
define('db_cache_data',			cmfDbPefix.'sys_cache_data');
// обновление кеша
define('db_cache_update',		cmfDbPefix.'sys_cache_update');


?>