<?php


$sectionId = cmfGlobal::get('$rootId');
$brandId = cmfGlobal::get('$brandId');
if($_menu = cmfCache::getParam('catalogMenu', array($sectionId, $brandId))) {
    list($_menu, $_catalog, $_brand, $isType, $baner, $banerTime) = $_menu;
} else {

    $sql = cmfRegister::getSql();
    $where = array();
    if($sectionId) {
        $where['section'] = $sql->placeholder("SELECT id FROM ?t WHERE parent=? OR path LIKE '%[?s]%' AND isVisible='yes'", db_section, $sectionId, $sectionId)
                            ->fetchRowAll(0, 0);
        $where[] = 'AND';
        //$where['section'] = cmfGlobal::get('$sectionList');
    }
    if($brandId) {
        $where = array('brand'=>$brandId);
        //$where['brand'] = $brandId;
        $where[] = 'AND';
    }
    //pre($sectionId, $brandId, $where, cmfGlobal::get('$sectionList'));

    $_menu = cmfGlobal::get('$secPath');
    $sUri = cmfGlobal::get('$sectionUri');
    $bUri = cmfGlobal::get('$brandUri');
    $res = $sql->placeholder("SELECT s.id, s.parent, s.name, s.isUri, menu.isProduct FROM ?t s LEFT JOIN ?t menu ON (s.id=menu.section) WHERE ?w:menu menu.isMenu='yes' AND s.isVisible='yes' ORDER BY s.parent, s.pos", db_section, db_section_is_brand, $where)
                        ->fetchAssocAll();
    $_catalog = $_brand = array();
    foreach($res as $row) {
        $_catalog[$row['parent']][$row['id']] = array('name'=>$row['name'],
                                                      'isProduct'=>(int)$row['isProduct'],
                                                      'sel'=>isset($_menu[$row['id']]),
                                                      'url'=>$brandId ? cmfGeturl('/brand/section/', array($row['isUri'], $bUri)) : cmfGeturl('/section/', array($row['isUri'])));
    }

    $isType = $sql->placeholder("(SELECT 'sale', 1 FROM ?t WHERE id IN(SELECT id FROM ?t) AND ?w `type`='sale' LIMIT 0, 1)
                                  UNION
                                 (SELECT 'new', 1 FROM ?t WHERE id IN(SELECT id FROM ?t) AND ?w `created`>'". (time() - cmfConfig::get('catalog', 'novelty') *24*60*60) ."' LIMIT 0, 1)",
                                    db_search, db_product_id, $where,
                                    db_search, db_product_id, $where)
                        ->fetchRowAll(0, 1);


    if($sectionId) {
        $where = array('section'=>cmfGlobal::get('$sectionList'));
    } else {
        $where = array('section'=>0);
    }
    $res = $sql->placeholder("SELECT id, name, uri, i.isNewProduct FROM ?t b LEFT JOIN ?t i ON(b.id=i.brand) WHERE ?w:i AND b.visible='yes' AND i.isMenu='yes' ORDER BY name", db_brand, db_section_is_brand, $where)
                    ->fetchAssocAll();
    if($brandId and $sectionId) {
        $_brand[0] = array('name'=>'Все бренды',
                           'isNew'=>0,
                           'url'=>cmfGeturl('/section/', array($sUri)));
    }
    foreach($res as $row) {
        $_brand[$row['id']] = array('name'=>$row['name'],
                                    'isNew'=>(bool)$row['isNewProduct'],
                                    'url'=>$sUri ? cmfGeturl('/brand/section/', array($sUri, $row['uri']))
                                                 : cmfGeturl('/section/', array($row['uri'])));
    }
    if(isset($_brand[$brandId])) {
        $_brand[$brandId]['sel'] = true;
    }

    $where = array();
    if($sectionId) {
        $where['parent'] = cmfGlobal::get('$secPath');
    } else if($brandId) {
        $where['parent'] = 0;
        $where[] = 'AND';
        $where['parentBrand'] = $brandId;
    } else {
        $where['parent'] = 0;
        $where[] = 'AND';
        $where['parentBrand'] = 0;
    }
    $baner = $sql->placeholder("SELECT id, name, image, IF(`type`='edit', url, catalogUrl) AS url FROM ?t WHERE ?w AND image IS NOT NULL AND visible='yes'", db_baner, $where)
                   ->fetchAssocAll('id');
    foreach($baner as $k=>$v) {
        $baner[$k]['title'] = htmlspecialchars($v['name']);
        $baner[$k]['image'] = cmfBaseImg . cmfPathBaner . $v['image'];
    }
    $banerTime = cmfConfig::get('baner', 'time');

    cmfCache::setParam('catalogMenu', array($sectionId, $brandId), array($_menu, $_catalog, $_brand, $isType, $baner, $banerTime), 'sectionList,brandList,shopList');
}

if(isset($isType['new'])) {
    $this->assing2('isNew', cmfGlobal::get('$isNew'));
    $this->assing2('newUrl', cmfGetUrl('/section/', cmfProductUrl::replace(cmfGlobal::get('$_itemUri'), 'param', null,
                                                                                                        'type', 'new',
                                                                                                        'page', 1)));
}
if(isset($isType['sale'])) {
    $this->assing2('isSale', cmfGlobal::get('$isSale'));
    $this->assing2('saleUrl', cmfGetUrl('/section/', cmfProductUrl::replace(cmfGlobal::get('$_itemUri'), 'param', null,
                                                                                                         'type', 'sale',
                                                                                                         'page', 1)));
}

$this->assing2('sectionName', cmfGlobal::get('$sectionName'));
$this->assing2('sectionId', (int)$sectionId);
$this->assing('_menu', $_menu);
$this->assing('_catalog', $_catalog);
$this->assing('brandId', $brandId);
$this->assing('_brand', $_brand);

if($baner) {
    shuffle($baner);
    $this->assing('baner', $baner);
    $this->assing2('banerTime', $banerTime);
}

?>