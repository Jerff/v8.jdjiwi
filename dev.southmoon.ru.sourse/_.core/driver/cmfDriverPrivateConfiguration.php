<?php


class cmfDriverPrivateConfiguration {

	private $config = array();

	protected function get($n) {
		return get($this->config, $n);
	}

	protected function get2($n, $n2) {
		return get2($this->config, $n, $n2);
	}

	protected function get3($n, $n2, $n3) {
		return get3($this->config, $n, $n2, $n3);
	}

	protected function getAll() {
        return $this->config;
    }

    protected function set($n, $v) {
        return $this->config[$n] = $v;
    }

}

?>