<?php
// 页面头部
class headerClass {
	public $view = '';
	private static $instance;
	function __construct($array = []) {
		foreach ( self::$header as $val ) {
			header ( $val );
		}
	}
	public static function getInstance() {
		if (! self::$instance) {
			self::$instance = new self ();
		}
		return self::$instance;
	}
}