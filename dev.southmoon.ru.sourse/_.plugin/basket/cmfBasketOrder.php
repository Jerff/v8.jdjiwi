<?php


cmfLoad('ajax/cmfMainAjax');
cmfLoad('user/cmfUserRegister');
cmfLoad('basket/cmfOrder');
cmfLoad('basket/sms/cmfSmsInform');
cmfLoad('subscribe/cmfSubscribe');
cmfLoad('user/cmfUserOrderView');
class cmfBasketOrder extends cmfMainAjax {

	function __construct($formUrl=null, $name=null, $func=null) {

		if(!$name)		$name = 'basketOrder';
		if(!$formUrl)	$formUrl = cmfControllerUrl .'/basket/order/?';
		if(!$func)		$func = 'cmfAjaxSendForm';

		parent::__construct($formUrl, $name, $func);
	}

	public function run1() {
        $user = cmfRegister::getUser();
        $user->reset();
		$basket = new cmfBasket();
		if(!$basket->isOrder()) {
			cmfAjax::get()->redirect(cmfGetUrl('/basket/'));
		}

        //list($formData, $email, $userData, $userAdress, $userSubscribe) = $userRes = $basket->getStep(2);
        list($formDelivery, $userDelivery) = $basket->getStep(2);
        list($formData, $email, $userData, $userAdress) = $basket->getStep(3);
        $formData = array_merge($formData, $formDelivery);
        $userAdress = array_merge($userDelivery, $userAdress);
        if(!$user->is()) {
            list($formSubscribe, $userSubscribe) = $basket->getStep(4);
            $formData = array_merge($formData, $formSubscribe);
        } else {
            $userSubscribe = array();
        }
        $userRes = array($formData, $email, $userData, $userAdress, $userSubscribe);


        list($header, $_basket, $countAll, $priceAll, $priceDiscount, $priceDelivery, $discount, $isDelivery, $delivery, $pricePay) = $basketRes = $basket->getBasketProduct();
        if(isset($formSubscribe)) {
            foreach(cmfSubscribe::typeList() as $k=>$v) if(isset($formSubscribe[$k])) {
                cmfSubscribe::addUser($user->getId(), $email, $k);
            }
        }

        $data = array();
		$data['ip'] = cmfGetIpInt();
		$data['proxy'] = cmfGetProxyInt();
		$data['status'] = cmfOrder::getStartStatus();
		$data['registerDate'] = $data['orderDate'] = $data['changeDate'] = date('Y-m-d H:i:s');//, rand(1190001000, 1205291000));
		$data['user'] = $user->getId();
		$data['bak'] = serialize(array($userRes, $basketRes));
		$data['data'] = serialize($userRes);
		$data['product'] = serialize(array($header, $_basket));
		$data['pay'] = $pricePay;
        $data['price'] = serialize(array($countAll, $priceAll, $priceDiscount, $priceDelivery, $discount));
        $data['isDelivery'] = $isDelivery ? 'yes' : 'no';
        $data['deliveryPrice'] = $delivery;
        $basketId = cmfOrder::newOrder($data);

        if(!$user->getId()) {
            cmfUserOrderView::setView($basketId);
        }

        //exit;
		$userUrl = cmfProjectAdmin .'#/user/edit/&id='. $user->id;
		$productUrl = cmfProjectAdmin .'#/product/edit/&id=';
		$basketUrl = cmfProjectAdmin .'#/basket/edit/&id='. $basketId;
		$orderUrl = cmfGetUrl('/user/order/one/', array($basketId));

        $send = array();
        $send['dataMain'] = cmfFormtaArray($userData)
                            ."\n". cmfFormtaArray($userAdress);
        if(isset($formSubscribe)) {
            $send['dataMain'] .= "\n\nПодписка на новости". cmfFormtaArray($userSubscribe) ."\n";
        }
        $send['dataMain'] = $send['dataAdmin'] = strip_tags($send['htmlMain'] = nl2br(trim($send['dataMain'])));

        if($user->id) {
        	 $send['dataAdmin'] .= "\n{$userUrl}";
        }

        $send['adminUrl'] = $basketUrl;
        $send['№'] = $send['basketId'] = $basketId;
        $send['orderUrl'] = $orderUrl;
        $send['name'] = cmfUser::generateName($formData);
        $send['phone'] = $formData['phoneFull'];

		$send['contentMain'] = $send['contentAdmin'] = '';
		$send['contentHtml'] = '<table width="100%" cellspacing="0" cellpadding="0">
<tr style="font-size:14.0pt;">
    <td width="500px"><b>Наименование</b></td>
    <td width="200px"><b>Кол-во</b></td>
    <td width="150px"><b>Стоимость</b></td>
</tr>';
		foreach($_basket as $id=>$v) {
			$send['contentMain'] .= "

{$v['url']}
Название:	{$v['name']}";

			$send['contentAdmin'] .= "

{$productUrl}{$id}
{$v['url']}
Название:	{$v['name']}
Бренд:		{$v['bName']}";

            foreach($v['param'] as $pId=>$pName) if(isset($v['count'][$pId])) {
                foreach($v['count'][$pId] as $cId=>$cValue) if(isset($v['color'][$cId]) or !$cId) {
        			if($cId) {
                        $color = "Цвет: {$v['color'][$cId]['name']};	";
        			} else {
        			    $color = '';
        			}
        			if($pId) {
                        $param = "{$v['header']}: {$pName};	{$color}";
        			} else {
        			    $param = $color;
        			}
                    if(empty($param)) {
                        $paramHtml = '';
                    } else {
                        $paramHtml = '('. trim($param) .')';
                    }

        			$send['contentAdmin'] .= "
{$param}Количество: {$cValue};	Цена: {$v['view'][$pId][$cId]};";
    			    $send['contentMain'] .= "
{$param}Количество: {$cValue};	Цена: {$v['view'][$pId][$cId]};";

                    $send['contentHtml'] .= '
<tr style="font-size:12.0pt;">
<td style="border-bottom:1px solid black; padding-bottom:10px; padding-top:10px;"><a href="'. $v['url'] .'">'. $v['name'] .'</a> '. $paramHtml .'</td>
<td style="border-bottom:1px solid black; padding-bottom:10px; padding-top:10px;">'. $cValue .'</td>
<td style="border-bottom:1px solid black; padding-bottom:10px; padding-top:10px;">'. $v['view'][$pId][$cId] .' руб</td>
</tr>
';
                }
            }
		}
		$send['contentHtml'] .= '
<tr style="font-size:12.0pt;">
<td></td>
<td style="padding-top:10px;"><i>Сумма</i></td>
<td style="padding-top:10px;">'. $priceAll .' руб</td>
</tr>
</table>';

		$_price = array('Сумма:'=>"{$priceAll} руб.");
		if($discount) {
			$_price['Со скидкой:'] = "{$priceDiscount} руб.";
			$send['contentHtml'] .= '<p style="font-size:12.0pt;">Скидка: - '. $discount .' руб.</p>';
			$priceAll = $priceDiscount;
		}
		if($priceDelivery) {
			$_price['Цена с доставкой:'] = "{$priceDelivery} руб.";
			$send['contentHtml'] .= '<p style="font-size:12.0pt;">Доставка: + '. $delivery .' руб - '. $formData['dName'] .'.</p>';
			$priceAll = $priceDelivery;
		}
		if($discount) {
			$_price['Скидка:'] = "{$discount} руб.";
		}
		$send['contentHtml'] .= '<p style="font-size:12.0pt;">Общая стоимость заказа: '. $priceAll .' руб - '. $formData['dBasket'] .'.</p>';

		$send['contentAdmin'] .= "\n". cmfFormtaArray($_price);
        $send['contentMain'] .= "\n". cmfFormtaArray($_price);

        cmfSmsInform::newOrder($send);

        $cmfMail = new cmfMail();
		$cmfMail->sendType('basket', 'Корзина заказа: Письмо менеджеру', $send);
		$cmfMail->sendTemplates('Корзина заказа: Заказ с сайта', $send, $email);

        $basket->disable();
		cmfAjax::get()->redirect($orderUrl);
	}

}

?>