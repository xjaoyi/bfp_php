<?php
class UriRouter {
	public $module = 'app';
	public $controller = 'indexController';
	public $action = 'index';
	public $_GetParam;
	private static $instance;
	public function __construct() {
		$this->getMVCRouter ();
	}
	public static function getInstance() {
		if (! self::$instance) {
			self::$instance = new self ();
		}
		return self::$instance;
	}
	public function getMVCRouter() {
		// 路由分发页面
		$URI = explode ( '/', $_SERVER ['REQUEST_URI'] );
		if (! empty ( $URI ['1'] )) {
			// var_dump($URI);
			$module = $GLOBALS ['module'];
			if (in_array ( $URI ['1'], $module )) {
				next ( $URI );
				$this->module = current ( $URI );
			} else {
				$this->module = current ( $module );
			}
			next ( $URI );
			$this->controller = current ( $URI ) . 'Controller';
			next ( $URI );
			if (current ( $URI )) {
				$this->action = current ( $URI );
				next ( $URI );
			}
			while ( current ( $URI ) ) {
				$ParamKey = current ( $URI );
				next ( $URI );
				if (current ( $URI )) {
					$_REQUEST [$ParamKey] = $this->_GetParam [$ParamKey] = current ( $URI );
					next ( $URI );
				}
			}
			
			$_GET = $this->_GetParam;
		}
	}
}