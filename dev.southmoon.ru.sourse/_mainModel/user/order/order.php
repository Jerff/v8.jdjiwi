<?php


$orderId = cmfGlobal::get('$orderId') ? cmfGlobal::get('$orderId') : cmfPages::getParam(1);
$status = cmfOrder::getStatusList(0, 1, 2);
$order = cmfRegister::getSql()->placeholder("SELECT id, EMS, deliveryDesc, user, product, data, isPay, isDelivery, registerDate, status, price FROM ?t WHERE id=? AND status ?@ AND `delete`='no'", db_basket, $orderId, array_keys($status))
								->fetchAssoc();
if(!$order) return 404;
if($order['user']) {
    $user = cmfRegister::getUser();
    $user->filterIsUser();
    if($order['user']!= $user->getId()) {
        return 404;
    }

    cmfMenu::add('Личные кабинет', cmfGetUrl('/user/'));
    cmfMenu::add('История заказов', cmfGetUrl('/user/order/'));
    cmfMenu::add('Заказ № '. $orderId);
} else {
    cmfLoad('user/cmfUserOrderView');
    if($isView = !cmfUserOrderView::isView($orderId)) {
        $this->assing('isView', $isView);
        $content = cmfRegister::getSql()->placeholder("SELECT content FROM ?t WHERE name='Личный кабинет: Заказы: конфиденциальные данные'", db_content_static)
                            ->fetchRow(0);
        $this->assing('content', $content);

        $orderView = new cmfUserOrderView($orderId);
        $this->assing('orderView',	$orderView);
        $this->assing('form',			$orderView->getForm());
    }
}


list($header, $_basket) = unserialize($order['product']);
$this->assing('header', $header);
$this->assing('_basket', $_basket);

list(, , $userData, $userAdress, $userSubscribe) = unserialize($order['data']);
$this->assing('userData', $userData);
$this->assing('userAdress', $userAdress);
if(!empty($order['EMS'])) {
    $this->assing('EMS', $order['EMS']);
}
$this->assing('userSubscribe', $userSubscribe);

list($countAll, $priceAll, $priceDiscount, $priceDelivery, $discount) = unserialize($order['price']);
$this->assing('countAll', $countAll);
$this->assing('priceAll', $priceAll);
$this->assing('priceDiscount', $priceDiscount);
$this->assing('discount', $discount);
if($order['isDelivery']==='yes')
    $this->assing('priceDelivery', $priceDelivery);

if(!empty($order['deliveryDesc']))
    $this->assing2('deliveryDesc', cmfString::unserialize($order['deliveryDesc']));

if(cmfGlobal::is('paymentMessage')) {
    $this->assing2('paymentMessage', cmfGlobal::get('paymentMessage'));
}
$this->assing('orderId', $orderId);
$this->assing2('orderUrl', cmfGetUrl('/user/order/one/', array($orderId)));
$this->assing('status', $status[$order['status']]);
$this->assing2('date', date('d.m.y H:i', strtotime($order['registerDate'])));



//$this->assing2('pay', $order['isPay']==='yes' ? 'оплачен' : 'не оплачен');
if($order['isPay']==='no') {
    $this->assing2('payUrl', cmfGetUrl('/user/order/pay/', array($orderId)));
}

?>