<?php

include_once(cmfModel .'header.include.php');


cmfLoad('user/cmfUserRegister');
$userRegister = new cmfUserRegister('fancyboxUserRegister');
$this->assing('userRegister',	$userRegister);
$this->assing('form',			$userRegister->getForm(1));
$this->assing('formAll',		$userRegister->getForm(2));


$content = cmfRegister::getSql()->placeholder("SELECT content  FROM ?t WHERE name='Личный кабинет: Регистрация: fancybox'", db_content_static)
                                            ->fetchRow(0);
$this->assing('content', $content);
cmfDebug::destroy();

?>