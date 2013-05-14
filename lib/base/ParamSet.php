<?php
// web路径
define ( 'ROOTPATH', realpath ( __DIR__ . '/../' ) );
// define('CACHEPATH', ROOTPATH.'chche/');
// url 接口参数
$client ['url'] = 'http://10.1.1.103';
$client ['url'] = 'http://test.fytxonline.com';
$client ['login'] = '/client/login';
$client ['register'] = '/client/register';
$client ['pay'] = '/client/pay';
$client ['channel'] = '/client/pay/channel/';

// msgType id
$msgType = array (
		'60000' => 'login',
		'60001' => 'login',
		'60002' => 'login',
		'60003' => 'register',
		'60004' => 'login',
		'60005' => 'login',
		'60006' => 'login',
		'60007' => 'login',
		'60010' => 'channel',
		'60011' => 'pay' 
);
