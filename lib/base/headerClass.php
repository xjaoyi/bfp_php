<?php
// 页面头部
class headerClass {
	private static $instance;
	public static $header = array (
			'charest' => 'Content-type: text/html; charset=utf-8' 
	);
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