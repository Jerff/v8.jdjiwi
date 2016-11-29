<?php

cmfLoadAjax();
cmfLoadRequest();


cmfLoad('user/cmfUserInfo');


$user = cmfRegister::getUser();
$user->filterIsUser();
$user->reset();


if($userInfo = cmfCache::get('user.info')) {
    list($userInfo, $content) = $userInfo;
} else {

    $userInfo = new cmfUserInfo();
    $content = cmfRegister::getSql()->placeholder("SELECT content  FROM ?t WHERE name='Личный кабинет: Личные данные'", db_content_static)
    									->fetchRow(0);

	cmfCache::set('user.info', array($userInfo, $content), 'user');
}
cmfMenu::add('Личные кабинет', cmfGetUrl('/user/'));
cmfMenu::add('Данные');

$userInfo->loadData();
$this->assing('userRegister',	$userInfo);
$this->assing('form',			$userInfo->getForm(1));
$this->assing('formAll',		$userInfo->getForm(2));

$this->assing('content', $content);

?>