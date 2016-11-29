<?php


cmfRegister::getUser()->filterNoUser();

cmfLoad('user/cmfUserRecoverPassword');
$cmfUserEnter = new cmfUserRecoverPassword();
$this->assing('password', $cmfUserEnter);
$this->assing('form', $cmfUserEnter->getForm());

$content = cmfRegister::getSql()->placeholder("SELECT content  FROM ?t WHERE name='Личный кабинет: Восстановление пароля'", db_content_static)
							->fetchRow(0);
$this->assing('content', $content);

?>