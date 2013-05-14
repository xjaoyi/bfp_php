<?php
class Controller {
	
	protected $_getParams;
	protected $_getAllParams;
	protected $_getPost;
	
	public final function __construct() {
		$this->init ();
		$this->before ();
		
		$this->_getParams = $_GET;
		$this->_getAllParams = $_REQUEST;
		$this->_getPost = $_POST;
	}
	
	public function init() {
	}
	
	public function before() {
	}
}