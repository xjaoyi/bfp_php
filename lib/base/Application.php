<?php
class Application{
	public static function run(){
		$Uri = UriRouter::getInstance();
		$ctrl = $Uri->controller;
		$ctrl = new $ctrl();
		$act = $Uri->action;
		$ctrl->$act();
	}
	
}