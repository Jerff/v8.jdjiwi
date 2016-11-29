<?php


class cmfFormError {

	private	static $error = null;

	public static function set($error) {
		self::$error = cmfFormConfig::get($error);
	}

	public static function is() {
		return (bool)self::$error;
	}

	public static function get() {
		$error = self::$error;
		self::$error = null;
		return $error;
	}

}

?>