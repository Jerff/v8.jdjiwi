<?php


class cmfBasketView {
    
    
    static private $step = null;
    static private $view = null;
    static private $isUser = null;
    static public function init(&$basket, $step) {
        self::$isUser = cmfRegister::getUser()->is();
        self::$step = $step;
        
        self::$view['basket'] = cmfGetUrl('/basket/');
        if($basket->isStep(1)) {
            self::$view['delivery'] = cmfGetUrl('/basket/delivery/');
        }
        if($basket->isStep(2)) {
            self::$view['adress'] = cmfGetUrl('/basket/adress/');
        }
        if($basket->isStep(3)) {
            self::$view['subscribe'] = cmfGetUrl('/basket/subscribe/');
        }
        if($basket->isStep(4)) {
            self::$view['pay'] = cmfGetUrl('/basket/pay/');
        }
        if($basket->isStep(5)) {
            self::$view['confirmation'] = cmfGetUrl('/basket/confirmation/');
        }
    }


    static public function menu() {
        $i = 1;    
        ?><div class="steps"><?            
            self::view($i++, 'basket', 'Корзина');
            self::view($i++, 'delivery', 'Доставка');
            self::view($i++, 'adress', 'Адрес');
            if(!self::$isUser) self::view($i++, 'subscribe', 'Рассылка');
            self::view($i++, 'pay', 'Оплата');
            self::view($i++, 'confirmation', 'Подтверждение');
        ?></div><?
    }

    static private function view($i, $id, $text) {
        if(self::$step==$id) {
?>
            <div class="step active"><div class="s2"><div class="s3">
                <b><?=$i ?></b><i><?=$text ?></i>
            </div></div></div>
<?            
        } else {
?>
            <div class="step"><div class="s2"><div class="s3 <? if(isset(self::$view[$id])) { ?>cursor<? } ?>" <? if(isset(self::$view[$id])) { ?>onclick="cmf.redirect('<?=self::$view[$id] ?>');"<? } ?>>
                <b><?=$i ?></b><i><?=$text ?></i>
            </div></div></div>            
<?           
        }
        
?>

<?
    }

    
}

?>