<?php

include_once(cmfModel .'header.include.php');

cmfLoad('user/cmfUserEnter');
$userEnter = new cmfUserEnter('leftUserEnter');
$this->assing('userEnter', $userEnter);
$this->assing('form',      $userEnter->getForm());
$this->assing2('passwordUrl', cmfGetUrl('/user/password/'));
///cmfDebug::destroy();

?>