<?php
function def_preg($filename,$match){
	$filename = 'php.acp';
	$fileContent = file_get_contents($filename);
	preg_match($match,$fileContent,$cc);
	return $cc;
}

$filename = 'php.acp';
var_dump(def_preg($filename,'/(\\)./'));


$email = 'aaa@125.com';
preg_match("/^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3}$/",$email,$ccc);
var_dump($ccc);
