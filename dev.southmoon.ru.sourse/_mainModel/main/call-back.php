<?php

if(isset($_GET['fancybox'])) {
    return '/call-back/fancybox/';
}


cmfLoad('form/cmfCallBack');
$callBack = new cmfCallBack();
if(!$callBack->isOn()) return 404;
$this->assing('callBack', $callBack);
$this->assing('form',      $callBack->getForm());

$content = cmfRegister::getSql()->placeholder("SELECT content  FROM ?t WHERE name='Формы: Перезвоните мне'", db_content_static)
							->fetchRow(0);
$this->assing('content', $content);

?>