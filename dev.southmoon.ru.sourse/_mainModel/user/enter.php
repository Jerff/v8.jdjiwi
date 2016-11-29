<?php


cmfRegister::getUser()->filterNoUser();
if(isset($_GET['fancybox'])) {
    return '/user/enter/fancybox/';
}


cmfLoad('user/cmfUserEnter');
$userEnter = new cmfUserEnter();
$this->assing('userEnter', $userEnter);
$this->assing('form',      $userEnter->getForm());
$this->assing2('passwordUrl', cmfGetUrl('/user/password/'));

?>