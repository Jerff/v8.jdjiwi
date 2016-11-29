<?php


$user = cmfRegister::getUser();
$user->filterIsUser();
$user->reset();

cmfLoad('user/cmfUserChangePassword');
if($changePassword = cmfCache::get('register')) {
    list($changePassword, $content) = $changePassword;
} else {

    $changePassword = new cmfUserChangePassword();
    $content = cmfRegister::getSql()->placeholder("SELECT content  FROM ?t WHERE name='Личный кабинет: смена пароля'", db_content_static)
    									->fetchRow(0);

	cmfCache::set('register', array($changePassword, $content), 'user');
}

cmfMenu::add('Личный кабинет', cmfGetUrl('/user/'));
cmfMenu::add('Изменить пароль');

$this->assing('password', $changePassword);
$this->assing('form', $changePassword->getForm());

$this->assing('content', $content);

?>