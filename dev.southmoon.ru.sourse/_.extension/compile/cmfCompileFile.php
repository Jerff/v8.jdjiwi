<?php

cmfLoad('packer.php/class.JavaScriptPacker');
class cmfCompileFile {

	private $include = null;
	private function reset() {
        $this->include = array();
	}
	private function compilePack($list, $file, $js) {
        if(isset($this->include[$file])) return '';
        foreach($list as $dir) {
            if(is_file($dir . $file)) {
                $sourse = cmfString::convertEncoding(file_get_contents($dir . $file));
                break;
            }
        }
        if(!isset($sourse)) return '';

        $include = '';
        preg_match_all('~//include\((.+)\);~', $sourse, $search);
        if($search[1]) {
        	foreach($search[1] as $v)
				if(!isset($this->include[$v])) {
                    $include .= $this->compilePack($list, $v, $js);
				}
        }
        $this->include[$file] = 1;

        if(mb_strrpos($file, 'min')===false and mb_strrpos($file, 'pack')===false and $js) {
	         $sourse = new JavaScriptPacker($sourse, 0);
	         $sourse = $sourse->pack();
		}
		return $include ."\n". $sourse;
	}

	public function compile($name, $js=true) {
		$sep = $js ? ';' : '';
		$sourse = '';
		list($name, $list) = $name;
        $this->reset();
		foreach($list as $dir) {
            $prefix = preg_replace('~^.+(\..+)$~i', '$1', $name);
            foreach(cmfDir::getList($dir) as $file) {
                if($name!=$file and mb_strrpos($file, $prefix)!==false) {
    				$sourse .= $this->compilePack($list, $file, $js);
    				$sourse .= "\n{$sep}\n";
                }
            }
		}

		if($sourse) {
            file_put_contents(cmfUpdateCompileConfig::soursePath() . $name, $sourse);
		}
	}

}

?>
