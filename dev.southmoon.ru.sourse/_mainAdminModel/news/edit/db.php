<?php


class news_edit_db extends driver_db_edit {

    public function updateController() {
		return 'model_news';
	}

	protected function getTable() {
		return db_news;
	}

}

?>