<?php
class indexController extends Controller{
	function init(){
		headerClass::getInstance ();
	}
	function index(){
// 		echo 'main223222';
// 		var_dump($this->_getAllParams);
// 		var_dump($this->_getParams['aa']);
		var_dump(CacheClass::load('menuData'));
		
//		$GET = ::getInstance()->_GetParam;
		//var_dump($GET);
		
		/*
		$sql = array(
				'table'=>'type'
				);
		$db= new DbClass();
		$data = $db->sel_query($sql);
		var_dump(SortClass::sort($data));
		$menuDataArr = SortClass::sort($data);
		CacheClass::save($menuDataArr, 'menuData');
// 		var_dump();
		SortClass::sortList();
		*/
	}
	function aaa(){
		echo 'main';
// 		var_dump(Uri::getInstance()->_GetParam);

	}
	
/*
	public function listArr(){
		echo 'hello,world!';
		
		// 		$sortArr = SortClass::sortList($data=array());
		// 		var_dump($sortArr);
	}
	public function index(){
		echo 'dddd---';
		//echo SortClass::sortList();
	}
	*/
}