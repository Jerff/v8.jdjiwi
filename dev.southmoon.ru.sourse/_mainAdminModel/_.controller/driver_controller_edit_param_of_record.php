<?php

// обстрактный контроллер страницы редактирования
abstract class driver_controller_edit_param_of_record extends driver_controller_edit {


    function __construct($id=null) {
        $this->setIdName('config');
        parent::__construct($id);
	}

    protected function updateSiteUrl() {
    }

}

?>
