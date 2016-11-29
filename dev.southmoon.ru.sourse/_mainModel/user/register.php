<?php


cmfRegister::getUser()->filterNoUser();
if(isset($_GET['fancybox'])) {
    return '/user/register/fancybox/';
}


cmfLoad('user/cmfUserRegister');
$userRegister = new cmfUserRegister();
$this->assing('userRegister',	$userRegister);
$this->assing('form',			$userRegister->getForm(1));
$this->assing('formAll',		$userRegister->getForm(2));


$content = cmfRegister::getSql()->placeholder("SELECT content  FROM ?t WHERE name='Личный кабинет: Регистрация'", db_content_static)
							->fetchRow(0);
$this->assing('content', $content);

?>