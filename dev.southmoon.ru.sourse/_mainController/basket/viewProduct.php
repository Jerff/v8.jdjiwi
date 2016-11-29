<?php


cmfAjax::start();
$r = cmfRegister::getRequest();


$productId = (int)$r->getPost('productId');
if($productId) {
    cmfRegister::getSql()->placeholder("UPDATE ?t SET `view`=`view`+1 WHERE id=?", db_product, $productId);
}



?>