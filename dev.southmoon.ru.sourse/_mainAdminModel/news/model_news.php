<?php


class model_news extends cmfDriverModel {


    const name = '/news/';
    static public function update($id) {
        cmfUpdateCache::update('news');
	}

    static public function delete($id) {
	}

}

?>