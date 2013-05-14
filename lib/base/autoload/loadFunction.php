<?php
$ModelPath = ROOT_PATH . implode ( '/model' . PATH_SEPARATOR . ROOT_PATH, $GLOBALS ['module'] ) . '/model';
$ModulePath = str_replace('model', 'controller', $ModelPath);

$path = '.' . PATH_SEPARATOR 
. $ModulePath . PATH_SEPARATOR
. $ModelPath . PATH_SEPARATOR 
. ROOT_PATH . 'lib/base' . PATH_SEPARATOR 
. ROOT_PATH . 'lib/ext' . PATH_SEPARATOR 
. get_include_path ();
;
set_include_path ( $path . get_include_path () );
function autoload($functionName) {
	// $fileName = $functionName . '.php';
	include_once ($functionName . '.php');
}
spl_autoload_register ( 'autoload' );