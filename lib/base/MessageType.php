<?php
Class MessageType{
	const RQ_USERINFO = 10010000;
	const RQ_PRODUCTSORT = 10010001;
	const RQ_PRODUCTINFO = 10010002;
	
	public $class = array(
			'1001'=>'ProductClass',
	);
	public $action = array(
			'1001' => array('0001'=>'SortClass'),
	);

}