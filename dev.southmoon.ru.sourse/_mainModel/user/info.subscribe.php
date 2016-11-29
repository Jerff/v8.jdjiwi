<?php


$user = cmfRegister::getUser();
$user->filterIsUser();
$user->reset();

cmfLoad('user/cmfUserSubscribe');
if($subscribe = cmfCache::get('subscribe')) {
    list($subscribe, $content) = $subscribe;
} else {

    $subscribe = new cmfUserSubscribe();
    $content = cmfRegister::getSql()->placeholder("SELECT content  FROM ?t WHERE name='Личный кабинет: рассылка'", db_content_static)
    									->fetchRow(0);

	cmfCache::set('subscribe', array($subscribe, $content), 'user');
}

cmfMenu::add('Личный кабинет', cmfGetUrl('/user/'));
cmfMenu::add('Рассылка');

$subscribe->loadData();
$this->assing('subscribe', $subscribe);
$this->assing('form', $subscribe->getForm());

$this->assing('content', $content);

?>