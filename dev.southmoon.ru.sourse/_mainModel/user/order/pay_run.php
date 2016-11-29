<?php


$orderId = cmfPages::getParam(1);
$modul = cmfPages::getParam(2);
$status = cmfOrder::getStatusList(0, 1, 2);
$sql = cmfRegister::getSql();
$order = $sql->placeholder("SELECT id, user, product, data, pay, price, isPay, registerDate, status FROM ?t WHERE id=? AND status ?@ AND `delete`='no'", db_basket, $orderId, array_keys($status))
			 ->fetchAssoc();
if(!$order) return 404;
if($order['isPay']==='yes') {
    cmfRedirect(cmfGetUrl('/user/order/one/', array($orderId)));
}
if($order['user']) {
    $user = cmfRegister::getUser();
    $user->filterIsUser();
    if($order['user']!= $user->getId()) {
        return 404;
    }
    $fio = cmfUser::generateName($user->all);

    cmfMenu::add('Личные кабинет', cmfGetUrl('/user/'));
    cmfMenu::add('История заказов', cmfGetUrl('/user/order/'));
} else {
    $fio = '';
}

cmfMenu::add('Заказ № '. $orderId, cmfGetUrl('/user/order/one/', array($orderId)));
cmfMenu::add('Оплата', cmfGetUrl('/user/order/pay/', array($orderId)));
cmfMenu::add('Оплата');

$this->assing('orderId', $orderId);
$this->assing('status', $status[$order['status']]);
$this->assing2('date', date('d.m.y', strtotime($order['registerDate'])));



list($countAll, $priceAll, $priceDiscount, $discount) = cmfString::unserialize($order['price']);
$this->assing('countAll', $countAll);
$this->assing('priceAll', $priceAll);
$this->assing('priceDiscount', $priceDiscount);
$this->assing('discount', $discount);


$pay = $sql->placeholder("SELECT id, data, name, commission FROM ?t WHERE modul=? AND visible='yes'", db_payment, $modul)
			 ->fetchAssoc();
if(!$pay) {
    cmfRedirect(cmfGetUrl('/user/order/pay/', array($orderId)));
}
$data = cmfString::unserialize($pay['data']);
$data['orderId'] = $orderId;
$data['fio'] = $fio;
$data['price'] = $order['pay'];
$data['commission'] = $pay['commission'];
$data['priceView'] = $priceDiscount;
$data['desc'] = "Оплата заказа №{$data['orderId']} для магазина ". cmfProjectUrl;
$data['sendUrl'] = cmfGetUrl('/user/order/pay/send/', array($orderId, $modul));
$data['successUrl'] = cmfGetUrl('/user/order/success/', array($modul));
$data['failUrl'] = cmfGetUrl('/user/order/fail/', array($modul));
$data['resulUrl'] = cmfGetUrl('/user/order/result/', array($modul));


list(, $email) = cmfString::unserialize($order['data']);
$data['orderEmail'] = $email['E-mail'];

cmfLoad('payment/cmfPayment');
if(!cmfPayment::start($modul, $data)) {
    return 404;
}

?>