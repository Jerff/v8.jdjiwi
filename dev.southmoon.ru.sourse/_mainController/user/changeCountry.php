<?php


cmfAjax::start();

cmfLoad('contact/cmfContact');
$r = cmfRegister::getRequest();
$regionId =  $r->getPost('regionId');
$countryId =  $r->getPost('value');

if(!$regionId) return;
if($js = cmfCache::getParam('changeCountry', $countryId)) {

} else {

    $select = new cmfFormSelectInt();
    $select->addElement( 0, 'Отсуствует');
    if($countryId) {
        foreach(cmfContact::region($countryId) as $k=>$v) {
            $select->addElement($k, $v);
        }
    }
    $js = $select->jsUpdateSelect($regionId);
    cmfCache::setParam('changeCountry', $countryId, $js, 'country,region');
}
cmfAjax::get()->script($js)
              ->script("$('.selectRegion>.formElement>.selectCountry').resetSS();");


?>