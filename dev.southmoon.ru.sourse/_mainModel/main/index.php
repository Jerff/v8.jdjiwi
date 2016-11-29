<?php

$sql = cmfRegister::getSql();
$main = $sql->placeholder("SELECT id, name, image FROM ?t WHERE visible='yes' ORDER BY pos", db_showcase)
            ->fetchAssocAll('id');
foreach($main as $k=>$v) {
    $main[$k]['title'] = cmfString::specialchars($v['name']);
    $main[$k]['image'] = cmfBaseImg . cmfPathShowcase . $v['image'];
}
$this->assing('main', $main);

$small = $sql->placeholder("SELECT parent, id, name, IF(`type`='edit', url, catalogUrl) AS url, `top`, `left`, `height`, `width` FROM ?t WHERE parent ?@ AND visible='yes'", db_showcase_list, array_keys($main))
            ->fetchAssocAll('parent', 'id');
foreach($small as $p=>$list) {
    foreach($list as $k=>$v) {
        $small[$p][$k]['title'] = cmfString::specialchars($v['name']);
    }
}
$this->assing('small', $small);

if(cmfConfig::get('showcase', 'isAnimation')) {
    $this->assing2('animationTime', cmfConfig::get('showcase', 'animationTime'));
}

?>