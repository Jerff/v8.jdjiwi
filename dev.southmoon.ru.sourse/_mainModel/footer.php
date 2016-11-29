<?php


if($_menu = cmfCache::get('_footer')) {
    list($_menu, $email, $network, $copyright, $counters, $subscribeYes, $cart) = $_menu;
} else {

    $sql = cmfRegister::getSql();
    $_menu = cmfMenu::getFooter();
    $email = cmfConfig::get('showcase', 'email');
    $network = str_replace('%itemUrl%', urlencode(cmfPages::getUrl()), cmfConfig::get('showcase', 'network'));

    $copyright = nl2br(cmfConfig::get('seo', 'copyright'));
	$counters = $sql->placeholder("SELECT id, counters FROM ?t WHERE main='yes' AND visible='yes' ORDER BY pos ", db_seo_counters)
                            ->fetchRowAll(0, 1);
    $counters = implode(' ', $counters);

    cmfLoad('subscribe/cmfSubscribeYes');
    $subscribeYes = new cmfSubscribeYes('leftSubscribeYes');

    $cart = array();
	$cart['notice'] = cmfConfig::get('payment', 'notice');
	$cart['payment'] = cmfConfig::get('payment', 'payment');

    cmfCache::set('_footer', array($_menu, $email, $network, $copyright, $counters, $subscribeYes, $cart), 'menu,seoCounters,subscribe,seoCopyright');
}

$this->assing('_menu', $_menu);
$this->assing('email', $email);
$this->assing('network', $network);

$this->assing('copyright', $copyright);
$this->assing('counters', $counters);

$this->assing('subscribeYes', $subscribeYes);
$this->assing('form',         $subscribeYes->getForm());


$this->assing('cart',   $cart);

?>