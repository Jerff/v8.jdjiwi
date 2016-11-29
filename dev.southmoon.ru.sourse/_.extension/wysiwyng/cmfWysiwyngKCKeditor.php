<?php

cmfLoad('wysiwyng/cmfWysiwyngDriver');
set_include_path(get_include_path() . PATH_SEPARATOR . cmfWWW .'library/kckeditor/');
include_once(cmfWWW .'library/kckeditor/fckeditor.php');

class cmfWysiwyngKCKeditor extends cmfWysiwyngDriver {

    static protected function getJsPath() {
        return cmfProjectMain .'library/kckeditor/';
    }

	static public function html($path, $number, $id, $value, $height=null) {
		$oFCKeditor = new FCKeditor($id) ;
		$oFCKeditor->BasePath	= self::getJsPath();
		$oFCKeditor->Value		= $value ;
		if($height) $oFCKeditor->Height = $height;
		$oFCKeditor->ConfigURl		= array('path'=>$path, 'number'=>$number) ;
		return $oFCKeditor->Create() ;
	}

	static public function jsUpdate($id, $value) {
        $value = cmfToJsString($value);
        $js =<<<HTML
FCKeditorAPI.Instances.{$id}.SetHTML('$value');
HTML;
		return $js;
	}

    static public function typograf($id) {
?>
        <br>
        <div title="ТипограF" style="padding: 5px;">
            <a id="typograf<?=$id ?>" href="<?=self::getJsPath() ?>editor/plugins/typograf/typograf2.html?id=<?=$id ?>">
                <img src="<?=self::getJsPath() ?>editor/plugins/typograf/typograf.gif" class="TB_Button_Image">
            </a>
            <script type="text/javascript">
                $("#typograf<?=$id ?>").fancybox({type:'iframe'});
            </script>
        </div>
<?
    }

}

?>