<?php


class cmfViewAjax {


	static public function startForm(&$form, $style='') { ?>
		<div id="<?=$form->getIdForm() ?>FormDiv"><a name="<?=$form->getIdHash() ?>"></a>
		<form id="<?=$form->getIdForm() ?>" action="" name="<?=$form->getIdForm() ?>" enctype="multipart/form-data" method="post" <?=$style ?>>
		<script type="text/javascript">
		$('#<?=$form->getIdForm() ?>').submit(function() {
			return cmf.ajax.sendForm('<?=$form->getAjaxUrl() ?>', cmf.getId('<?=$form->getIdForm() ?>'));
		});
		</script>
<?
	}


	static public function onsubmit(&$form) {
		?>return <?=$form->getFunc() ?>('<?=$form->getAjaxUrl() ?>', cmf.getId('<?=$form->getIdForm() ?>'));<?
	}


	static public function formError(&$form) { ?>
		<p class="text cmfHide" id="<?=$form->getIdForm() ?>Error"><b class="errorDiv2">Форма не отправлена!</b></p>
<?
	}


	static public function formSave(&$form) { ?>
		<p class="cmfHide" id="<?=$form->getIdForm() ?>Save"><b class="errorDiv3">Данные сохранены</b></p>
<?
	}

	static public function endForm(&$form) { ?>
		</form></div>
<?
	}

}

?>