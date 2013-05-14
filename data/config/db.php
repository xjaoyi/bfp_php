<?php
$dbConfig = array (
		'default' => array (
				'datebaseType' => 'mysql',
				'host' => 'localhost',
				'dbname' => 'web',
				'charset' => 'utf8',
				'username' => 'root',
				'password' => '123456' 
				// 'option' => array('PDO::ATTR_PERSISTENT'=>false), //是否长链接 true 默认为短链接false;
				) 
);

$config = $dbConfig ['default'];