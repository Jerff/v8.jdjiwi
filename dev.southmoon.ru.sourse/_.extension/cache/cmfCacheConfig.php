<?php

// ����������� ��������� ����
class cmfCacheConfig {

    const driver= 'SQLite|Memcache|Xcache|eaccelerator|sql';
	const time = 60;


    // �������������  ������
    static public function Memcache(&$res) {
        $res->connect(cmfMemcacheHost, cmfMemcachePort);
    }

    public function __call($name, $arg) {
    }

}

?>