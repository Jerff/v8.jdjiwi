<?php


cmfLoad('subscribe/cmfSubscribeYes');
$this->assing2('subscribeYes', new cmfSubscribeYes());
$this->assing2('contentYes', cmfRegister::getSql()->placeholder("SELECT content FROM ?t WHERE name='Рассылка: подписка'", db_content_static)
                            ->fetchRow(0));

cmfLoad('subscribe/cmfSubscribeNo');
$this->assing2('subscribeNo', new cmfSubscribeNo());
$this->assing2('contentNo', cmfRegister::getSql()->placeholder("SELECT content FROM ?t WHERE name='Рассылка: отписка'", db_content_static)
                            ->fetchRow(0));

?>