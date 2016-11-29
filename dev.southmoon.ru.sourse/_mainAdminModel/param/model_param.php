<?php


class model_param {

     public static function initParamMenu() {
        $param = array();
        $param[''] = 'Отсуствует';
        $param['articul'] = 'Артикул';
        $param['brand'] = 'Производитель';
        $param['discount'] = 'Скидка';
        foreach(cmfModulLoad('param_list_db')->getNameList() as $k=>$v) {
            $param[$k] = $v['name'];
        }
        return $param;
    }

     public static function initParamSelect() {
        $param = array();
        $param[''] = 'Отсуствует';
        $param['articul'] = 'Артикул';
        $param['color'] = 'Цвет';
        $param['discount'] = 'Скидка';
        $param['price'] = 'Цена';
        foreach(cmfModulLoad('param_list_db')->getNameList(array('type'=>array('radio', 'select', 'basket', 'checkbox'))) as $k=>$v) {
            $param[$k] = $v['name'];
        }
        return $param;
    }


     public static function initParamBasketMenu() {
        $param = array();
        $param[''] = 'Отсуствует';
        foreach(cmfModulLoad('param_list_db')->getNameList(array('type'=>'basket')) as $k=>$v) {
            $param[$k] = $v['name'];
		}
		return $param;
	}

}

?>