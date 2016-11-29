<?php


$orderId = cmfPages::getParam(1);
$status = cmfOrder::getStatusList(0, 1, 2);
$sql = cmfRegister::getSql();
$order = $sql->placeholder("SELECT id, user, product, data, price, isPay, registerDate, status FROM ?t WHERE id=? AND status ?@ AND `delete`='no'", db_basket, $orderId, array_keys($status))
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

    cmfMenu::add('Личные кабинет', cmfGetUrl('/user/'));
    cmfMenu::add('История заказов', cmfGetUrl('/user/order/'));
}

cmfMenu::add('Заказ № '. $orderId, cmfGetUrl('/user/order/one/', array($orderId)));
cmfMenu::add('Оплата');

$this->assing('orderId', $orderId);
$this->assing('status', $status[$order['status']]);
$this->assing2('date', date('d.m.y', strtotime($order['registerDate'])));


list($countAll, $priceAll, $priceDiscount, $discount) = cmfString::unserialize($order['price']);
$this->assing('countAll', $countAll);
$this->assing('priceAll', $priceAll);
$this->assing('priceDiscount', $priceDiscount);
$this->assing('discount', $discount);


$res = $sql->placeholder("SELECT id, name, modul, notice, image FROM ?t WHERE visible='yes' ORDER BY pos", db_payment)
             ->fetchAssocAll();
$_list = array();
foreach($res as $k=>$row) {
    $_list[$row['id']] = array('name'=>$row['name'],
                               'title'=>cmfString::specialchars($row['name']),
                               'notice'=>nl2br($row['notice']),
                               'image'=>cmfBaseImg . cmfPathPayment . $row['image'],
                               'url'=>cmfGetUrl('/user/order/pay/run/', array($orderId, $row['modul'])));
}
$this->assing('_list', $_list);

?>