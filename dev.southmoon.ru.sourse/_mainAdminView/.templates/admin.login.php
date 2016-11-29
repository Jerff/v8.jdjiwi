<?

if(cmfAjax::is()) {
	cmfAjax::get()->html('#mainIndex', $content);
}

?>

<?=$this->run('/admin/header/') ?>

<?=$content ?>

<?=$this->run('/admin/footer/') ?>