<?php

$sql = cmfRegister::getSql();
$sectionId = cmfGlobal::get('$sectionId');
$main = $sql->placeholder("SELECT name, image, width, height FROM ?t WHERE id=? AND visible='yes' ORDER BY pos", db_section, $sectionId)
            ->fetchAssoc();
if(!$main) return 404;
$main['title'] = cmfString::specialchars($main['name']);
$main['image'] = cmfBaseImg . cmfPathCatalog . $main['image'];
$this->assing('main', $main);


$small = $sql->placeholder("SELECT id, name, IF(`type`='edit', url, catalogUrl) AS url, `top`, `left`, `height`, `width` FROM ?t WHERE parent=? AND visible='yes' ORDER BY pos", db_section_shop, $sectionId)
            ->fetchAssocAll('id');
foreach($small as $k=>$v) {
    $small[$k]['title'] = cmfString::specialchars($v['name']);
}
$this->assing('small', $small);

?>