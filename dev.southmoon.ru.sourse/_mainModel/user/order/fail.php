<?php


$modul = cmfPages::getParam(1);
$sql = cmfRegister::getSql();
$pay = $sql->placeholder("SELECT id, data, name FROM ?t WHERE modul=? AND visible='yes'", db_payment, $modul)
			 ->fetchAssoc();
if(!$pay) {
    return 404;
}

cmfGlobal::set('paymentMessage', 'Платеж не прошел');
cmfLoad('payment/cmfPayment');
if($orderId = cmfPayment::fail($modul)) {
    cmfGlobal::set('$orderId', $orderId);
    return '/user/order/one/';
}
return 404;

?>