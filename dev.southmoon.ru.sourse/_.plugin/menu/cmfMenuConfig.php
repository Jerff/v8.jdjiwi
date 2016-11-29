<?php


class cmfMenuConfig {

    static public function getUrl($id) {
        switch($id) {
            case 'index':
                return array('name'=>'Главная',
                             'url'=>cmfGetUrl('/index/'));
            case 'news':
                return array('name'=>'Новости',
                             'url'=>cmfGetUrl('/news/all/'));
            case 'contact':
                return array('name'=>'Контакты',
                             'url'=>cmfGetUrl('/contact/'));

			case 'adress':
                return array('name'=>'',
							 'url'=>'');

            default:
                $id2 = (int)$id;
                static $tmp1, $tmp2;

                switch(str_replace($id2, '', $id)) {
                    case 'menu':
                        if(!$tmp1) {
                            $tmp1 = cmfRegister::getSql()->placeholder("SELECT id, name, isUri as url FROM ?t WHERE isVisible='yes'", db_content_info)
                                                        ->fetchAssocAll('id');
                            foreach($tmp1 as $k=>$row) {
                                $tmp1[$k] = array('name'=>$row['name'],
                                                  'url'=>cmfGetUrl('/info/', array($row['url'])));

                            }
                        }
                        if(isset($tmp1[$id2])) return $tmp1[$id2];
                        break;

                    case 'content':
                        if(!$tmp2) {
                            $tmp2 = cmfRegister::getSql()->placeholder("SELECT id,  name, isUri as url FROM ?t WHERE isVisible='yes'", db_content)
	                									->fetchAssocAll('id');
		                	foreach($tmp2 as $k=>$row) {
			                	$tmp2[$k] = array('name'=>$row['name'],
			                					  'url'=>cmfGetUrl('/content/', array($row['url'])));

			                }
		                }
		                if(isset($tmp2[$id2])) return $tmp2[$id2];
                        break;
                }
		}
		return false;
    }

}

?>