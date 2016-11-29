<?php


$modul = cmfPages::getParam(1);
$sql = cmfRegister::getSql();
$pay = $sql->placeholder("SELECT id, data, name, commission FROM ?t WHERE modul=? AND visible='yes'", db_payment, $modul)
			 ->fetchAssoc();
if(!$pay) {
    return 404;
}
$data = cmfString::unserialize($pay['data']);
$data['commission'] = $pay['commission'];

cmfLoad('payment/cmfPayment');
cmfPayment::result($modul, $data);

?>