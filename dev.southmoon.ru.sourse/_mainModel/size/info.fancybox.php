<?php


$sql = cmfRegister::getSql();
$_info = $sql->placeholder("SELECT id, parent, name, content FROM ?t WHERE isVisible='yes' ORDER BY pos", db_size)
			->fetchAssocAll('parent', 'id');
$i = 0;
foreach($_info[0] as $p=>$v) {
    $c = count($_info[$p]);
    if($c>$i) $i = $c;
}
$this->assing2('_info', $_info);
$this->assing2('infoCount', $i);
cmfMenu::add('�������');

$this->assing2('header', cmfConfig::get('catalog/size', 'header'));
$this->assing2('footer', cmfConfig::get('catalog/size', 'footer'));

?>