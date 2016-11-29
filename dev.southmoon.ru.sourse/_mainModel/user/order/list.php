<?php


$user = cmfRegister::getUser();
$user->filterIsUser();
$user->reset();

$userId = $user->getId();
$sql = cmfRegister::getSql();

$page = (int)cmfPages::getParam(1);
if(!$page) $page = 1;
$limit = cmfConfig::get('user', 'orderLimit');
$offset = ($page-1)*$limit;
if($offset>3000) return 404;
$status = cmfOrder::getStatusList(0, 1, 2);
$res = $sql->placeholder("SELECT SQL_CALC_FOUND_ROWS id, isPay, registerDate, changeDate, status, price FROM ?t WHERE user=? AND status ?@ AND `delete`='no' ORDER BY registerDate DESC LIMIT ?i, ?i", db_basket, $userId, array_keys($status), $offset, $limit)
				->fetchAssocAll();
//if(!$res) return 404;
$_basket = array();
foreach($res as $row) {
    list($countAll, $priceAll, $priceDiscount, $priceDelivery, $discount) = unserialize($row['price']);

    $_basket[$row['id']] = array(   'status'=>$status[$row['status']],
                                    'pay'=>$row['isPay']==='yes' ? 'оплачен' : 'не оплачен',
                                    'url'=>cmfGetUrl('/user/order/one/', array($row['id'])),
                                    'price'=>$priceAll,
                                    'date'=>date('d.m.y H:i', strtotime($row['registerDate'])),
                                    'change'=>$row['registerDate']!==$row['changeDate'] ? '<br />'. date('d.m.y H:i', strtotime($row['changeDate'])) : '');
}
$this->assing('_basket', $_basket);
$count = $sql->getFoundRows();

cmfMenu::add('Личные кабинет', cmfGetUrl('/user/'));
cmfMenu::add('История заказов');
$_page_url = cmfPagination::generate($page, $count, $limit, cmfConfig::get('user', 'orderPage'),
    create_function('&$page, $k, $v', '
    	$page[$k]["url"] = $k==1 ? cmfGetUrl("/user/order/") : cmfGetUrl("/user/order/page/", array($k));'));
if($_page_url) $this->assing('_page_url', $_page_url);

?>