<?php
$time = microtime ( 'now' );
$contTime = true;

$GLOBALS ['module'] = array ( 'app' ); // 定义一个模块
require_once '../lib/base/loadBase.php';
Application::run ();


echo microtime ( true ) - $time;