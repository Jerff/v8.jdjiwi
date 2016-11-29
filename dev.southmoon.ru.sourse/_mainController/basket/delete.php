<?php


cmfAjax::start();
cmfRegister::getUser()->is();
$r = cmfRegister::getRequest();
$res = cmfAjax::get();


cmfLoad('basket/cmfBasket');
$id = (int)$r->getPost('id');
$pId = (int)$r->getPost('pId');
$cId = (int)$r->getPost('cId');
if($id) {
	$basket = new cmfBasket();
	$basket->delProduct($id, $pId, $cId);
	list($header, $_basket, $countAll, $priceAll, $priceDiscount, $priceDelivery, $discount, $isDelivery, $delivery, $pricePay) = $basket->getBasketProduct();
	$basket->save();

    if(!$basket->isOrder()) {
    	$basket->disable();
    	$res->reload();
    } else {
        if($r->getPost('redirect')) {
            $res->reload();
        }

        $res->script("$('#basketList_{$id}_{$pId}_{$cId}').remove();")
            ->script("cmf.basket._header('{$countAll}', '{$priceAll}');");
        ob_start();

        ?>
            <b>Всего товаров на сумму</b>
            <b class="price"><i><?=$priceAll ?></i></b>
            <? if($discount) { ?>
                <b>Цена со скидкой</b>
                <b class="price"><i><?=$priceDiscount ?></i></b>
                <b>Скидка</b>
                <b class="price"><i><?=$discount ?></i></b>
            <? } ?>
        <?
        $res->html('#basketPrice', ob_get_clean());
    }

}


?>