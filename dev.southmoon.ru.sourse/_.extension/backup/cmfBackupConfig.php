<?php


class cmfBackupConfig {

    static public function menu() {
        $menu = array();
        $menu['catalog']   = 'Каталог';
        $menu['info']      = 'Информация';
        $menu['seo']       = 'Seo данные';
        $menu['subscribe'] = 'Рассылка';
        $menu['config']    = 'Настройки';
        $menu['mail']      = 'Почта';
		$menu['pages']     = 'Система';
		return $menu;
    }



    static public function block($id) {
        $_noData = array();
        switch($id) {
            case 'catalog':
                $_table = array(db_sys_config,
                                db_section, db_section_is_brand, db_section_shop, db_brand, db_size,
                                db_product, db_product_id, db_product_url, db_product_image, db_product_attach,
                                db_param, db_param_select, db_param_checkbox,
                                db_param, db_param_group, db_param_group_select, db_param_group_notice, db_param_discount, db_color,
                                db_showcase, db_showcase_list, db_baner,
                                db_price_yandex,
                                db_content_url);
                break;

            case 'basket':
                $_table = array(db_sys_config,
                                db_basket, db_basket_order, db_basket_status,
                                db_payment, db_payment_log, db_payment_transactions,
                                db_delivery, db_delivery_region,
                                db_discount);
                break;

            case 'info':
                $_table = array(db_sys_config,
                                db_article, db_news,
                                db_sys_config,
                                db_main, db_menu,
                                db_content, db_content_pages, db_content_info, db_content_static,
                                db_content_url);
                break;

            case 'subscribe':
                $_table = array(db_subscribe, db_subscribe_mail, db_subscribe_status);
                break;

            case 'seo':
                $_table = array(db_sys_config,
                                db_seo_title, db_seo_counters, db_seo_sitemap);
                break;

            case 'config':
                $_table = array(db_sys_cron, db_sys_config, db_backup_site,
                                db_cache_data, db_cache_update);
                break;

            case 'user':
                $_table = array(db_user, db_user_data, db_user_ses, db_user_group_admin);
                break;

            case 'mail':
                $_table = array(db_mail_templates, db_mail_var, db_mail_list, db_mail_config);
                break;

            case 'pages':
                $_table = array(db_pages_admin, db_pages_main,
                                db_access_write, db_access_read, db_access_delete,
                                db_admin_cache);
                $_noData = array(db_admin_cache);
                break;
        }
        return array($_table, $_noData);
	}

}

?>
