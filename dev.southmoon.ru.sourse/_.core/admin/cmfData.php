<?php


class cmfData {

	const noData = '<i>отсутсвуют даные</i>';

	private $data = array();


	function __construct($v=null) {
		$this->data = $v;
	}


	public function __get($n) {
		return get($this->data, $n, self::noData);
	}
	public function __set($n, $v) {
		$this->data[$n] = $v;
	}

	public function get($n) {
		return get($this->data, $n);
	}
	public function getInt($n) {
		return (int)get($this->data, $n);
	}
	public function html($n) {
		return htmlspecialchars($this->$n);
	}


	public function is($n) {
		return isset($this->data[$n]);
	}

	public function notEmpty($n) {
		return !empty($this->data[$n]);
	}

}

?>