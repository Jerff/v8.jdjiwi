<?php

cmfAjax::start();

cmfLoad('basket/cmfHistory');
$history = new cmfHistory();

ob_start();
foreach($history->getProduct() as $id=>$row) { ?>
<a href="<?=$row['url'] ?>"><?=cmfSubContent($row['name'], 0, 40) ?></a>
<? } ?>
<script type="text/javascript">
$('.productHistory').show();
</script>
<?
cmfAjax::get()->html('#productHistoryList', ob_get_clean());

?>