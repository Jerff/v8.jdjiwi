<?php


abstract class cmfCacheDriver {

	// ������ ������� ��������
	private $isError = false;
	protected function setError() {
		$this->isError = true;
	}

	public function isRun() {
		return !$this->isError;
	}


	// ��� ������ �� �����
	abstract public function set($n, $v, $tags, $time);
	abstract public function get($n);
	abstract public function delete($n);
	abstract public function deleteTime();
	abstract public function deleteTag($tags);
	abstract public function clear();

}

?>
